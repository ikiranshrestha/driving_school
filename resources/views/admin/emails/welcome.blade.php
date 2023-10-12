@component('mail::message')
# Welcome to the family!

Namaste Shree {{ $data['name'] }}, <br>
You have been successfully registered on {{ date('Y-m-d') }}. Please find and keep the following information safe, you will need these for your attendance once you enroll.
<br><br>
Username: {{ $data['username'] }}<br>
Secretkey: {{ $data['secretkey'] }}<br>
<br>
<br>
<br>

Available Packages for Recommended Course
<br>
@if($data['recommendedCoursePackage']->isNotEmpty())
<table border="1">
    <thead>
        <tr>
            <th>Package Name</th>
            <th>Duration</th>
            <th>Cost</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['recommendedCoursePackage'] as $package)
            <tr>
                <td>{{ $package->p_name }}</td>
                <td>{{ $package->p_duration }}</td>
                <td>{{ $package->p_cost }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent