@extends('admin.layout')
@push('dashboard-css')
<link rel="stylesheet" href="{{url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{url('admin/js/select.dataTables.min.css')}}">
@endpush
@section('content')

@push('admin-uname')
{{ $username = $LoggedInUserData['LoggedInUserInfo']['uname'] }}
@endpush
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-sm-6">@include('admin.layouts.dashboardinfocard')</div>
        <div class="col-sm-6">@include('admin.layouts.dashboard_trend_section')</div>
      </div>
    </div>
</div>



@endsection
