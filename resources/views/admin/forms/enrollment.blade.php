@extends('admin.forms.layout')

@section('form')

<p class="card-description">
                      Personal info
                    </p>
                    <div class = "col-md-12 alert-message" id="alert-message">
                    @include('admin.layouts.message')
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="uname" name="uname" placeholder="eg. Khatri0b3d020d">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="course" class="col-sm-3 col-form-label">Course</label>
                          <div class="col-sm-9">
                            <select name="e_cid" id="course" class="form-control course">
                              <option selected disabled>Select your Course</option>

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
                        <label for="package" class="col-sm-3 col-form-label">Package</label>
                          <div class="col-sm-9">
                          <select name="e_pid" id="coursepackage" class="coursepackage form-control">
                            <option selected disabled>Select your Package</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="startdate" class="col-sm-3 col-form-label">Start Date</label>
                          <div class="col-sm-9">
                            <input type="date" name = "e_startdate" class="form-control" id="startdate" min="{{date('Y-m-d');}}">
                          </div>
                        </div>
                      </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="package" class="col-sm-3 col-form-label">Time</label>
                          <div class="col-sm-9">
                          <select name="e_tmid" id="time"  name="time" class="form-control">
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
                            <input type="text" class="form-control p_cost" value = "Rs. 5000" id="p_cost" name="p_cost" disabled readonly>
                          </div>
                        </div>
                      </div>
                  </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label for="offeredprice" class="col-sm-3 col-form-label">Offered Price</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="offeredprice" name="p_fee" placeholder="Price after Discount">
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

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){

    $(document).on('change', '.course', function(){
      // console.log("Changed");

      var cid = $(this).val();
      // console.log(id);
      var parentt = $(this).parent();
      var opt = " ";
      var optCost;
      $.ajax({
        type: 'GET',
        url: '{!!route("loadPackagesByCourse")!!}',
        data:{'id': cid},
        success: function(data){
          console.log('success');
          console.log(data.length);
          console.log(parentt);
          opt += '<option selected disabled>Select your Package</option>'
          if(data.length == 0)
          {
            opt += '<option disabled>No Packages Yet</option>'
          }
          for(var i=0; i<data.length; i++)
          {
            opt += '<option value="'+data[i].id+'">'+data[i].p_name+'</option>'
          }

          $(".coursepackage").html(" ");
          $(".coursepackage").append(opt);
        },
        error: function(){
          console.log('error');
        }
      });
    });

    $(document).on('change', '.coursepackage', function(){

      var pid = $(this).val();
      console.log(pid);

      $.ajax({
        type: 'GET',
        url: '{!!route("loadPackagePrice")!!}',
        data: {'id': pid},
        dataType: 'json',
        success: function(data){
          console.log("price");
          var p_cost = data[0].p_cost;
          console.log(data);
          $('#p_cost').val(0);
          $('#p_cost').val("Rs. "+ p_cost);
        },
        error: function(){}
      });
    });
	});
</script>

<script src="{{url('admin/js/custom/message-alert-timeout.js')}}"></script>