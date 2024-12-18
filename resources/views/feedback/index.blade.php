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
        word-wrap: break-word; /* Allow long text to wrap */
        white-space: normal; /* Ensure text wraps in the cells */
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

    /* Prevent overflow in date cell */
    #category_table td:last-child {
        white-space: nowrap; /* Prevent date from wrapping */
        overflow: hidden;
        text-overflow: ellipsis; /* Add ellipsis if content overflows */
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

    /* Adjust table column widths */
    #category_table th:nth-child(1),
    #category_table td:nth-child(1) {
        width: 60px; /* Make ID column smaller */
    }

    #category_table th:nth-child(2),
    #category_table td:nth-child(2) {
        width: 250px; /* Increase Package Name column width */
    }

    #category_table th:nth-child(3),
    #category_table td:nth-child(3) {
        width: 150px; /* Adjust Email column width */
    }

    #category_table th:nth-child(4),
    #category_table td:nth-child(4) {
        width: auto; /* Allow the Message column to auto adjust */
    }

    #category_table th:nth-child(5),
    #category_table td:nth-child(5) {
        width: 120px; /* Adjust Date column width */
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
                            @foreach($fetchfeedbackdata as $apppackagename)
                                <option value="{{ $apppackagename }}">{{ $apppackagename }}</option>
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
            var appPackageName = $(this).val();  // Get selected package name
            if (appPackageName) {
                // Make an AJAX request to fetch data for the selected package
                $.ajax({
                    url: "{{ route('feedback.fetch') }}",  // Your route to handle this request
                    type: 'GET',
                    data: { apppackagename: appPackageName }, // Send the selected package name
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
