@extends('admin.forms.layout')
<title>Add New Course</title>
@section('form')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
  <h2>Add Course</h2>
  <p class="card-description">
                    Course info
                  </p>
                  <div class = "col-md-12 alert-message" id="alert-message">
                  @include('admin.layouts.message')
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Course Type</label>
                        <div class="col-sm-9">
                        <input type="name" class="form-control" name="name"  value="{{ old('name') }}" id="name" placeholder="eg. Cardiovascular [Workout Type]">
                        <span style="color: red;"> @error('name'){{$message}} @enderror </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                      <label for="course" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <input type="textbox" class="form-control" name = "description"  value="{{ old('description') }}" id="description" placeholder="eg. for Motorcycle - 'A'">
                          <span style="color: red;"> @error('description'){{$message}} @enderror </span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row">
                      <label for="equipments" class="col-sm-3 col-form-label">Equipments</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="equipments" name="equipments" value="{{old('equipments')}}" placeholder="eg. Khatri0b3d020d">
                          <span style="color: red">@error('equipments'){{$message}} @enderror</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                      <label for="intensity" class="col-sm-3 col-form-label">intensity</label>
                        <div class="col-sm-9">
                          <select name="intensity" id="intensity" class="form-control intensity">
                            <option selected disabled>Select your Intensity</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                                <option value="4">Extreme</option>
                          </select>
                          <span style="color: red">@error('e_cid'){{$message}} @enderror</span>
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