<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterRepository implements RegisterRepositoryInterface
{
    public function store(array $params)
    {
        $user = '';
        $error = '';
        DB::beginTransaction();
        try {
            $user = User::create($params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = $e->getMessage();
        }

        return [$user, $error];
    }
}
