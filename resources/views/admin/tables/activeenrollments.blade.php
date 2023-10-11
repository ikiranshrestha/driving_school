@extends('admin.tables.layout')
@section('table')
@push('table-name')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
<h4 class="card-title">Active Enrollments</h4>
<div class="col-md-6 text-right">
  <form action="{{ route('enrollment.search') }}" method="GET" class="form-inline">
    <input type="text" name="search" placeholder="Search for user" class="form-control mr-sm-2">
    <button type="submit" class="btn btn-primary">Search</button>
  </form>
</div>
@endpush

                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Contact</th>
                          <th>Package Enrolled</th>
                          <th>Enrollment Tenure</th>
                          <th>Enrollment Status</th>
                          <th colspan="2">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($enrollmentInfo as $user):
                        <tr>
                          <td title="{{$user->t_fname}} {{$user->t_mname}} {{$user->t_lname}}">{{$user->t_uname}}</td>
                          <td>{{$user->t_phone}}</td>
                          <td class="text-danger"> [{{$user->name}}] {{$user->p_name}}</td>
                          <td class=""> <span class="text-success">{{$start_date = $user->e_startdate}}</span> 
                          to 
                          <span class="text-danger">{{date('Y-m-d', $end_date = strtotime($start_date. " + {$user->p_duration} days"))}}</span>
                        </td>
                        <td>
                            <label class="{{ ($start_date <= date('Y-m-d')) ? 'badge badge-success' : 'badge badge-danger' }}"> {{ ($start_date <= date('Y-m-d')) ? 'Ongoing' : 'Awaiting' }} </label>
                        </td>
                        <td><a href="{{Route('evaluate_trainee', $user->tr_id)}}"><button class = "btn btn-sm btn-warning">Evaluate</button></a></td>
                        <td><a href="{{Route('view_trainee_progress', $user->tr_id)}}"><button class = "btn btn-sm btn-warning">Progress</button></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>
                <script>
                  $(document).ready(function() {
                    $('#search-button').click(function(e) {
                      e.preventDefault();
                      $.ajax({
                        url: '{{ route('enrollment.search') }}',
                        method: 'GET',
                        data: $('#search-form').serialize(),
                        success: function(response) {
                          $('#table-body').html(response);
                        }
                      });
                    });
                  });
                </script>

@endsection