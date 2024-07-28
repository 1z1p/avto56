<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VideoAllRequest;
use App\Http\Requests\VideoShowRequest;

class VideoController extends Controller
{
    public function index(VideoAllRequest $request) {
        $data = $request->validated();
        $type = $data['type'];

        $table = DB::table("video")
            ->select('id', 'name', 'image', 'type')
            ->where("type", $type)
            ->get();

        $q = [];
        for ($i=0; $i < count($table); $i++) { 
            $data =json_decode(json_encode($table[$i]),true);
            $image = $data["image"];
            array_push($q, [
                "id" => $data['id'],
                "name" => $data['name'],
                "image" => "http://192.168.1.163:8000/video/image/$image"
            ]);
        }
        return response($q, 200);
    }

    public function show(VideoShowRequest $request) {
        $data = $request->validated();
        $id = $data['id'];
        $table = DB::table("video")
            ->select('id', 'video')
            ->where("id", $id)
            ->get();
        $data =json_decode(json_encode($table[0]),true);
        $video = $data['video'];
    
        return response([[
            "id" => $data['id'],
            "video" => "http://192.168.1.163:8000/video/$video",
        ]], 200);
    }
}
