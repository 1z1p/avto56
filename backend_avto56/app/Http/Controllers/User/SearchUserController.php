<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\SearchRequest;
class SearchUserController extends Controller
{
    public function search(SearchRequest $request) {
        $user = auth()->user();

        if($user['role'] == 'admin') { 
            $data = $request->validated();
            $search = $data['search'];
            $response = DB::table('users')
                ->where("name", "LIKE", "%$search%")
                ->where("role", "cabet")
                ->get();
            return response($response, 200);
        }

        return response([
            'message' => 'Invalid role'
        ],404);
    }
}

