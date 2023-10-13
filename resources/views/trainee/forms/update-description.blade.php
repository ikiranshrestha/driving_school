@extends('trainee.forms.layout')

@section('title')
    <title>Update Description</title>
@endsection

@section('form')
    @push('admin-uname')
        {{-- {{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
    @endpush

    <h2>Record Measurements</h2>
    
    <div class="col-md-12 alert-message" id="alert-message">
        @include('admin.layouts.message')
    </div>
    
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('trainee.description.update.process') }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Description</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="description" value="{{ $description }}" id="description" placeholder="I want to increase my strength.">
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Store</button>
            </form>
        </div>
    </div>
@endsection
