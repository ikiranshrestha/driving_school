@extends('admin.tables.layout')
@section('table')
@push('table-name')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
<h4 class="card-title">Active Enrollments</h4>
@endpush

                      <thead>
                        <tr>
                          <th>User</th>
                          <th>Contact</th>
                          <th>Package Enrolled</th>
                          <th>Enrollment Tenure</th>
                          <th>Enrollment Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($enrollmentInfo as $user):
                        <tr>
                          <td title="{{$user->t_fname}} {{$user->t_mname}} {{$user->t_lname}}">{{$user->t_uname}}</td>
                          <td>{{$user->t_phone}}</td>
                          <td class="text-danger"> [{{$user->course_type}}] {{$user->p_name}}</td>
                          <td class=""> <span class="text-success">{{$start_date = $user->e_startdate}}</span> 
                          to 
                          <span class="text-danger">{{date('Y-m-d', $end_date = strtotime($start_date. " + {$user->p_duration} days"))}}</span>
                        </td>
                        <td>
                            <label class="{{ ($start_date <= date('Y-m-d')) ? 'badge badge-success' : 'badge badge-danger' }}"> {{ ($start_date <= date('Y-m-d')) ? 'Ongoing' : 'Awaiting' }} </label>
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>
              

@endsection