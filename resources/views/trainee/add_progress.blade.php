@extends('trainee.forms.layout')
<title>Progress Tracker</title>
@section('form')
@push('admin-uname')
{{-- {{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
@endpush
    <h2>Record Measurements</h2>
                    <div class = "col-md-12 alert-message" id="alert-message">
                    @include('admin.layouts.message')
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="weight" class="col-sm-3 col-form-label">Weight</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="weight" value="{{ old('weight') }}" id="weight" placeholder="eg. 50">
                          <span style="color: red;"> @error('weight'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="chest" class="col-sm-3 col-form-label">Chest</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="chest" value="{{ old('chest') }}" id="chest" placeholder="eg. 12">
                          <span style="color: red;"> @error('chest'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="biceps" class="col-sm-3 col-form-label">Biceps</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="biceps" value="{{ old('biceps') }}" id="biceps" placeholder="eg. 5">
                          <span style="color: red;"> @error('bicpes'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="stomach" class="col-sm-3 col-form-label">Stomach</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="stomach" value="{{ old('stomach') }}" id="stomach" placeholder="eg. 8">
                          <span style="color: red;"> @error('stomach'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="waist" class="col-sm-3 col-form-label">Waist</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="waist" value="{{ old('waist') }}" id="waist" placeholder="eg. 5">
                          <span style="color: red;"> @error('waist'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="hip" class="col-sm-3 col-form-label">Hip</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="hip" value="{{ old('hip') }}" id="hip" placeholder="eg. 2">
                          <span style="color: red;"> @error('hip'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="thigh" class="col-sm-3 col-form-label">Thigh</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="thigh" value="{{ old('thigh') }}" id="thigh" placeholder="eg. 5">
                          <span style="color: red;"> @error('thigh'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="calves" class="col-sm-3 col-form-label">Calves</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="calves" value="{{ old('calves') }}" id="calves" placeholder="eg. 2">
                          <span style="color: red;"> @error('calves'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="btn btn-warning">Store Progress</button>

@endsection