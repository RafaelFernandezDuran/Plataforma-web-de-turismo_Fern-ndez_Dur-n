<?php

namespace App\Policies;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TourPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->user_type === 'company_admin' && $user->company;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tour $tour): bool
    {
        // Los tours activos son públicos
        if ($tour->status === 'active') {
            return true;
        }

        // Solo el propietario puede ver tours inactivos/borradores
        return $user->user_type === 'company_admin' 
            && $user->company 
            && $tour->company_id === $user->company->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->user_type === 'company_admin' 
            && $user->company 
            && $user->company->status === 'approved';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tour $tour): bool
    {
        return $user->user_type === 'company_admin' 
            && $user->company 
            && $tour->company_id === $user->company->id
            && $user->company->status === 'approved';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tour $tour): bool
    {
        return $user->user_type === 'company_admin' 
            && $user->company 
            && $tour->company_id === $user->company->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tour $tour): bool
    {
        return $user->user_type === 'company_admin' 
            && $user->company 
            && $tour->company_id === $user->company->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tour $tour): bool
    {
        return $user->user_type === 'admin';
    }
}
