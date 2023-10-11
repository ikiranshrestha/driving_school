@extends('admin.layout')
@section('content')
@stack('search')

<div class="card">
  <div class="card-body">
    @stack('table-name')
    <div class="table-responsive">
      <table class="table table-hover">
        @yield('table')
      </table>
    </div>
  </div>
</div>

@endsection