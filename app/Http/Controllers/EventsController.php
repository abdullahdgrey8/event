<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Events;

class EventsController extends Controller
{
     public function viewEvents(){
        $test= '';


        return view('view-all-events', compact('test'));
     }
     public function getAllEvents(Request $request) {

        $event_code = $request->input('event_code');
        $event_name = $request->input('event_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');
        
        $aColumns = ['id', 'event_code', 'event_name','description','start_date', 'end_date','status'];
        $result = DB::table('events')            
                ->select(['id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status','qrcode','url','created_at']);
    
        if ($event_code)
            $result->where('event_code', $event_code);
    
        if ($event_name)
            $result->where('event_name', $event_name);
    
        if ($start_date) {
            $result->where('start_date', $start_date);
        }
        if ($end_date) {
            $result->where('end_date',  $end_date);
        }
        if ($status) {
            $result->where('status',  $status);
        }
    
    
        $iStart = $request->get('iDisplayStart');
        $iPageSize = $request->get('iDisplayLength');
        // $sOrder='';
        if ($request->get('iSortCol_0') != null) { //iSortingCols
            $sOrder = "ORDER BY  ";
    
            for ($i = 0; $i < intval($request->get('iSortingCols')); $i++) {
                if ($request->get('bSortable_' . intval($request->get('iSortCol_' . $i))) == "true") {
                    $sOrder .= $aColumns[intval($request->get('iSortCol_' . $i))] . " " . $request->get('sSortDir_' . $i) . ", ";
                }
            }
    
            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = " id ASC";
            }
        }
        //echo $sOrder; 
        $OrderArray = explode(' ', $sOrder);
        
        
        $sKeywords = $request->get('sSearch');
        if ($sKeywords != "") {
            //$aColumns = ['sales.id', 'sales.created_at', 'sales.reference_no', 'couriers.name', 'customers.name','sales.sale_status','sales.payment_status','deliveries.status','sales.grand_total'];
            $result->Where(function ($query) use ($sKeywords) {
                $query->orWhere('id', 'LIKE', "%{$sKeywords}%")->orWhere('event_code', 'LIKE', "%{$sKeywords}%")
                        ->orWhere('event_name', 'LIKE', "%{$sKeywords}%")->orWhere('description', 'LIKE', "%{$sKeywords}%"); //billers.name
            });
        }
    
        for ($i = 0; $i < count($aColumns); $i++) {
            $request->get('sSearch_' . $i);
            if ($request->get('bSearchable_' . $i) == "true" && $request->get('sSearch_' . $i) != '') {
                $result->orWhere($aColumns[$i], 'LIKE', "%" . $request->orWhere('sSearch_' . $i) . "%");
            }
        }
    
    
        $iFilteredTotal = $result->count();
        $iTotal = $iFilteredTotal;
        if ($iStart != null && $iPageSize != '-1') {
            $result->skip($iStart)->take($iPageSize);
        }
        
        $order = trim($OrderArray[3]);
        $sort = trim($OrderArray[4]);
        
        
        $result->orderBy($order, trim($sort));
        //$result->orderBy("id", "DESC");
        $salesData = $result->get();
    
        $output = array(
            "sEcho" => intval($request->get('sEcho')),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
    
        foreach ($salesData as $aRow) {
            $id = $aRow->id;
            
            $sOptions = 'Edit';
            $created_at = date("M j, Y, g:i a", strtotime($aRow->created_at));
            $start_date = date("M j, Y, g:i a", strtotime($aRow->start_date));
            $end_date= date("M j, Y, g:i a", strtotime($aRow->end_date));
            $status= $aRow->status==0 ? 'Inactive':'active';
            
            //'id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status','qrcode','url'
            $output['aaData'][] = array(
                $id,                
                @utf8_encode($aRow->event_code),
                @utf8_encode($aRow->event_name),
                @utf8_encode($aRow->description),                
                @utf8_encode($start_date),
                @utf8_encode($end_date),
                @utf8_encode($status),
                @utf8_encode($aRow->qrcode),
                @utf8_encode($aRow->url),
                $sOptions
            );
            ///  $i++;
        }
    
        echo json_encode($output);
    }

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