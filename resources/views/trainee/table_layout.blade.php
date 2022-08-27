@extends('trainee.layout')
@section('content')

<div class="card">
<div class="card-body">
                @stack('table-name')
                  <div class="table-responsive">
                    <table class="table table-hover">
                        @yield('table')
                    </table>
                  </div>

@endsection