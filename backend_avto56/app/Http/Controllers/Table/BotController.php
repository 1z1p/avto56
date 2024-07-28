<?php

namespace App\Http\Controllers\Table;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BotRequest;
use DateTime;
use Illuminate\Support\Facades\DB;

class BotController extends Controller
{
    public function index(BotRequest $request) {
        $token = "7058641763:AAE6VIDUTsmR7eHcIXHEDdQGoswbRci7FaQ";
        $ddate = date("Y-m-d");
        $year = date("Y");
        $date = new DateTime($ddate);
        $week = $date->format("W");
        $response = $request->validated();

        if($week == 52) {
            $year++;
            $week = 1;
        } else {
            $week++;
        }

        if($response['weekNumber'] == $week and $response['year'] == $year) {
            $table_response_bot = DB::table('bot')
                ->select(['chatid'])
                ->where('name', $response['name'])
                ->get();
            $table_response_time = DB::table('cabets')
                ->select(['time'])
                ->where('id', $response['id'])
                ->get();
            $chatid = json_decode(json_encode($table_response_bot), true)[0]['chatid'];
            $time = json_decode(json_encode($table_response_time), true)[0]['time'];
            $_week = "";
            
            if($chatid) {
                if($response['week'] == 'monday') { $_week = "Понедельник"; } 
                if($response['week'] == 'tuesday') { $_week = "Вторник"; } 
                if($response['week'] == 'wednesday') { $_week = "Среда"; } 
                if($response['week'] == 'thursday') { $_week = "Четверг"; } 
                if($response['week'] == 'friday') { $_week = "Пятница"; } 
                if($response['week'] == 'saturday') { $_week = "Суббота"; } 
                if($response['week'] == 'sunday') { $_week = "Воскресенье"; } 

                $text = "Место овободилось в $_week на $time";

                $this->fetch($token, $text, $chatid);
                return response("Сообщение боту доставленно", 200);
            }
        }
    }

    public function fetch($token,$text,$chatid){
        $text=urlencode($text);	
        $url="https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatid."&parse_mode=HTML&text=".$text;
        @file_get_contents($url); 
    }
}
