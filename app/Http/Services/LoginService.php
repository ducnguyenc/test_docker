<?php

namespace App\Http\Services;

use App\Http\Repositories\LoginRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginService implements LoginServiceInterface
{
    private $loginRepository;

    public function __construct(LoginRepositoryInterface $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function store(array $params)
    {
        if (Auth::attempt($params)) {
            $user = Auth::user();
            $userToken = $this->loginRepository->store($user);

            return [
                'status' => 200,
                'data' => [
                    'type' => $user->type,
                    'token' => $userToken,
                ],

            ];
        }

        return [
            'status' => 404,
            'data' => [
                'message' => trans('auth.failed'),
            ],
        ];
    }
}
