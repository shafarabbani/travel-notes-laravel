<?php

namespace App\Policies;

use App\Models\TravelNote;
use App\Models\User;

class TravelNotePolicy
{
    /**
     * Determine whether the user can update the travel note.
     */
    public function update(User $user, TravelNote $travelNote): bool
    {
        return $user->id === $travelNote->user_id;
    }

    /**
     * Determine whether the user can delete the travel note.
     */
    public function delete(User $user, TravelNote $travelNote): bool
    {
        return $user->id === $travelNote->user_id;
    }
}
