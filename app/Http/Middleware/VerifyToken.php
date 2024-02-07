<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Application_settings;
use Carbon\Carbon;

class VerifyToken {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        try {

            $headers = \Request::header();

            $bearerToken = $request->api_key; //\Request::bearerToken(); //$request->bearerToken(); 
            if (empty($bearerToken)) {
                //$bearerToken = $request->api_token;
                return response()->json(array('status' => 'false', 'message' => "API Key is empty", 'code' => 700), 200);
                //echo json_encode(array('status' => 'false', 'message' => trans('client.empty_api_token'), 'code' => 700));
                //exit;
            }

            $res = $this->verifyToken($bearerToken);
            if ($res['code'] != 200) {
                return response()->json(array('status' => 'false', 'message' => $res['message'], 'code' => $res['code']), 200);
                //echo json_encode(array('status' => 'false', 'message' => $res['message'], 'code' => $res['code']));
                ///exit;
            }
        } catch (\Exception $e) {
            return array('code' => 500, 'message' => $e->getMessage(), 'status' => 'faile');
            //echo json_encode(array('status'=>'faile','message'=>$e->getMessage(),'code'=>500)); 
            ///exit;
        }



        return $next($request);
    }

    public function verifyToken($bearerToken) {

        try {
            //die("keu : ".$bearerToken);
            $result = DB::table('users')->where(array('api_key' => $bearerToken));
            if ($result->count() > 0) {
                return array('code' => 200, 'message' => "");
            }
            return array('code' => 710, 'message' => "Unauthorized");
        } catch (\Exception $e) {
            //return response()->json(array('status' => 'false', 'message' => $e->getMessage(), "data" => array('error' => $e->getMessage())), 200);
            //echo json_encode(array('status' => 'false', 'message' => $e->getMessage(), "data" => array('error' => $e->getMessage())));
            //exit;
            return array('code' => 700, 'message' => $e->getMessage());
        }
    }

}
