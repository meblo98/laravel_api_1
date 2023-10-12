<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
//use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Hash;
//use PhpParser\Node\Stmt\TryCatch;

//use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    public function register(RegisterUser $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password, [
                'rounds' => 12
            ]);

            $user->save();
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    public function login(Request $request)
    {
    }
}
