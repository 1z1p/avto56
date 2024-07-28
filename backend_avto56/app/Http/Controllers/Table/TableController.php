<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Table\TableRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Table\TableNumberRequest;
use App\Http\Requests\Table\TableCancelRequest;
use DateTime;
class TableController extends Controller
{
    public function index(TableNumberRequest $request) {
        $response = $request->validated();
        $ddate = date("Y-m-d");
        $year = date("Y");
        $date = new DateTime($ddate);
        $week = (int)$date->format("W");
        
        if($response != []) {
            if($request['number'] == 1) {
                if($week == 52) {
                    $week = 1;
                } else if($request['number'] == 1) {
                    $week += $response['number'];
                }
            }
        }

        $user = auth()->user();

        if($user["role"] == 'cabet') {
            $table = DB::table('cabets')
                ->where('week', $week)
                ->where('year', $year)
                ->where('incpector', $user["incpector"])
                ->get();
            
            
            if($week != $user["week"] && $request['schalter'] == 2) {
                DB::table('users')
                    ->where('id', $user['id'])
                    ->update(['week' => $week, 'read' => 3]);

                $user_read = auth()->user();
                $table = DB::table('cabets')
                    ->where('week', $week)
                    ->where('year', $year)
                    ->where('incpector', $user["incpector"])
                    ->get();

                return response([
                    "incpector" => $user["incpector"],
                    "name" => $user["name"],
                    "read" => $user_read["read"],
                    "table" => $table,
                    "week" => $week
                ], 200);
            }

            return response([
                "incpector" => $user["incpector"],
                "name" => $user["name"],
                "read" => $user["read"],
                "table" => $table,
                "week" => $week
            ], 200);
        }

        if($user["role"] == "incpector") {
            $table = DB::table('cabets')
                ->where('week', $week)
                ->where('year', $year)
                ->where('incpector', $user["incpector"])
                ->get();

            return response([
                "incpector" => $user["incpector"],
                "name" => $user["name"],
                "table" => $table
            ], 200);
        }
    }

    public function update(TableRequest $request) {
        $response = $request->validated();
        $user = auth()->user();
    
        $ddate = date("Y-m-d");
        $year = date("Y");
        $date = new DateTime($ddate);
        $week = $date->format("W");
        if($week == 52) {
            $week = 1;
        } else {
            $week += 1;
        }

        if($user['read'] == 0 && $week == $user["week"]) {
            return response([
                "message" => "Больше нельзя записаться"
            ], 400);
        } else {
            $number = (int)$user['read'] -= 1;
            $users = DB::table('users')
                ->where('id', $user['id'])
                ->update(['read' => "$number"]);
            DB::table('cabets')
                ->where('id', $response['id'])
                ->update([$response['week'] => $user['name']]);

            return response([
                'message' => $user['read'],
            ], 200);
        }
    }

    public function cancel(TableCancelRequest $request) {
        $response = $request->validated();
        $user = auth()->user();

        $ddate = date("Y-m-d");
        $year = date("Y");
        $date = new DateTime($ddate);
        $week = $date->format("W");

        if($user['role'] == 'cabet') {
            DB::table('cabets')
                ->where('id', $response['id'])
                ->update([$response['week'] => ""]);

            $read = $user['read'] += 1;
            
            DB::table('users')
                ->where('id', $user['id'])
                ->update(['read' => $read]);
            return response([
                'message' => 'Cancel table',
            ], 200);
        }

        return response([
            'message' => 'Role not found'
        ], 200);
    }
}
