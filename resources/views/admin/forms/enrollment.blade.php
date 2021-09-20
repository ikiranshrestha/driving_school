@extends('admin.forms.layout')

@section('form')

<div class="form-group row">
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
              <!-- <option selected default>Select Course type</option>
                <option value="a">Motorcycle</option>
                <option value="k">Scooter</option>
                <option value="p">Moped</option>
                <option value="b">Car</option>
                <option value="o-pos">Tempo</option>
                <option value="d">Bus</option>
                <option value="f">Tractor</option>
                <option value="H">JCB/ Road Roller/ Construction Vehicles</option> -->
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

@endsection