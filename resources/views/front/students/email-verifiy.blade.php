<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>

    @php
      $student_id  = $data['student_id'];
      $regno       = $data['regno'];

    @endphp
    
    You are successfully registered. Please click on the below link to verify your email account.
    <br/>
    <a href="{{ route('student-email-verify',['student_id'=>$student_id,'regno'=>$regno]) }}">Verify Email</a>
  </body>
