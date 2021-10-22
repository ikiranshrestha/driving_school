@extends('admin.forms.layout')
<title>Add New Course</title>
@section('form')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
    <h2>Add Package</h2>
    <p class="card-description">
                      Course info
                    </p>
                    <div class = "col-md-12 alert-message" id="alert-message">
                    @include('admin.layouts.message')
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_name" class="col-sm-3 col-form-label">Package Name</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" name="p_name" value="{{ old('p_name') }}" id="p_name" placeholder="eg. 15 Days Zero to Hero Motorcycle">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label">Course</label>
                          <div class="col-sm-9">
                            <select name="p_cid" id="p_cid" class="form-control">
                                <option disabled selected>Select Course</option>
                                @foreach($courseList as $course)

                                    <option value="{{$course->id}}">{{$course->course_type}}</option>

                                @endforeach
                            </select>
                            <span style="color: red;"> @error('p_cid'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_duration" class="col-sm-3 col-form-label">Package Duration</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="p_duration"  value="{{ old('p_duration') }}" id="p_duration" placeholder="eg. 15">
                          <span style="color: red;"> @error('p_duration'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_cost" class="col-sm-3 col-form-label">Vehicle Category</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name = "p_cost"  value="{{ old('p_cost') }}" id="p_cost" placeholder="eg. 5000">
                            <span style="color: red;"> @error('p_cost'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="submit" value="Add" name="add" class="btn btn-success">
                          </div>
                        </div>
                      </div>
                  </div>

@endsection