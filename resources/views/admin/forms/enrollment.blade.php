@extends('admin.forms.layout')

@section('form')

<p class="card-description">
                      Personal info
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="uname" placeholder="eg. Khatri0b3d020d">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label">Course</label>
                          <div class="col-sm-9">
                            <select name="course" id="course" class="form-control">
                              <option selected disabled>Select your Course</option>

                                @foreach($courseList as $course)

                                  <option value="{{$course->vehicle_category}}">{{$course->course_type}}</option>

                                @endforeach
                
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="package" class="col-sm-3 col-form-label">Package</label>
                          <div class="col-sm-9">
                          <select name="course" id="course" class="form-control">
                              <option selected disabled>Select your Package</option>

                                @foreach($courseList as $course)

                                  <option value="{{$course->vehicle_category}}">{{$course->course_type}}</option>

                                @endforeach
                
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="startdate" class="col-sm-3 col-form-label">Start Date</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" id="startdate" min="{{date('Y-m-d');}}">
                          </div>
                        </div>
                      </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="package" class="col-sm-3 col-form-label">Time</label>
                          <div class="col-sm-9">
                          <select name="course" id="course"  name="packagecost" class="form-control">
                              <option selected disabled>Select Time</option>

                                @foreach($timeList as $time)

                                  <option value="{{$time->id}}">{{$time->time}}</option>

                                @endforeach
                
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="startdate" class="col-sm-3 col-form-label">Package Cost</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value = "Rs. 5000" id="packagecost" name="packagecost" disabled readonly>
                          </div>
                        </div>
                      </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="offeredprice" class="col-sm-3 col-form-label">Offered Price</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="offeredprice" name="offeredprice">
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



{{--<div class="form-group row">
          <div class="col-sm-4">
            <label for="lastname" class="col-sm-6 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="uname" placeholder="eg. Khatri0b3d020d">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="course" class="col-sm-6 col-form-label">Course</label>
            <div class="col-sm-10">
              <select name="course" id="course" class="form-control">
                <option selected disabled>Select your Course</option>

              {--@if(isset($courseList))

              @foreach($courseList as $course)

                <option value="{{$course->vehicle_category}}">{{$course->course_type}}</option>

              @endforeach

              @endif--}
              
              </select>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <label for="email" class="col-sm-6 col-form-label">Package</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" placeholder="eg. khatriram55@gmail.com">
            </div>
          </div>
          <div class="col-sm-4">
            <label for="phone" class="col-sm-6 col-form-label" value="+977">Start Date</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="date" min="{{date('Y-m-d')}}">
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <label for="time" class="col-sm-6 col-form-label">Preferred Time</label>
            <div class="col-sm-10">
              <select name="time" id="time" class="form-control">
                <option selected disabled>Select your preferred time</option>
                
                @if(isset($timeList))
                  @foreach($timeList as $time)

                  <option value="{{$time->id}}">{{$time->time}}</option>

                  @endforeach 
                @endif

              </select>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-4">
            <input type="submit" value="Admit" name="admit" class="btn btn-success">
          </div>
        </div>
--}}

@endsection