@extends('layouts.app')

@section('content')
<style>
    .view-all-feedback {
        color: white; /* Set text color to white */
        text-decoration: none; /* Remove underline if needed */
    }

    .view-all-feedback:hover {
        color: #f0f0f0; /* Optional: Change color on hover */
    }

    /* Add padding-top to the content-wrapper to create space from the top */
    .content-wrapper {
        padding-top: 40px; /* Adjust the space above the content */
    }

    /* Optional: You can also adjust the heading's margin-top */
    .welcome-heading {
        margin-top: 0px; /* Ensure no top margin is interfering */
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <!-- Apply the 'welcome-heading' class to the h3 -->
                        <h3 class="font-weight-bold welcome-heading">Welcome Admin Dashboard.</h3>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Total Feedback</p>
                            <p class="fs-30 mb-2">{{$feedback}}</p>
                            <a href="{{ route('feedback.index') }}" class="view-all-feedback">View All Feedback</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
