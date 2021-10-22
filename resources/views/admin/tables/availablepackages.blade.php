@extends('admin.tables.layout')
@section('table')
@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
@push('table-name')
<h4 class="card-title">Available Packages</h4>
@endpush

<thead>
                        <tr>
                          <th>Category</th>
                          <th>Vehicle Type</th>
                          <th>Package Name</th>
                          <th>Duration</th>
                          <th>Cost</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($packageInfo as $package):
                        <tr>
                          <td>{{$package->vehicle_category}}</td>
                          <td>{{$package->course_type}}</td>
                          <td>{{$package->p_name}}</td>
                          <td>{{$package->p_duration}} days</td>
                          <td>Rs. {{$package->p_cost}}.00</td>
                        </tr>
                        @endforeach
                      </tbody>
                </div>
                </div>


@endsection