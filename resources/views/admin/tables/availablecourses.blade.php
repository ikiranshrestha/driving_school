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
    <th>Class type</th>
    <th>Intensity</th>
  </tr>
</thead>
<tbody>
    @foreach($courseInfo as $class):
  <tr>
    <td>{{$class->name}}</td>
    <td>{{$class->intensity}}</td>
  </tr>
  @endforeach
</tbody>
</div>
</div>


@endsection