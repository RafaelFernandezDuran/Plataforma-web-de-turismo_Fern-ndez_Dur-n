<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Hola, {{ $user->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">Aquí tienes una visión general de tus experiencias, próximas aventuras y recomendaciones personalizadas.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('tours.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35m0 0A7 7 0 105.65 5.65a7 7 0 0011 11z" />
                    </svg>
                    Buscar nuevos tours
                </a>
                <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-blue-600 border border-blue-200 text-sm font-semibold rounded-lg shadow hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10m-11 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2zm2 4h6" />
                    </svg>
                    Ver mis reservas
                </a>
            </div>
        </div>
    </x-slot>

    @php
        $statCards = [
            [
                'label' => 'Reservas totales',
                'description' => 'Historial acumulado de tus tours reservados',
                'value' => number_format($statistics['total_bookings']),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10m-11 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2zm2 4h6" />',
                'icon_color' => 'bg-blue-500/10 text-blue-600',
            ],
            [
                'label' => 'Próximas aventuras',
                'description' => 'Reservas con fecha futura confirmada',
                'value' => number_format($statistics['upcoming_bookings']),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h8.25" />',
                'icon_color' => 'bg-emerald-500/10 text-emerald-600',
            ],
            [
                'label' => 'Tours completados',
                'description' => 'Experiencias que ya disfrutaste',
                'value' => number_format($statistics['completed_tours']),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12.75l6 6 9-13.5" />',
                'icon_color' => 'bg-purple-500/10 text-purple-600',
            ],
            [
                'label' => 'Reviews publicados',
                'description' => 'Comentarios que compartiste con otros viajeros',
                'value' => number_format($statistics['reviews_written']),
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 15.75L15 18l-.75-4.5 3.25-3.17-4.5-.66L11.25 6l-2 3.67-4.5.66 3.25 3.17L7.5 18l3.75-2.25z" />',
                'icon_color' => 'bg-amber-500/10 text-amber-600',
            ],
        ];

        $statusStyles = [
            'pending' => 'bg-amber-100 text-amber-700',
            'confirmed' => 'bg-blue-100 text-blue-700',
            'paid' => 'bg-emerald-100 text-emerald-700',
            'completed' => 'bg-emerald-100 text-emerald-700',
            'cancelled' => 'bg-rose-100 text-rose-700',
            'refunded' => 'bg-violet-100 text-violet-700',
        ];

        $chartLabels = $monthlyTrend->pluck('label');
        $chartValues = $monthlyTrend->pluck('value');
        $profileCompletion = min(100, max(0, (int) $profile['completion']));
        $missingProfileFields = collect($profile['missing_fields'] ?? []);
    @endphp

    <div class="dashboard-page py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach($statCards as $card)
                    <div class="dashboard-stat-card bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition duration-200">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-sm uppercase tracking-wide text-gray-500">{{ $card['label'] }}</p>
                                    <p class="mt-3 text-3xl font-semibold text-gray-900">{{ $card['value'] }}</p>
                                </div>
                                <div class="h-12 w-12 rounded-xl flex items-center justify-center {{ $card['icon_color'] }}">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $card['icon'] !!}</svg>
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-gray-500 leading-relaxed">{{ $card['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <div class="xl:col-span-2 space-y-6">
                    <div class="dashboard-highlight-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Tu próxima aventura</h3>
                                <p class="text-sm text-gray-500">Organiza tus preparativos para que no se te escape ningún detalle.</p>
                            </div>
                            @if($nextBooking)
                                @php
                                    $daysUntil = now()->startOfDay()->diffInDays($nextBooking->tour_date, false);
                                    $daysLabel = $daysUntil > 0 ? "Faltan {$daysUntil} días" : ($daysUntil === 0 ? 'Es hoy' : 'Ya ocurrió');
                                @endphp
                                <span class="dashboard-status-badge inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600">{{ $daysLabel }}</span>
                            @endif
                        </div>

                        @if($nextBooking)
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs uppercase tracking-wide text-gray-500">Tour</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $nextBooking->tour?->title ?? 'Tour por confirmar' }}</p>
                                        <p class="text-sm text-gray-500">Organizado por {{ $nextBooking->company?->name ?? 'Empresa no registrada' }}</p>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-gray-600">
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-500/10 text-blue-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l2.5 2.5m6.25-2.5a8.75 8.75 0 11-17.5 0 8.75 8.75 0 0117.5 0z" />
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $nextBooking->tour_date->locale(app()->getLocale())->isoFormat('dddd D [de] MMMM') }}</p>
                                            <p class="text-xs text-gray-500">Duración: {{ $nextBooking->tour?->duration_days ?? 1 }} día(s)</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm text-gray-600">
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-emerald-500/10 text-emerald-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M4.5 12h15m-13.5 5.25h12" />
                                            </svg>
                                        </span>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ ucfirst($nextBooking->status) }}</p>
                                            <p class="text-xs text-gray-500">Reserva #{{ $nextBooking->booking_number ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-tip-card bg-blue-50 border border-blue-100 rounded-2xl p-5 flex flex-col justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-blue-700">Consejo rápido</p>
                                        <p class="mt-2 text-sm text-blue-600 leading-relaxed">Revisa tu correo para confirmar los detalles logísticos enviados por la empresa. Asegúrate de llevar documentos de identidad y estar 15 minutos antes del horario indicado.</p>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('bookings.show', $nextBooking) }}" class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-900">Ver detalle de la reserva
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="mt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">Aún no tienes una próxima actividad</h4>
                                    <p class="text-sm text-gray-500">Explora los tours disponibles y reserva tu siguiente experiencia en la selva central.</p>
                                </div>
                                <a href="{{ route('tours.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 border border-blue-100 rounded-lg font-semibold text-sm hover:bg-blue-100">
                                    Descubrir tours destacados
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Historial de reservas</h3>
                                <p class="text-sm text-gray-500">Volumen de reservas en los últimos 6 meses.</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-semibold text-gray-900">{{ $statistics['total_bookings'] }}</p>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Total acumulado</p>
                            </div>
                        </div>
                        <div class="mt-6 dashboard-chart">
                            <canvas id="bookingsTrendChart" class="w-full h-64"></canvas>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Completa tu perfil</h3>
                        <p class="text-sm text-gray-500">Un perfil completo te ayuda a recibir recomendaciones más precisas.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>Progreso</span>
                                <span class="font-semibold text-gray-900">{{ $profileCompletion }}%</span>
                            </div>
                            <div class="mt-2 w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-blue-500" style="width: {{ $profileCompletion }}%"></div>
                            </div>
                        </div>
                        @if($missingProfileFields->isNotEmpty())
                            <div class="mt-4 space-y-2">
                                <p class="text-xs uppercase tracking-wide text-gray-500">Pendiente de completar</p>
                                <ul class="space-y-1 text-sm text-gray-600">
                                    @foreach($missingProfileFields as $field)
                                        <li class="flex items-center gap-2">
                                            <span class="inline-flex w-2 h-2 rounded-full bg-blue-400"></span>
                                            {{ $field }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="mt-6 inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800">
                            Actualizar perfil
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.25 5.25l13.5 13.5m0-13.5v12h-12" />
                            </svg>
                        </a>
                    </div>

                    <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Categorías favoritas</h3>
                        <p class="text-sm text-gray-500">Basado en tus reservas y experiencias previas.</p>
                        <div class="mt-4 space-y-3">
                            @forelse($favoriteCategories as $category)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-full text-white" style="background-color: {{ $category['color'] }}">{{ strtoupper(substr($category['name'], 0, 1)) }}</span>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $category['name'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $category['count'] }} reserva(s)</p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-100 text-gray-600">Top {{ $loop->iteration }}</span>
                                </div>
                            @empty
                                <div class="dashboard-empty-state rounded-xl border border-dashed border-gray-200 p-4 text-sm text-gray-500">
                                    Aún no contamos con suficiente información. ¡Reserva un tour y empezaremos a sugerirte experiencias personalizadas!
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Valoración promedio</h3>
                        <div class="mt-4 flex items-center gap-4">
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= round($statistics['average_rating']) ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.443a1 1 0 00-.364 1.118l1.286 3.957c.3.922-.755 1.688-1.538 1.118l-3.37-2.443a1 1 0 00-1.176 0l-3.37 2.443c-.783.57-1.838-.197-1.538-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.012 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                                    </svg>
                                @endfor
                            </div>
                            <div>
                                <p class="text-3xl font-semibold text-gray-900">{{ number_format($statistics['average_rating'], 1) }}</p>
                                <p class="text-xs uppercase tracking-wide text-gray-400">Promedio de tus reviews</p>
                            </div>
                        </div>
                        <p class="mt-4 text-sm text-gray-500">Comparte tus experiencias para orientar a otros viajeros y mejorar tus recomendaciones.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Próximas reservas</h3>
                        <a href="{{ route('bookings.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Ver todas</a>
                    </div>
                    <div class="mt-4 space-y-4">
                        @forelse($upcomingBookings as $booking)
                            <div class="flex items-start justify-between p-4 rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-sm transition duration-150">
                                <div class="flex items-start gap-4">
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs font-semibold text-gray-400 uppercase">{{ $booking->tour_date->format('M') }}</span>
                                        <span class="text-2xl font-semibold text-gray-900">{{ $booking->tour_date->format('d') }}</span>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900">{{ $booking->tour?->title ?? 'Tour por definir' }}</h4>
                                        <p class="text-xs text-gray-500">Con {{ $booking->company?->name ?? 'empresa no registrada' }}</p>
                                        <p class="mt-2 text-xs text-gray-400">Actualizado {{ $booking->updated_at?->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <span class="dashboard-status-badge text-xs font-semibold px-3 py-1 rounded-full {{ $statusStyles[$booking->status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        @empty
                            <div class="dashboard-empty-state rounded-xl border border-dashed border-gray-200 p-6 text-center text-sm text-gray-500">
                                No tienes reservas próximas. Explora los tours disponibles y vive nuevas experiencias.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Últimas actividades</h3>
                        <span class="text-xs uppercase tracking-wide text-gray-400">Resumen reciente</span>
                    </div>
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead>
                                <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                    <th class="py-3">Tour</th>
                                    <th class="py-3">Empresa</th>
                                    <th class="py-3">Monto</th>
                                    <th class="py-3">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($recentBookings as $booking)
                                    <tr class="hover:bg-gray-50/60">
                                        <td class="py-3 pr-4">
                                            <div class="font-semibold text-gray-900">{{ $booking->tour?->title ?? 'Tour por definir' }}</div>
                                            <div class="text-xs text-gray-400">Reservado {{ $booking->created_at?->diffForHumans() }}</div>
                                        </td>
                                        <td class="py-3 pr-4 text-gray-600">{{ $booking->company?->name ?? 'N/A' }}</td>
                                        <td class="py-3 pr-4 text-gray-900">
                                            @if($booking->total_amount)
                                                S/ {{ number_format($booking->total_amount, 2) }}
                                            @else
                                                <span class="text-xs text-gray-400">Por confirmar</span>
                                            @endif
                                        </td>
                                        <td class="py-3">
                                            <span class="dashboard-status-badge inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full {{ $statusStyles[$booking->status] ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($booking->status) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-sm text-gray-500 dashboard-empty-state">Aún no tienes historial de reservas. Empieza explorando los tours recomendados más abajo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Tours recomendados para ti</h3>
                        <p class="text-sm text-gray-500">Selección basada en tu historial, categorías favoritas y valoraciones globales.</p>
                    </div>
                    <a href="{{ route('tours.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Ver catálogo completo</a>
                </div>
                <div class="mt-6 grid grid-cols-1 md:flex md:flex-wrap gap-5">
                    @forelse($recommendedTours as $tour)
                        @php
                            $imageUrl = $tour->optimized_image ?? $tour->image_url ?? 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=600&q=80';
                        @endphp
                        <div class="dashboard-tour-card w-full md:w-[calc(50%-10px)] xl:w-[calc(25%-15px)] group rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition duration-200">
                            <div class="relative h-44 overflow-hidden">
                                <img src="{{ $imageUrl }}" alt="{{ $tour->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 text-white">
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-lg bg-white/20 backdrop-blur-sm">
                                        {{ $tour->category?->name ?? 'Categoría' }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 space-y-4">
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900 line-clamp-2">{{ $tour->title }}</h4>
                                    <p class="mt-1 text-sm text-gray-500">Desde S/ {{ number_format($tour->price, 2) }} • {{ ucfirst($tour->difficulty_level) }}</p>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center gap-1 text-amber-500">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.443a1 1 0 00-.364 1.118l1.286 3.957c.3.922-.755 1.688-1.538 1.118l-3.37-2.443a1 1 0 00-1.176 0l-3.37 2.443c-.783.57-1.838-.197-1.538-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.012 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                                        </svg>
                                        <span class="font-semibold text-gray-900">{{ number_format($tour->rating, 1) }}</span>
                                        <span class="text-xs text-gray-400">({{ $tour->total_reviews }} reseñas)</span>
                                    </div>
                                    <span class="text-xs uppercase tracking-wide text-gray-400">{{ $tour->duration_days }} día(s)</span>
                                </div>
                                <a href="{{ route('tours.show', $tour) }}" class="inline-flex items-center w-full justify-center px-4 py-2 text-sm font-semibold text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="dashboard-empty-state col-span-full rounded-2xl border border-dashed border-gray-200 p-10 text-center text-sm text-gray-500">
                            Aún no tenemos recomendaciones personalizadas. Completa tu perfil o reserva un tour para ayudarte con sugerencias relevantes.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="dashboard-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Tus reseñas recientes</h3>
                    <span class="text-xs uppercase tracking-wide text-gray-400">Retroalimentación enviada</span>
                </div>
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-5">
                    @forelse($recentReviews as $review)
                        <div class="dashboard-mini-card p-5 border border-gray-100 rounded-2xl hover:border-blue-200 hover:shadow-sm transition duration-150">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-blue-600 uppercase">{{ $review->tour?->title ?? 'Tour' }}</span>
                                <span class="inline-flex items-center gap-1 text-sm font-semibold text-amber-500">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.163c.969 0 1.371 1.24.588 1.81l-3.37 2.443a1 1 0 00-.364 1.118l1.286 3.957c.3.922-.755 1.688-1.538 1.118l-3.37-2.443a1 1 0 00-1.176 0l-3.37 2.443c-.783.57-1.838-.197-1.538-1.118l1.286-3.957a1 1 0 00-.364-1.118L2.012 9.384c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.957z" />
                                    </svg>
                                    {{ $review->rating }}/5
                                </span>
                            </div>
                            <p class="mt-3 text-sm text-gray-600 leading-relaxed">{{ \Illuminate\Support\Str::limit($review->comment, 120, '...') }}</p>
                            <p class="mt-4 text-xs text-gray-400">{{ $review->created_at?->diffForHumans() }}</p>
                        </div>
                    @empty
                        <div class="dashboard-empty-state col-span-full rounded-2xl border border-dashed border-gray-200 p-6 text-center text-sm text-gray-500">
                            No has escrito reseñas aún. Después de completar un tour, comparte tu experiencia para ayudar a otros viajeros.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" integrity="sha384-17PCze6+Us8aq7eu+6jkws/hAu8CvaGfpEgqs3vSVUZZdxZdflPaMTGKBhF0s18P" crossorigin="anonymous"></script>
    <script>
        const trendCanvas = document.getElementById('bookingsTrendChart');
        if (trendCanvas) {
            const trendContext = trendCanvas.getContext('2d');
            const gradient = trendContext.createLinearGradient(0, 0, 0, 240);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.35)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

            new Chart(trendContext, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Reservas por mes',
                        data: @json($chartValues),
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#2563EB',
                        tension: 0.35,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                color: '#6B7280',
                                font: { size: 12 },
                            },
                            grid: {
                                color: 'rgba(107, 114, 128, 0.08)',
                                drawBorder: false,
                            },
                        },
                        x: {
                            ticks: {
                                color: '#6B7280',
                                font: { size: 12 },
                            },
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: '#111827',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: (context) => ` ${context.parsed.y} reserva(s)`,
                            },
                        },
                    },
                },
            });
        }
    </script>
@endpush