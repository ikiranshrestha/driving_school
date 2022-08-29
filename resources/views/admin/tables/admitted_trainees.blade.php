@extends('admin.tables.layout')
@section('table')
@push('table-name')
@push('admin-uname')
{{-- {{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }} --}}
@endpush
<h4 class="card-title">Active Enrollments</h4>
@endpush

                      <thead>
                        <tr>
                          <th>Full Name</th>
                          <th>Username</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Admission Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($admittedTrainees as $trainee):
                        <tr>
                            <td>{{$trainee->t_fname}} {{$trainee->t_mname}} {{$trainee->t_lname}}</td>
                          <td>{{$trainee->t_uname}}</td>
                          <td>{{$trainee->t_email}}</td>
                          <td>{{$trainee->t_phone}}</td>
                          <td>{{$trainee->admission_date}}</td>
                          <td><a href='{!!route("admission.edit_trainee", $trainee->id)!!}'><button class="btn btn-sm btn-primary">Edit</button></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                {{$admittedTrainees->links('pagination::bootstrap-4')}}

@endsection