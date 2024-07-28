<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AllUsersController extends Controller
{
    public function index() {
        // SELECT * 
        // FROM cabets 
        $user = auth()->user();
        // WHERE CONCAT_WS(`monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) LIKE '%Насаева%';
        $table = DB::table("users")
            ->select('id', 'name', 'username', 'username','role', 'incpector','created_at', 'updated_at')
            ->where('role','cabet')
            ->get();

        $q = [];
        $users_array = [0 =>  $table];

        for ($i=0; $i < count($users_array[0]); $i++) { 
            $name = json_decode(json_encode($users_array[0][$i]), true)['name'];

            $classes = DB::table("cabets")
                ->where(DB::raw('CONCAT_WS(`monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`)'), 'LIKE', "%$name%")
                ->get();

            $s = 0;
            $array = [0 => $classes];
            for ($i2=0; $i2 < count($array[0]); $i2++) {
                // json_decode(json_encode($array[0][$i]), true)["monday"];
                if(json_decode(json_encode($array[0][$i2]), true)["monday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["tuesday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["wednesday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["thursday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["friday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["saturday"] ==  $name) {
                    $s++;
                }
                if(json_decode(json_encode($array[0][$i2]), true)["sunday"] ==  $name) {
                    $s++;
                }
            }
            array_push($q, $s);
        }

        return response([
            "table" => $table,
            "name" => $user['name'],
            "classes" => $q
        ], 200);
    }
}
