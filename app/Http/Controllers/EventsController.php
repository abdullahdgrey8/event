<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
}    