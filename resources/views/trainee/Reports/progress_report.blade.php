@extends('trainee.table_layout')
@section('table')
@push('table-name')
{{-- @push('admin-uname')
@endpush --}}
<h4 class="card-title">Progress Tracker</h4>
@endpush

<thead>
    <p></p>
    <tr>
        <th>Day</th>
      <th>weight</th>
      <th>chest</th>
      <th>Biceps</th>
      <th>Stomach</th>
      <th>Waist</th>
      <th>Hip</th>
      <th>Thigh</th>
      <th>Calves</th>
    </tr>
  </thead>
  <tbody>
    @php $row = 0 @endphp
    @php 
    $weight = 0;
    $chest = 0;
    $biceps = 0;
    $stomach = 0;
    $waist = 0;
    $hip = 0;
    $thigh = 0;
    $calves = 0;

    @endphp
    @foreach($ProgressReport as $progress):
        <tr>
            <td>Day {{ ++$row }}</td>
            <td style=" {{ ($weight > $progress->weight)?'color:red': (($weight < $progress->weight) ? 'color:green' : '') }}">{{$progress->weight}}</td>
            <td style=" {{ ($chest > $progress->chest)?'color:green': (($chest < $progress->chest) ? 'color:red' : '') }}">{{$progress->chest}}</td>
            <td style=" {{ ($biceps > $progress->biceps)?'color:green': (($biceps < $progress->biceps) ? 'color:red' : '') }}">{{$progress->biceps}}</td>
            <td style=" {{ ($stomach > $progress->stomach)?'color:green': (($biceps < $progress->biceps) ? 'color:red' : '') }}">{{$progress->stomach}}</td>
            <td style=" {{ ($hip > $progress->hip)?'color:green': (($hip < $progress->hip) ? 'color:red' : '') }}">{{$progress->hip}}</td>
            <td style=" {{ ($waist > $progress->waist)?'color:green': (($waist < $progress->waist) ? 'color:red' : '') }}">{{$progress->waist}}</td>
            <td style=" {{ ($thigh > $progress->thigh)?'color:green': (($thigh < $progress->thigh) ? 'color:red' : '') }}">{{$progress->thigh}}</td>
            <td style=" {{ ($calves > $progress->calves)?'color:green': (($calves < $progress->calves) ? 'color:red' : '') }}">{{$progress->calves}}</td>

            {{-- <td>{{date("F", mktime(0, 0, 0, $monthlyIncome->monthCount, 10))}}</td>
            <td style=" {{ ($previousMonthIncome > $monthlyIncome->income)?'color:red':'color:green' }}">
            <strong>Rs. {{$monthlyIncome->income/ 1000}}</strong></td>
            --}}
            @php
                if($row > 0){
                    $weight = $progress->weight;
                    $chest = $progress->chest;
                    $biceps = $progress->biceps;
                    $stomach = $progress->stomach;
                    $waist = $progress->waist;
                    $hip = $progress->hip;
                    $thigh = $progress->thigh;
                    $calves = $progress->calves;

                    // $trafficLight = $progress->traffic_light_violation;
                    // $ramp = $progress->ramp_boundary_violation;
                    // $stoll = $progress->engine_stoll;
                    // $uphill = $progress->uphill_boundary_violation;
                    // $downhill = progress->downnhill_boundary_violation;
                    // ddd($previousMonthIncome);
                }
            @endphp
        </tr>
    @endforeach
  </tbody>
@endsection