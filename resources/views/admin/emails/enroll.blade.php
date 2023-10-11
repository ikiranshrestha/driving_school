@component('mail::message')
# Enrolled!
<br>
Shree {{$data['username']}},<br>
You have been successfully enrolled to {{$data['duration']}} days [ {{$data['course']}} ] {{$data['package']}} package.
<br><br>
@php
$startdate = $data['startdate'];
$enddate = date('Y-m-d', $end_date = strtotime($startdate. " + {$data['duration']} days"));
@endphp

Training Session Information <br>
----------------------------- <br>
Start Date: {{$startdate}} <br>
End Date: {{$enddate}} <br>

@component('mail::button', ['url' => 'https://codicaltech.com'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
