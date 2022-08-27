@extends('admin.tables.layout')
@section('table')
@push('table-name')
{{-- @push('admin-uname')
@endpush --}}
<h4 class="card-title">Income Sheet</h4>
@endpush
<thead>
    <p></p>
    <tr>
        <th>Income</th>
      <th>Year</th>
      <th>Month</th>
      <th>Amount in '000</th>
    </tr>
  </thead>
  <tbody>
    @php $row = 0 @endphp
    @php $previousMonthIncome = 0 @endphp
    @foreach($Income as $monthlyIncome):
        <tr>
            <td>{{ ++$row }}</td>
            <td>{{$monthlyIncome->Year}}</td>
            <td>{{date("F", mktime(0, 0, 0, $monthlyIncome->monthCount, 10))}}</td>
            <td style=" {{ ($previousMonthIncome > $monthlyIncome->income)?'color:red':'color:green' }}">
            <strong>Rs. {{$monthlyIncome->income/ 1000}}</strong></td>
            @php
                if($row > 0){
                    $previousMonthIncome = $monthlyIncome->income;
                    // ddd($previousMonthIncome);
                }
            @endphp
        </tr>
    @endforeach
  </tbody>
@endsection