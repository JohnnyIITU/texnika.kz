<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function checkUsername(Request $request){
        $username = $request->username;
        $users = User::where('email', $username)
            ->orWhere('phone', $username)
            ->get();
        $result = [
            'state' => count($users) > 0 ? 0 : 1
        ];
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function register(Request $request){
        $error = false;
        $errorText = '';
        $username = $request->username;
        $password = $request->password;
        $users = User::where('email', $username)
            ->orWhere('phone', $username)
            ->get();
        if(count($users) > 0){
            $error = true;
            $errorText = 'Такой e-mail/номер уже зарегистрирован';
        }

        if(!$error){
            $user = new User();
            if(substr($username, 0, 1) === '+'){
                if(is_numeric(substr($username, 1))){
                    $user->phone = $username;
                }
            }else{
                if(is_numeric($username)){
                    $user->phone = $username;
                }else if (strpos($username, '@') && strpos($username, '.')){
                    $user->email = $username;
                }
            }
            if($user->email === null && $user->phone === null){
                $error = true;
                $errorText = 'Ошибка попробуйте позднее';
            }
            $user->password = Hash::make($password);
            $user->save();
            Auth::login($user);
        }
        $result = [
            'error' => $error,
            'error_text' => $errorText,
        ];
        return response()->json($result)->withCallback($request->input('callback'));
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $users = User::where('email', $username)
            ->orWhere('phone', $username)
            ->first();

        if($users === null){
            $error = true;
            $errorText = 'Неверный логин или пароль';
        }else{
            if(Hash::check($password, $users->password)){
                Auth::login($users);
                $error = false;
                $errorText = '';
            }else{
                $error = true;
                $errorText = 'Неверный логин или пароль';
            }
        }

        $result = [
            'error' => $error,
            'error_text' => $errorText
        ];

        return response()->json($result)->withCallback($request->input('callback'));
    }
}
