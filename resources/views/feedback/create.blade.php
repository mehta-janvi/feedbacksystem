@extends('layouts.app')

@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add FeedBack</h4>
            <!-- Form with POST method and CSRF token -->
            <form class="forms-sample" method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- App Package Name Field -->
                <div class="form-group col-sm-8">
                    <label for="apppackagename">App Package Name</label>
                    <input type="text" class="form-control @error('apppackagename') is-invalid @enderror" name="apppackagename" placeholder="Enter App Package Name" >
                    @error('apppackagename')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-group col-sm-8">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Message Field -->
                <div class="form-group col-sm-8">
                    <label for="message">Message</label>
                    <input type="text" class="form-control @error('message') is-invalid @enderror" name="message" placeholder="Enter Message" >
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
