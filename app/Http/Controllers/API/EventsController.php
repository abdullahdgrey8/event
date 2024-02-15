<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Categories;
use App\Models\Events;

class EventsController extends BaseController {


    public function getEventByName(Request $request) {
        try {
            $rs = Events::where(array(
                        'status' => 1,
                        'slug' => $request->name,
            ));
            $row = array();
            if ($rs->count() > 0) {
                $status = 'success';
                $message = "";
                $row = $rs->first();
            } else {
                $status = 'not-exist';
                $message = "event does't exist";
            }
            return response()->json([
                        'status' => $status,
                        'message' => $message,
                        'data' => $row
                            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                        'status' => 'Exception',
                        'message' => $e->getMessage(),
                            ], 500);
        }
    }

}
