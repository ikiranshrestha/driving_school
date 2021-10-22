@extends('admin.tables.layout')
@section('table')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
@push('table-name')
<h4 class="card-title">Available Courses</h4>
@endpush

<thead>
                        <tr>
                          <th>Category</th>
                          <th>Vehicle Type</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($courseInfo as $course):
                        <tr>
                          <td>{{$course->vehicle_category}}</td>
                          <td>{{$course->course_type}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>


@endsection