<?php

namespace App\Http\Services;

use App\Http\Repositories\RegisterRepositoryInterface;
use App\Mail\SendMailVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class RegisterService implements RegisterServiceInterface
{
    private $registerRepository;

    public function __construct(RegisterRepositoryInterface $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    public function store(array $params)
    {
        $params['password'] = Hash::make($params['password']);
        list($user, $error) = $this->registerRepository->store($params);
        
        $status = 403;
        $data = $error;

        if ($user) {
            $status = 200;
            $data = null;
            Mail::to($user->email)->queue(new SendMailVerification($user));
        }

        return [
            'status' => $status,
            'data' => [
                $data,
            ],
        ];
    }
}
