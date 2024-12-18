<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FeedbackSystem;

class FeedbackSystemController extends Controller
{
    //

    public function feedbackstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apppackagename' => 'required',
            'email' => 'required', 
            'message' => 'required',  
 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);  
        }   
           $data = $request->all();
          $feedback = FeedbackSystem::create($data);
          return response()->json([
         'message' => 'Feedback successfully submitted.',
          'feedback' => $feedback,
         ], 200);
}

}
