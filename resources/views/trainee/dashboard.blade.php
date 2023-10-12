@extends('trainee.table_layout')
@section('table')
@push('table-name')
@push('admin-uname')
{{-- {{ $enrollname = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
@endpush
<div class="row">
  <div class="col-sm-6"></div>
</div>
<h4 class="card-title">My Packages History</h4>
@endpush
                      <thead>
                        <tr>
                          <th>S.no.</th>
                          <th>Course</th>
                          <th>Package Enrolled</th>
                          <th>Enrollment Tenure</th>
                          <th>Enrollment Status</th>
                          <th>Days until Expiry</th>
                          <th>Offered Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $row = 1 @endphp
                        @foreach($enrollment_history as $enroll):
                        @php
                          $start_date = $enroll->e_startdate;
                          $end_date = date('Y-m-d', strtotime($start_date. " + {$enroll->p_duration} days"));

                          $today = new DateTime();
                          $end = new DateTime($end_date);

                          // Calculate the difference in days
                          $interval = $today->diff($end);

                          // Get the difference in days
                          $daysDifference = max(0, (int)$interval->format('%r%a'));
                        @endphp
                        <tr>
                          <td>{{ $row }}</td>
                          <td>{{$enroll->name}}</td>
                          <td>{{$enroll->p_name}}</td>
                          <td>{{ $start_date = $enroll->e_startdate}} to {{date('Y-m-d', $end_date = strtotime($start_date. " + {$enroll->p_duration} days"))}}</td>
                          <td><label class="{{ ($end_date <= date('Y-m-d')) ? 'badge badge-primary' : 'badge badge-success' }}"> {{ ($end_date <= date('Y-m-d')) ? 'Awaiting/Ongoing' : 'Completed' }} </label></td>
                          <td>{{$daysDifference}}</td>
                          <td>Rs. {{$enroll->p_fee}}</td>
                          @php $row++ @endphp
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>
              

@endsection