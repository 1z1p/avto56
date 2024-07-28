<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use App\Http\Requests\Table\UpdateTableAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Table\TableAdminRequest;
use DateTime;
class TableAdminController extends Controller
{
    public function index(TableAdminRequest $request) {
        $response = $request->validated();
        $user = auth()->user();

        $ddate = date("Y-m-d");
        $year = date("Y");
        $date = new DateTime($ddate);
        $week = $date->format("W");

        if($user['role'] == 'admin') {
            $table = DB::table('cabets')
                ->where('week', $response['week'])
                ->where('year', $response['year'])
                ->where('incpector', $response["incpector"])
                ->get();
            $users = DB::table('users')
                ->select('id','name')
                ->where('incpector', $response["incpector"])
                ->where('role', "cabet")
                ->get();

            return response([
                'users' => $users,
                'table' => $table
            ],200);
        }

        return response([
            'message' => 'Invalid role'
        ],404);
    }

    public function update(UpdateTableAdminRequest $request) {
        $response = $request->validated();
        if($response['name'] == null) {
            DB::table('cabets')
                ->where('id', $response['id'])
                ->update([$response['week'] => ""]);
        } else {
            DB::table('cabets')
                ->where('id', $response['id'])
                ->update([$response['week'] => $response['name']]);
        }
        return response([
            'message' => 'Record table'
        ], 200);
    }
}
