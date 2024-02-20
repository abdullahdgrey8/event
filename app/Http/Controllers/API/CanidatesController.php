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
use App\Models\Candidates;

class CanidatesController extends BaseController {

    public function addCanidate(Request $request) {

        try {
            $param = [
                'event_id' => 'required|numeric',
                'category_id' => 'required|numeric',
                'name' => 'required',
                'email' => 'required',
                'resume' => 'required',
            ];

            $validator = Validator::make($request->all(), $param);
            if ($validator->fails()) {
                $messages = $validator->errors()->messages();
                return response()->json(array('status' => 'fail', 'message' => "validatio Failed", "data" => $messages, 'code' => 700), 200);
            }
            $rsEvents = Events::where('id', $request->event_id);
            if ($rsEvents->count() == 0) {
                $status = 'event_id_not_exist';
                $message = "invalid event";
                $code = 711;
                return response()->json(array('status' => $status, 'message' => $message, 'code' => $code), 200);
            }
            $rsCategories = Categories::where('id', $request->category_id);
            if ($rsCategories->count() == 0) {
                $status = 'category_id_not_exist';
                $message = "invalid category";
                $code = 710;
                return response()->json(array('status' => $status, 'message' => $message, 'code' => $code), 200);
            }

            if ($request->hasFile('resume')) {
                $validExtenstions = array('pdf', 'docs', 'docx', 'txt');
                $file = $request->file('resume');
                if ($file->isValid()) {
                    $path = config('app.resumes') . $request->event_id;
                    if (!file_exists($path)) {
                        mkdir($path, 0777, true);
                    }

                    $path .= '/';

                    $image_name = $request->file('resume')->getClientOriginalName();
                    $image_extension = $request->file('resume')->getClientOriginalExtension();
                    if (in_array($image_extension, $validExtenstions)) {
                        $fileName = time() . str_replace(" ", "_", $image_name);

                        if (!$file->move($path, $fileName)) {
                            $status = 'permission_error';
                            $code = 705;
                            $message = "permission Error";
                        } else {
                            $objCandidates = new Candidates();
                            $data = array(
                                'event_id' => $request->event_id,
                                'category_id' => $request->category_id,
                                'name' => $request->name,
                                'email' => $request->email,
                                'resume' => $fileName
                            );
                            $objCandidates->fill($data);
                            $objCandidates->save();
                            $code = 200;
                            $status = 'success';
                            $message = 'Your resume has been  succssfully sent';
                        }
                    } else {
                        $status = 'extension_fail';
                        $message = "invalid extensions";
                        $code = 706;
                    }
                } else {
                    $status = 'fail';
                    $message = "file is not valid";
                    $code = 707;
                }
            }

            return response()->json([
                        'status' => $status,
                        'message' => $message
                            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                        'status' => 'Exception',
                        'message' => $e->getMessage(),
                            ], 500);
        }
    }

    public function getCanidateCategories(Request $request) {

        try {
            $categories = Categories::get();
            return response()->json([
                        'status' => 'success',
                        'message' => "",
                        'categories' => $categories
                            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                        'status' => 'Exception',
                        'message' => $e->getMessage(),
                            ], 500);
        }
    }

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
                        'status' => 'success',
                        'message' => "",
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