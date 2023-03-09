<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RefreshTokenRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credentials)) {
            $client = new Client();
            try {
                $response =  $client->post(config('services.passport.url').'/oauth/token', [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' =>  config('services.passport.id'),
                        'client_secret' => config('services.passport.secret'),
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope'=>'*'
                    ]
                ])->getBody();
                return success(json_decode($response));
            } catch (BadResponseException $e) {
                return error($e->getMessage() . ' [BadResponseException]');
            } catch (GuzzleException $e) {
                return error($e->getMessage() . ' [GuzzleException]');
            }
        } else {
            return error('login or password incorrect');
        }
    }

    public function logout():JsonResponse
    {
        auth()->user()->tokens()->delete();
        return success();
    }

    public function refreshToken(RefreshTokenRequest $request) {
        $client = new Client();
        try {
            $response = $client->post(config('services.passport.url').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->refresh_token,
                    'client_id' => config('services.passport.id'),
                    'client_secret' => config('services.passport.secret'),
                    'scope' => '*',
                ]
            ]);
            return json_decode($response->getBody());
        } catch (BadResponseException $exception) {
            if ($exception->getCode() == 400) {
                return error('bad request');
            } else if ($exception->getCode() == 401) {
                return error('unauthenticated',401);
            }
            return error('Something went wrong on the server'.$exception, $exception->getCode());
        } catch (GuzzleException $e) {
            return error('server error',500);
        }
    }
}
