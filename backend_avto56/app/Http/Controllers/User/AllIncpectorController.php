<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AllIncpectorController extends Controller
{
    public function index() {
        $table = DB::table("users")
            ->select('incpector')
            ->where('role', 'incpector')
            ->get();

        return response($table, 200);
    }
}
