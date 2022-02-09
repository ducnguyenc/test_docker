<?php

namespace App\Http\Repositories;

use App\Models\User;

interface LoginRepositoryInterface
{
    public function store(User $user);
}
