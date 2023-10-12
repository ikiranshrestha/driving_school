@extends('trainee.layout')
@push('form-css')
<link rel="stylesheet" href="{{url('admin/vendors/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{url('admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
@endpush
@section('content')
<form class="sample-form" method="POST">
@csrf
@yield('form')
</form>
@endsection