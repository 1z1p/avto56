<?php

namespace App\Http\Controllers\Incpector;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\IncpectorRequest;

class IncpectorController extends Controller
{
    public function index() {
        $table = User::join('incpector', 'users.id', '=', 'incpector.user_id')
            ->select('users.id','users.name', 'image')
            ->get();
        $q = [];
        for ($i=0; $i < count($table); $i++) { 
            $image = $table[$i]['image'];
            array_push($q, [
                "id" => $table[$i]['id'],
                "name" => $table[$i]['name'],
                "image" => "http://192.168.1.163:8000/image/incpector/$image"
            ]);
        }
        
        return response($q, 200);
    }

    public function show(IncpectorRequest $request) {
        $user = auth()->user();
        $data = $request->validated();
        $id = $data['id'];
        $incpector = true;

        if($user["incpector"] != "default") {
            $incpector = false;
        }

        $table = User::join('incpector', 'users.id', '=', 'incpector.user_id')
            ->select('users.id','users.name', 'image', 'phone', 'telegram', 'number_car', 'mark')
            ->where("users.id", $id)
            ->get();

        $image = $table[0]['image'];
        
        return response([[
            "id" => $table[0]['id'],
            "name" => $table[0]['name'],
            "image" => "http://192.168.1.163:8000/image/incpector/$image",
            "phone" => $table[0]['phone'],
            "telegram" => $table[0]['telegram'],
            "number_car" => $table[0]['number_car'],
            "mark" => $table[0]['mark'],
            "incpetor_user" => $incpector
        ]], 200);
    }

    public function choose(IncpectorRequest $request) {
        $user = auth()->user();
        $data = $request->validated();
        $table = DB::table('users')
            ->select('incpector')
            ->where('id', $data['id'])
            ->get();
        $incpector =json_decode(json_encode($table[0]),true);
        $response = DB::table('users')
            ->where('id', $user['id'])
            ->update(['incpector' => $incpector['incpector']]);
        
        return response($response, 200);
    }
}
