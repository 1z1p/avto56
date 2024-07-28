<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Http\Request;
use  App\Models\User;  
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegRequest;
use App\Http\Requests\User\DeleteRequest;
class CreateUsersController extends Controller
{
    public function create(StoreRequest $request) {
        $user = auth()->user();

        if($user['role'] == 'admin') {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            
            User::firstOrCreate([
                'username' => $data['username'],
            ], $data);

            return response([
                "message" => "create user",
            ], 200);
        }
        
        return response([
            'message' => 'Invalid role'
        ],404);
    }

    public function reg(RegRequest $request)
    {   
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        
        $user = DB::table('users')
            ->where('username', $data['username'])
            ->get();
        $code = DB::table('code')
            ->where('code', $data['code'])
            ->get();

            if(count($user) == 1) {
                return response(['message' => "Пользователь с таким логином существует"], 400);
            }

            else if(count($code) == 0) {
                return response(['message' => "Код недействителен"], 400);
            } else {
                DB::table('users')
                    ->insert([
                        "name" => $data['fullname'], 
                        'username' => $data['username'], 
                        'password' => $data['password'], 
                        'role' => 'cabet', 
                        'incpector' => $data['incpector'],
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }

        return response()->json(['message' => "Создан"]);
    }

    public function update(StoreRequest $request) {
        return response([
            "message" => "update user",
        ], 200);
    }

    public function delete(DeleteRequest $request) {
        $user = auth()->user();

        if($user['role'] == 'admin') {
            $data = $request->validated();

            DB::table('users')
             ->where('id', $data['id'])
             ->delete();

            return response([
                'message' => 'Пользователь успешно удален!'
            ],200);
        }

        return response([
            'message' => 'Invalid role'
        ],404);
    }
}
