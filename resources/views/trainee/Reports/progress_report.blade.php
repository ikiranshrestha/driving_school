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
      <th>Rounds</th>
      <th>8 Boundary</th>
      <th>Foot</th>
      <th>Side Light</th>
      <th>Traffic Light</th>
      <th>Ramp Boundary</th>
      <th>Stoll</th>
      <th>Uphill</th>
      <th>Downhill</th>
      <th>Curve</th>
    </tr>
  </thead>
  <tbody>
    @php $row = 0 @endphp
    @php 
    $rounds = 0;
    $eight = 0;
    $foot = 0;
    $sideLight = 0;
    $trafficLight = 0;
    $ramp = 0;
    $stoll = 0;
    $uphill = 0;
    $downhill = 0;

    @endphp
    @foreach($ProgressReport as $progress):
        <tr>
            <td>Day {{ ++$row }}</td>
            <td style=" {{ ($rounds > $progress->rounds)?'color:red': (($rounds < $progress->rounds) ? 'color:green' : '') }}">{{$progress->rounds}}</td>
            <td style=" {{ ($eight > $progress->eight_boundary_violations)?'color:green': (($eight < $progress->eight_boundary_violations) ? 'color:red' : '') }}">{{$progress->eight_boundary_violations}}</td>
            <td style=" {{ ($foot > $progress->foot_on_ground)?'color:green': (($foot < $progress->foot_on_ground) ? 'color:red' : '') }}">{{$progress->foot_on_ground}}</td>
            <td style=" {{ ($sideLight > $progress->side_light_violation)?'color:green': (($sideLight < $progress->side_light_violation) ? 'color:red' : '') }}">{{$progress->side_light_violation}}</td>
            <td style=" {{ ($trafficLight > $progress->traffic_light_violation)?'color:green': (($trafficLight < $progress->traffic_light_violation) ? 'color:red' : '') }}">{{$progress->traffic_light_violation}}</td>
            <td style=" {{ ($ramp > $progress->ramp_boundary_violation)?'color:green': (($ramp < $progress->ramp_boundary_violation) ? 'color:red' : '') }}">{{$progress->ramp_boundary_violation}}</td>
            <td style=" {{ ($stoll > $progress->engine_stoll)?'color:green': (($stoll < $progress->engine_stoll) ? 'color:red' : '') }}">{{$progress->engine_stoll}}</td>
            <td style=" {{ ($uphill > $progress->uphill_boundary_violation)?'color:green': (($uphill < $progress->uphill_boundary_violation) ? 'color:red' : '') }}">{{$progress->uphill_boundary_violation}}</td>
            <td style=" {{ ($downhill > $progress->downnhill_boundary_violation)?'color:green': (($downhill < $progress->downnhill_boundary_violation) ? 'color:red' : '') }}">{{$progress->downnhill_boundary_violation}}</td>

            {{-- <td>{{date("F", mktime(0, 0, 0, $monthlyIncome->monthCount, 10))}}</td>
            <td style=" {{ ($previousMonthIncome > $monthlyIncome->income)?'color:red':'color:green' }}">
            <strong>Rs. {{$monthlyIncome->income/ 1000}}</strong></td>
            --}}
            @php
                if($row > 0){
                    $rounds = $progress->rounds;
                    $eight = $progress->eight_boundary_violations;
                    $foot = $progress->foot_on_ground;
                    $sideLight = $progress->side_light_violation;
                    $trafficLight = $progress->traffic_light_violation;
                    $ramp = $progress->ramp_boundary_violation;
                    $stoll = $progress->engine_stoll;
                    $uphill = $progress->uphill_boundary_violation;
                    $downhill = $progress->downnhill_boundary_violation;

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