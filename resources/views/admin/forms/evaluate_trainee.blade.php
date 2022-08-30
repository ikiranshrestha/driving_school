@extends('admin.forms.layout')
<title>Evaluate Trainee</title>
@section('form')
@push('admin-uname')
{{-- {{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
@endpush
    <h2>Evaluate Trainee</h2>
    <p class="card-description">
                      Marking
                    </p>
                    <div class = "col-md-12 alert-message" id="alert-message">
                    @include('admin.layouts.message')
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="rounds" class="col-sm-3 col-form-label">Number of Rounds</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="rounds" value="{{ old('p_name') }}" id="rounds" placeholder="eg. 5">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="eight_boundary_violations" class="col-sm-3 col-form-label">8 Boundary Violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="eight_boundary_violations" value="{{ old('p_name') }}" id="eight_boundary_violations" placeholder="eg. 2">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="foot_on_ground" class="col-sm-3 col-form-label">Foot on ground</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="foot_on_ground" value="{{ old('p_name') }}" id="foot_on_ground" placeholder="eg. 5">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="side_light_violation" class="col-sm-3 col-form-label">Side-light violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="side_light_violation" value="{{ old('p_name') }}" id="side_light_violation" placeholder="eg. 2">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="traffic_light_violation" class="col-sm-3 col-form-label">Traffic light violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="traffic_light_violation" value="{{ old('p_name') }}" id="traffic_light_violation" placeholder="eg. 5">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="ramp_boundary_violation" class="col-sm-3 col-form-label">Ramp boundary violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="ramp_boundary_violation" value="{{ old('p_name') }}" id="ramp_boundary_violation" placeholder="eg. 2">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="engine_stoll" class="col-sm-3 col-form-label">Engine Stoll</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="engine_stoll" value="{{ old('p_name') }}" id="engine_stoll" placeholder="eg. 5">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="uphill_boundary_violation" class="col-sm-3 col-form-label">Uphill boundary violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="uphill_boundary_violation" value="{{ old('p_name') }}" id="uphill_boundary_violation" placeholder="eg. 2">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="downnhill_boundary_violation" class="col-sm-3 col-form-label">Downhill boundary violation</label>
                          <div class="col-sm-9">
                          <input type="number" class="form-control" name="downnhill_boundary_violation" value="{{ old('p_name') }}" id="downnhill_boundary_violation" placeholder="eg. 5">
                          <span style="color: red;"> @error('p_name'){{$message}} @enderror </span>
                          <input type="hidden" class="form-control" name="trainee_id" id="trainee_id" value="{{ request('id') }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-warning">Store Progress</button>

@endsection