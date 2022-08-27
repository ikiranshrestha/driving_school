@extends('admin.tables.layout')
@section('table')
@push('table-name')
{{-- @push('admin-uname')
@endpush --}}
<h4 class="card-title">Admission Vs Enrollments</h4>
<p><strong style=" {{ ($TotalAdmissions > $TotalEnrollments) ? 'color:green' : "color:red"  }}">Admissions Count: {{ $TotalAdmissions }}</strong> | <strong style=" {{ ($TotalEnrollments > $TotalAdmissions) ? 'color:green' : "color:red"  }}">Enrollment Count: {{ $TotalEnrollments }}</strong></p>
@endpush
<thead>
    <p></p>
    <tr>
        <th>Admission</th>
      <th>Year</th>
      <th>Month</th>
      <th>Admission Count</th>
    </tr>
  </thead>
  <tbody>
    @php $row = 0 @endphp
    @foreach($AdmissionCount as $admission):
    <tr>
        <td>{{ ++$row }}</td>
        <td>{{$admission->Year}}</td>
        <td>{{date("F", mktime(0, 0, 0, $admission->monthCount, 10))}}</td>
        <td>{{$admission->admissionCount}}</td>
      </tr>
      @endforeach
  </tbody>
  <thead>
                            <tr>
                                <th><strong>Enrollment</strong></th>
                              <th>Year</th>
                              <th>Month</th>
                              <th>EnrollmentCount</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $row1 = 0 @endphp
                            @foreach($EnrollmentCount as $enroll):
                            <tr>
                                <td>{{ ++$row1 }}</td>
                                <td>{{$enroll->Year}}</td>
                                <td>{{date("F", mktime(0, 0, 0, $enroll->monthCount, 10))}}</td>
                                <td>{{$enroll->enrollCount}}</td>
                              </tr>
                              @endforeach
                          </tbody>
@endsection