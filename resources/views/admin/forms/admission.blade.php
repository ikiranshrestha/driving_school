@extends('admin.forms.layout')


@php
$maxDate = date('Y-m-d', strtotime('-16 year'));
@endphp

@section('form')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
<p class="card-description">
                      Personal info
                    </p>
                    <div class="col-md-12 alert-message" id="alert-message">
                    @include('admin.layouts.message')
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" placeholder="eg. Ram">
                            <span style="color: red;"> @error('fname'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="mname" class="col-sm-3 col-form-label">Middle Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="mname" name="mname" value="{{ old('mname') }}" placeholder="eg. Bahadur">
                            <span style="color: red;"> @error('mname'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" placeholder="eg. Khatri">
                            <span style="color: red;"> @error('lname'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="dob" class="col-sm-3 col-form-label">Date of Birth</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}" max="{{$maxDate;}}">
                            <span style="color: red;"> @error('dob'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="fname" name="email" value="{{ old('email') }}" placeholder="eg. khatriram55@gmail.com">
                            <span style="color: red;"> @error('email'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="phone" class="col-sm-3 col-form-label">Phone Number</label>
                          <div class="col-sm-9">
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="eg. 9800000000">
                            <span style="color: red;"> @error('phone'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label for="bloodgroup" class="col-sm-3 col-form-label">Blood Group</label>
                          <div class="col-sm-9">
                            <select name="bloodgroup" id="bloodgroup" name="bloodgroup" value="{{ old('bloodgroup') }}" class="form-control">
                              <option selected disabled>Select your blood group</option>
                              <option value="a-pos">A+</option>
                              <option value="a-neg">A-</option>
                              <option value="b-pos">B+</option>
                              <option value="b-neg">B-</option>
                              <option value="o-pos">O+</option>
                              <option value="o-neg">O-</option>
                              <option value="ab-pos">AB+</option>
                              <option value="ab-neg">AB-</option>
                            </select>
                            <span style="color: red;"> @error('bloodgroup'){{$message}} @enderror </span>
                          </div>
                        </div>
                      </div>
                    </div>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <div class="col-sm-9">
                            <input type="submit" value="Admit" name="admit" class="btn btn-success">
                          </div>
                        </div>
                      </div>
                  </div>
@endSection

<script src="{{url('admin/js/custom/message-alert-timeout.js')}}"></script>