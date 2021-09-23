@extends('admin.forms.layout')
<title>Add New Course</title>
@section('form')
    <h2>Add Course</h2>
    <p class="card-description">
                      Course info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_name" class="col-sm-3 col-form-label">Package Name</label>
                          <div class="col-sm-9">
                          <input type="text" class="form-control" name="p_name" id="p_name" placeholder="eg. 15 Days Zero to Hero Motorcycle">
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
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_duration" class="col-sm-3 col-form-label">Package Duration</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="p_duration" id="p_duration" placeholder="eg. 15">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="p_cost" class="col-sm-3 col-form-label">Vehicle Category</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name = "p_cost" id="p_cost" placeholder="eg. 5000">
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