<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileUserController extends Controller
{
    public function index() {
        $user = auth()->user();

        $table = DB::table("users")
            ->select('id', 'name', 'username', 'username','role', 'incpector','created_at', 'updated_at')
            ->where('id',$user['id'])
            ->get();
        
        $s = 0;
        $users_array = [0 =>  $table];
        
        for ($i=0; $i < count($users_array[0]); $i++) { 
            $name = json_decode(json_encode($users_array[0][$i]), true)['name'];

            $classes = DB::table("cabets")
                ->where(DB::raw('CONCAT_WS(`monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`)'), 'LIKE', "%$name%")
                ->get();

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
        }
        
        return response([
            "name"=> $user['name'],
            "incpector"=> $user['incpector'],
            "classes" => $s
        ], 200);
    }
}
