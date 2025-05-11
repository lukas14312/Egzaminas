<?php

namespace App\Policies;

use App\Models\User;

class PrekePolicy
{
    public function create(User $user)
    {
        return $user->isAdmin(); // Leidžia tik administratoriams
    }
    
    public function downloadPdf(User $user)
    {
        return $user->isAdmin(); // Leidžia tik administratoriams
    }
    
}
