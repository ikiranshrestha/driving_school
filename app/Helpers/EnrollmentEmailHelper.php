<?php

use App\Mail\EnrollMail;
use Illuminate\Support\Facades\Mail;

function sendEnrollmentNotification($trainee_email, $uname, $coursepackages, $startdate, $time)
{
    $to_email = $trainee_email;
    $dataForEmail = [
                    'username' => $uname,
                    'course' =>  $coursepackages->course_type,
                    'package' =>  $coursepackages->p_name,
                    'duration' => $coursepackages->p_duration,
                    'startdate' => $startdate,
                    'time' => $time
                ];
                $sendEmail = Mail::to($to_email)->send(new EnrollMail($dataForEmail));
                if(count(Mail::failures()) > 0)
                {
                    return redirect()->back()->with('error', 'Email not sent!');

                }else{
                    return redirect()->back()->with('success', 'Admitted and Notified!');
                }
}