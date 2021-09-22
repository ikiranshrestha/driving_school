@extends('admin.forms.layout')
<title>Add New Course</title>
@section('form')
    <h2>Add Course Type</h2>
    <p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="course_type" class="col-sm-3 col-form-label">Course Type</label>
                          <div class="col-sm-9">
                          <input type="course_type" class="form-control" name="course_type" id="course_type" placeholder="eg. Motorcycle [Vehicle Type]">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label">Vehicle Category</label>
                          <div class="col-sm-9">
                            <input type="vehicle_category" class="form-control" name = "vehicle_category" id="vehicle_category" placeholder="eg. for Motorcycle - 'A'">
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