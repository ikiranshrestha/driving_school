@extends('admin.forms.layout')
<title>Add New Course</title>
@section('form')
    <h2>Add Course Type</h2>
        <div class="form-group row">
          <div class="col-sm-4">
            <label for="course_type" class="col-sm-6 col-form-label">Course Type</label>
            <div class="col-sm-10">
              <input type="course_type" class="form-control" id="course_type" placeholder="eg. Motorcycle [Vehicle Type]">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="course_type" class="col-sm-6 col-form-label">Course Type</label>
            <div class="col-sm-10">
                <input type="vehicle_category" class="form-control" id="vehicle_category" placeholder="eg. for Motorcycle - 'A'">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <input type="submit" value="Add" name="add" class="btn btn-success">
          </div>
</div>

@endsection