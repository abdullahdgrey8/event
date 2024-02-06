<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use Auth;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\EventListens;


class EventController extends Controller
{
    public function store(Request $request)
    { 
        // Validate the request
        $request->validate([
            'event_name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required',
        ]);
        $user = Auth::user();
        $data = array(
            'event_name'=>$request->event_name,
            'description'=>$request->description,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'status'=>$request->status,
            'user_id'=>$user->id,
            'qrcode'=>$this->generateRandomString(10),
            'event_code'=>$this->generateRandomString(10),
            'url' => 'https://example.com'
        );
        
        if($request->id>0){
            $event = Events::find($request->id);
        }else{
            $event = new Events;
        }
        $event->fill($data);
        /*$event->event_name = $request->event_name;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->status = $request->status;
        $event->user_id = $user->id;
        $event->qrcode = $this->generateRandomString(10);
        $event->event_code = $this->generateRandomString(10);
        */
        $event->save();

        return response()->json(['success' => true]);
    }

    public function addEvent($id = 0)
    {

        // return view("createevent",compact($id));
        $row = array();
        if($id>0){
            $rs = DB::table("events")->where('id',$id);
            if($rs->count()>0){
                $row = $rs->first();
            }else{
                die("record does not exist");
            }
        }
        return view('createevent')->with(compact('id','row'));
    }
    function generateRandomString($length = 10) {
        // Define the character set from which to generate the random string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        
        // Generate random characters until the desired length is achieved
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomString;
    }

  

}