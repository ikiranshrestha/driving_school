@component('mail::message')
# Welcome to the family!

Namaste Shree {{$data['name']}}, <br>
You have been successfully registered on {{date('Y-m-d')}}. Please find and keep the following information safe, you will need these for your attendance once you enroll.
<br><br>
Username: {{$data['username']}}<br>
Secretkey: {{$data['secretkey']}}<br>
Recommended Course: {{$data['recommendedCourse']}}<br>
Recommended Course Description: {{$data['recommendedCourseDesc']}}<br>
@component('mail::button', ['url' => 'https://codicaltech.com'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
