<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index() {
        $user = auth()->user();
        
        return response([
            "role"=> $user['role'],
        ], 200);
    }
}
