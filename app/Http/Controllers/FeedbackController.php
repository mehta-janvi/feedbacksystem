<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FeedbackSystem;

class FeedbackController extends Controller
{
    //
    public function index()
    {
        // $fetchfeedbackdata = FeedbackSystem::pluck('apppackagename','id');
        $fetchfeedbackdata = FeedbackSystem::pluck('apppackagename', 'id')->unique();

        return view('feedback.index',compact('fetchfeedbackdata'));
    }


public function fetchFeedback(Request $request)
{
    // Get the selected package name from the request
    $packageName = $request->input('apppackagename'); 

    // Debugging to see if the correct package name is passed
    // dd($packageName); // Uncomment this line for debugging if needed

    if ($packageName) {
        // Fetch feedback data based on the selected package name
        $feedbackData = FeedbackSystem::where('apppackagename', $packageName)->get();

        if ($feedbackData->isNotEmpty()) {
            // Return the data in a table row format
            $data = '';
            foreach ($feedbackData as $feedback) {
                $data .= "<tr>
                            <td>{$feedback->id}</td>
                            <td>{$feedback->apppackagename}</td>
                            <td>{$feedback->email}</td>
                            <td>{$feedback->message}</td>
                            <td>{$feedback->created_at}</td>
                          </tr>";
            }
            return response()->json(['success' => true, 'data' => $data]);
        } else {
            return response()->json(['success' => false, 'data' => '']);
        }
    }

    return response()->json(['success' => false, 'data' => '']);
}


        public function create()
        {
            return view('feedback.create');
        }

        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'apppackagename' => 'required',
                'message' => 'required',  
            ]);
             // Check if validation fails
                if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
         }
         $data = $request->all();
         $feedback = FeedbackSystem::create($data);
         return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully!');

        }
}
