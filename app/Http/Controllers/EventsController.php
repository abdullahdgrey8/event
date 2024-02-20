<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Events;
use App\Models\Candidates;
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
            ->select(['id', 'event_code', 'event_name', 'description', 'start_date', 'end_date', 'status', 'slug', 'created_at']);

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
            $event_param=$aRow->event_code;
            $id = $aRow->id;

           // $qr_url = $aRow->url;
            $view_url= route("viewCandidates",['event_id'=>$id]); //$baseUrl . '/candidates/' . $event_param;

            $qr_code = '<a class="qr-code open-modal" data="' . $id . '" href="javascript:void(0)"><img src="assets/images/qrcode.png" /></a>
            
';

            $editLink = $baseUrl . '/add-event/' . $id;

            $sOptions = '<div class="edit-action">
    <div class="icon">
    <a href="' . $view_url . '">
    <i class="fa-regular fa-eye"></i>
    </a>
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
    function eventCandidates(Request $request){
        $candidateId = $request->route('id');
        $candidates = Candidates::where('event_id', $candidateId)->get();
        // Check if any candidates were found
        if ($candidates->isEmpty()) {
            return view('noCandidateView');
            // return response()->json(['message' => 'No candidates found for the specified event ID.'], 404);
        }    
        return view('viewCandidates', ['candidates' => $candidates]);
        //noCandidateView.blade.php

    }
    public function viewCandidates($event_id)
    {
        $test = '';
        
        $rs = Events::where('id',$event_id);
        if($rs->count()>0){
            $event_row = $rs->first();
            return view('viewCandidates', compact('event_id','event_row'));
        }else{
            die("event does not exist");
            return view('404');
        }
        
    }
     public function getAllCandidates(Request $request)
    {

        $event_id = $request->input('event_id');
        /*echo '<pre>';
        print_r($request->all());
        exit;
        */
        $aColumns = ['candidates.name','candidates.email', 'categories.name','candidates.resume','candidates.created_at'];
        $result = DB::table('candidates')->join('categories','candidates.category_id','categories.id')->where('candidates.event_id',$event_id)
            ->select(['candidates.id','candidates.name', 'categories.name as category_name','candidates.email','candidates.resume','candidates.created_at']);

        
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
                $query->orWhere('candidates.id', 'LIKE', "%{$sKeywords}%")->orWhere('candidates.name', 'LIKE', "%{$sKeywords}%")
                    ->orWhere('candidates.email', 'LIKE', "%{$sKeywords}%"); //billers.name
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

            // $route = route('downloadResume',['id'=> $id]);
            $route= route("downloadResume",['id'=>$id]);
            $resume = '<a target="_blank" href="'.$route.'">Download Resume</a>';
            $created_at = date("M j, Y, g:i a", strtotime($aRow->created_at));
            
            $output['aaData'][] = array(                
                @utf8_encode($aRow->name),
                @utf8_encode($aRow->email),
                @utf8_encode($aRow->category_name),
                @utf8_encode($resume),
                @utf8_encode($created_at)
            );
            /// $i++;
        }

        echo json_encode($output);
    }
    

    public function downloadResume($id)
    {
        // Fetch the candidate by ID
      
        $result= DB::table('candidates')->where('id', $id);
        if ($result->count() > 0) {

           $row = Candidates::findOrFail($id);
           $path = config('app.resumes') . $row->event_id;
           $file_name = $row->resume;
           $file = $path .'/'. $file_name; 
        //    $file = '/path/to/your/file.pdf';

// Check if the file exists
if (file_exists($file)) {
    // Set headers to force download
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    // Output the file
    readfile($file);
    exit;
} else {
    // File not found
    die('File not found.');
}
        }else{
            view('404');
        }
    }


    public function getAllCandidates2(Request $request)
    {

      
        $event_id = $request->event_id;
        /*echo '<pre>';
        print_r($request->all());
        exit;
        */
        $aColumns = ['candidates.id','candidates.name','candidates.email', 'categories.name','candidates.resume','candidates.created_at'];
        $result= DB::table('candidates')
                ->join('categories', 'candidates.category_id','categories.id')
                ->where('candidates.event_id',$event_id)
                ->select('candidates.id','candidates.name','candidates.email', 'categories.name as category_name','candidates.resume','candidates.created_at');
        
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
            ///$aColumns = ['candidates.id','candidates.name','candidates.email', 'categories.name','candidates.resume','candidates.created_at'];
            $result->Where(function ($query) use ($sKeywords) {
                $query->orWhere('candidates.id', 'LIKE', "%{$sKeywords}%")->orWhere('candidates.name', 'LIKE', "%{$sKeywords}%")
                    ->orWhere('andidates.email', 'LIKE', "%{$sKeywords}%")->orWhere('categories.name', 'LIKE', "%{$sKeywords}%"); //billers.name
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
        $salesData = $result->get();

        $output = array(
            "sEcho" => intval($request->get('sEcho')),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );
        // echo '<pre>';
        // print_r($salesData);
        // exit;
        
        foreach ($salesData as $aRow) {
             $id = $aRow->id;
             $created_at = date("M j, Y, g:i a", strtotime($aRow->created_at));            
             $output['aaData'][] = array(                
                //$id,
                @utf8_encode($aRow->name),
                @utf8_encode($aRow->email),
                @utf8_encode($aRow->category_name),
                @utf8_encode($aRow->resume),
                @utf8_encode($created_at)
            );
        echo json_encode($output);
    }
}
}