<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginRepository implements LoginRepositoryInterface
{
    public function store($user)
    {
        DB::beginTransaction();
        try {
            request()->session()->regenerate();
            $user->tokens()->delete();
            $token = $user->createToken(now());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }


        return $token->plainTextToken;
    }
}
