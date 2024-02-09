<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Events;
// use Baconslug\Encoder\slug;

class EventsController extends Controller
{
    public function viewEvents()
    {
        $test = '';


        return view('view-all-events', compact('test'));
    }
    public function getAllEvents(Request $request)
    {

        $event_code = $request->input('event_code');
        $event_name = $request->input('event_name');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status = $request->input('status');

        $aColumns = ['id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status'];
        $result = DB::table('events')
            ->select(['id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status', 'slug', 'url', 'created_at']);

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
        $baseUrl = url('/');

        $url = config('app.forntend_url');
        foreach ($salesData as $aRow) {
            $id = $aRow->id;
            $qr_url = $aRow->url;
            $qr_code = '<a class="qr-code open-modal" data="' . $id . '" href="javascript:void(0)"><img src="assets/images/qrcode.png" /></a>
            
';

            $editLink = $baseUrl . '/add-event/' . $id;

            $sOptions = '<div class="edit-action">
    <div class="icon">
        <i class="fa-regular fa-eye"></i>
    </div>
    <div class="icon">
        <a href="' . $editLink . '"><i class="fa-solid fa-pencil"></i></a>
    </div>
</div>';


            $created_at = date("M j, Y, g:i a", strtotime($aRow->created_at));
            $start_date = date("M j, Y, g:i a", strtotime($aRow->start_date));
            $end_date = date("M j, Y, g:i a", strtotime($aRow->end_date));
            $status = $aRow->status == 0 ? 'Inactive' : 'active';

            //'id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status','slug','url'

            $output['aaData'][] = array(
                $id,
                @utf8_encode($aRow->event_code),
                @utf8_encode($aRow->event_name),
                @utf8_encode($aRow->description),
                @utf8_encode($start_date),
                @utf8_encode($end_date),
                @utf8_encode($status),
                @utf8_encode($qr_code),
                @utf8_encode($url."/".$aRow->slug),
                $sOptions
            );
            /// $i++;
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

        

        $existingEvent = Events::where('event_name', $request->event_name)->where('id','!=',$request->id)->first();
        if ($existingEvent) {
            // Event name is a duplicate, return response
            return response()->json(['duplicate' => true]);
        }

        $user = Auth::user();
        $data = array(
            'event_name' => $request->event_name,
            'description' => $request->description,
            'start_date' =>date("Y-m-d", strtotime($request->start_date)),
            'end_date' => date("Y-m-d", strtotime($request->end_date)),
            'status' => $request->status,
            'user_id' => $user->id,
            'slug' => $request->slug,
            ///'event_code' => $this->generateRandomString(10),
        );
      

        if ($request->id > 0) {
            $event = Events::find($request->id);
            $message = 'Event updated successfully';
        } else {
            $data['event_code']= $this->generateRandomString(10);
            $event = new Events;
            $message = 'Event created successfully';
        }
        $event->fill($data);
        $event->save();

        return response()->json(['success' => true,'message'=>$message]);
    }



    public function addEvent($id = 0)
    {

        // return view("createevent",compact($id));
        $row = array();
        if ($id > 0) {
            $rs = DB::table("events")->where('id', $id);
            if ($rs->count() > 0) {
                $row = $rs->first();
              //  echo '<pre>';
             //   print_r($row);
               // exit;
            } else {
                die("record does not exist");
            }
        }
        return view('createevent')->with(compact('id', 'row'));
    }
    function generateRandomString($length = 10)
    {
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
    function generateQRCode(Request $request){
        $id  =$request->event_id;
        $event = Events::find($id);
        return view('qrcode')->with(compact('event'));
        ///echo slug::size(300)->generate($evnet->url) ;
        //{!! slug::size(300)->generate('https://www.linkedin.com/in/abdullahkhalid533/') !!}
    }
}