@extends('trainee.table_layout')
@section('table')
@push('table-name')
@push('admin-uname')
{{-- {{ $enrollname = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
@endpush
<h4 class="card-title">My Packages History</h4>
@endpush

                      <thead>
                        <tr>
                          <th>S.no.</th>
                          <th>Course</th>
                          <th>Package Enrolled</th>
                          <th>Enrollment Tenure</th>
                          {{-- <th>Enrollment Status</th> --}}
                          <th>Offered Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $row = 1 @endphp
                        @foreach($enrollment_history as $enroll):
                        <tr>
                          <td>{{ $row }}</td>
                          <td>{{$enroll->course_type}}</td>
                          <td>{{$enroll->p_name}}</td>
                          <td>{{ $start_date = $enroll->e_startdate}} to 
                            {{date('Y-m-d', $end_date = strtotime($start_date. " + {$enroll->p_duration} days"))}}</td>
                          {{-- <td><label class="{{ ($end_date <= date('Y-m-d')) ? 'badge badge-primary' : 'badge badge-success' }}"> {{ ($end_date <= date('Y-m-d')) ? 'Completed' : 'Awaiting/Ongoing' }} </label></td> --}}
                          <td>Rs. {{$enroll->p_fee}}</td>
                          @php $row++ @endphp
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>
              

@endsection