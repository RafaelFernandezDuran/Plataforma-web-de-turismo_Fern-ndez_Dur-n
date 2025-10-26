<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return match ($user->user_type) {
            'company_admin' => redirect()->route('company.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            'tourist' => $this->touristDashboard($user),
            default => $this->touristDashboard($user),
        };
    }

    protected function touristDashboard($user)
    {
        $bookingsBaseQuery = $user->bookings();

        $totalBookings = (clone $bookingsBaseQuery)->count();

        $completedTours = (clone $bookingsBaseQuery)
            ->where('status', Booking::STATUS_COMPLETED)
            ->count();

        $upcomingBookingsQuery = (clone $bookingsBaseQuery)
            ->whereDate('tour_date', '>=', now()->startOfDay());

        $upcomingBookingsCount = (clone $upcomingBookingsQuery)->count();

        $upcomingBookings = (clone $upcomingBookingsQuery)
            ->with(['tour.category', 'company'])
            ->orderBy('tour_date')
            ->limit(5)
            ->get();

        $recentBookings = (clone $bookingsBaseQuery)
            ->with(['tour.category', 'company'])
            ->latest()
            ->limit(5)
            ->get();

        $reviewsCount = $user->reviews()->count();

        $recentReviews = $user->reviews()
            ->with('tour')
            ->latest()
            ->limit(3)
            ->get();

        $bookedTourIds = $user->bookings()->pluck('tour_id')->unique();

        $recommendedTours = Tour::query()
            ->active()
            ->with(['category', 'company'])
            ->when($bookedTourIds->isNotEmpty(), fn ($query) => $query->whereNotIn('id', $bookedTourIds))
            ->orderByDesc('rating')
            ->orderByDesc('total_reviews')
            ->limit(4)
            ->get();

        $favoriteCategories = $user->bookings()
            ->join('tours', 'bookings.tour_id', '=', 'tours.id')
            ->join('tour_categories', 'tours.tour_category_id', '=', 'tour_categories.id')
            ->select(
                'tour_categories.id',
                'tour_categories.name',
                'tour_categories.color',
                DB::raw('COUNT(bookings.id) as total')
            )
            ->groupBy('tour_categories.id', 'tour_categories.name', 'tour_categories.color')
            ->orderByDesc('total')
            ->limit(3)
            ->get()
            ->map(fn ($row) => [
                'id' => $row->id,
                'name' => $row->name,
                'color' => $row->color ?? '#3B82F6',
                'count' => (int) $row->total,
            ]);

        $monthlyRaw = (clone $bookingsBaseQuery)
            ->selectRaw('DATE_FORMAT(tour_date, "%Y-%m") as month_key, COUNT(*) as total')
            ->where('tour_date', '>=', Carbon::now()->subMonths(5)->startOfMonth())
            ->groupBy('month_key')
            ->orderBy('month_key')
            ->pluck('total', 'month_key');

        $monthlyTrend = collect(range(5, 0))->map(function ($monthsAgo) use ($monthlyRaw) {
            $date = Carbon::now()->subMonths($monthsAgo);
            $key = $date->format('Y-m');

            return [
                'label' => $date->locale(app()->getLocale())->isoFormat('MMM YYYY'),
                'value' => (int) ($monthlyRaw[$key] ?? 0),
            ];
        });

        $averageRating = round((float) $user->reviews()->avg('rating'), 1);

        $profileFieldLabels = [
            'phone' => 'Teléfono',
            'birth_date' => 'Fecha de nacimiento',
            'nationality' => 'Nacionalidad',
            'document_type' => 'Tipo de documento',
            'document_number' => 'Número de documento',
            'preferences' => 'Preferencias de viaje',
        ];

        $completedProfileFields = collect($profileFieldLabels)
            ->reject(function ($label, $field) use ($user) {
                $value = $user->{$field};
                return empty($value) || ($field === 'preferences' && empty($value ?? []));
            });

        $profileCompletion = $profileFieldLabels
            ? round(($completedProfileFields->count() / count($profileFieldLabels)) * 100)
            : 100;

        $missingProfileFields = collect($profileFieldLabels)
            ->keys()
            ->diff($completedProfileFields->keys())
            ->map(fn ($key) => $profileFieldLabels[$key])
            ->values();

        $nextBooking = $upcomingBookings->first();

        return view('dashboard.tourist', [
            'user' => $user,
            'statistics' => [
                'total_bookings' => $totalBookings,
                'upcoming_bookings' => $upcomingBookingsCount,
                'completed_tours' => $completedTours,
                'reviews_written' => $reviewsCount,
                'average_rating' => $averageRating,
            ],
            'upcomingBookings' => $upcomingBookings,
            'recentBookings' => $recentBookings,
            'recentReviews' => $recentReviews,
            'recommendedTours' => $recommendedTours,
            'favoriteCategories' => $favoriteCategories,
            'monthlyTrend' => $monthlyTrend,
            'profile' => [
                'completion' => $profileCompletion,
                'missing_fields' => $missingProfileFields,
            ],
            'nextBooking' => $nextBooking,
        ]);
    }
}
