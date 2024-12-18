@extends('layouts.app')
<style>
    /* Custom Styles for Dropdown */
    #apppackagename {
        width: 100%; /* Make dropdown take full width */
        padding: 10px; /* Add padding for better size */
        border-radius: 4px; /* Rounded corners */
        border: 1px solid #ccc; /* Subtle border */
        margin-bottom: 20px;
    }

    /* Label styling */
    label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Table styling */
    #category_table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff; /* White background for the table */
    }

    #category_table th,
    #category_table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid #ddd; /* Light gray border */
    }

    #category_table th {
        background-color: #f4f4f4; /* Light gray background for header */
        color: #333; /* Dark text color */
        font-weight: bold;
    }

    #category_table tr:nth-child(even) {
        background-color: #fafafa; /* Slightly lighter gray for even rows */
    }

    #category_table tr:hover {
        background-color: #f1f1f1; /* Subtle hover effect */
    }

    /* Styling for "No data available" message */
    .no-feedback {
        text-align: center;
        padding: 20px;
        color: #888;
        font-size: 1rem;
    }

    /* Responsive table design */
    @media (max-width: 768px) {
        #category_table th, #category_table td {
            padding: 8px 10px;
        }
    }

    /* Error message styling */
    .text-danger {
        font-size: 0.875rem;
        margin-top: 5px;
    }
</style>
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Feedback Details</h1>

                <!-- Success Message Display -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Select Package Dropdown -->
                <div class="row">
                    <label for="apppackagename" class="col-form-label col-md-2 tw-font-semibold">Select Package:</label>
                    <div class="col-md-4">
                        <select name="apppackagename" id="apppackagename">
                            <option value="">Select a Package Name</option>
                            @foreach($fetchfeedbackdata as $id => $apppackagename)
                                <option value="{{ $id }}">{{ $apppackagename }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Feedback Table -->
                <div class="row mt-4">
                    <table id="category_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Package Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="packageData">
                            <!-- Fetched data will be inserted here dynamically -->
                        </tbody>
                    </table>

                    <!-- No Data Available Message -->
                    <div class="no-feedback" id="noFeedbackMessage" style="display: none;">
                        No data available
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Initial display state: Show "No data available" if no package is selected
        $('#noFeedbackMessage').show(); // Show the message initially

        // When a package is selected
        $('#apppackagename').change(function() {
            var id = $(this).val();  // Get selected package ID
            
            if (id) {
                // Make an AJAX request to fetch data for the selected package
                $.ajax({
                    url: "{{ route('feedback.fetch') }}",  // Your route to handle this request
                    type: 'GET',
                    data: { id: id },
                    success: function(response) {
                        // Handle the response here
                        if (response.success) {
                            // Populate the table body with the fetched rows
                            $('#packageData').html(response.data);
                            $('#noFeedbackMessage').hide(); // Hide the "No data" message if feedback is available
                        } else {
                            // If no data is found, show a message in the table
                            $('#packageData').html('');
                            $('#noFeedbackMessage').text('No feedback found for this package.').show();
                        }
                    },
                    error: function() {
                        // Handle AJAX error
                        alert('Error fetching data.');
                    }
                });
            } else {
                // If no package is selected, clear the table and show the "No data available" message
                $('#packageData').html('');
                $('#noFeedbackMessage').text('No data available').show(); // Show the "No data" message
            }
        });
    });
</script>

@endsection






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
    //     // Ensure the package name is passed
    //     $data = $request->input('id');

    //         // Fetch feedback related to the selected package
    //         $feedbacks = FeedbackSystem::where('id', $data)->get();
    //         // $feedbacks = $feedbacks->unique(function ($item) {
    //         //     return $item->email . '-' . $item->message;
    //         // });
    
    //         // Return the feedback data as a JSON response
    //         return response()->json(['data' => $feedbacks]);
        
    
    //     // If no package is selected, return an empty response
    //     return response()->json(['data' => []]);
    // }
    $packageId = $request->input('id');

    // Assuming you have a Feedback model where each feedback is related to a package
    // You may need to adjust this according to your actual data structure
    $feedbacks = FeedbackSystem::where('id', $packageId)->get();  // Adjust the relation as needed

    if ($feedbacks->isEmpty()) {
        return response()->json([
            'success' => false,
            'data' => '<tr><td colspan="4">No feedback found for this package.</td></tr>',
        ]);
    }

    // Prepare the HTML for table rows
    $tableRows = '';
    foreach ($feedbacks as $feedback) {
        $tableRows .= "<tr>
            <td>{$feedback->id}</td>
             <td>{$feedback->apppackagename}</td>
            <td>$feedback->email </td>
            <td>{$feedback->message}</td>
            <td>{$feedback->created_at->format('Y-m-d H:i:s')}</td>
        </tr>";
    }

    return response()->json([
        'success' => true,
        'data' => $tableRows,  // Return the table rows as HTML
    ]);
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
