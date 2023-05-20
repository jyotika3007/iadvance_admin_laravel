<?php
   $companyInfor = DB::table('company_details')->first();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome To {{ config('app.name') }}</title>
<style>
.box
{
        height: 63px;
    border: 1px solid #000;
    background: black;
    color: #fff;
    line-height: 32px;
    margin-left: 15%;
    margin-right: 15%;
    padding-left: 11%;
    border-radius: 10px
}
.small-box
{
    height: 29px;
    border: 1px solid #000;
    background: black;
    color: #fff;
    line-height: 28px;
    margin-left: 42%;
    margin-right: 15%;
    padding-left: 5%;
    border-radius: 10px;
    width: 44%;
}
.snapBox
{
        height: 100px;
    border: 1px solid #000;
    width: 45%;
}
</style>
</head>

<body>
<!-- <div width="512" style="text-align:center;">
    <a href="#">Can't see our images? Click here.</a>
</div> -->
<table align="center" border="0" cellspacing="0" cellpadding="0" width="512" style="border:1px solid #e8e8e8;">
    <tbody>
        <tr><td colspan="3" height="10"></td></tr>
        <tr>
            <td width="10"></td>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" width="490">
                    <tbody>
                        <tr>
                          <td colspan="3" height="70" align="center" style="background-color:#eee">
                            <a href="{{ url('/') }}"> <img src="{{ asset('storage/'.$companyInfor->company_logo ?? '') }}" width="auto" height="65"></a>
                          </td>
                        </tr>
                        <tr><td colspan="3" height="10"></td></tr>

                        @if($type=='admin')
                        <tr>
                            <td width="10"></td>
                            <td>
                                <p> {{ $data['user_name'] }} send a feedback on {{ env('APP_NAME') }} </p>
                                <h2>Query Details </h2>
                                <br>
                            </td>
                            <td width="10"></td>
                        </tr>
                        <tr>
                            <td width="10"></td>
                            <td>
                               <h3>Name : {{ $data['user_name'] }}</h3>
                               <h3>Email : {{ $data['user_email'] }}</h3>
                               <h3>Mobile : {{ $data['user_mobile'] }}</h3>
                               <h4>Subject : {{$data['subject'] }} </h4>
                               <p>Feedback : {{$data['complaint'] }} </p>
                                <br>
                            </td>
                            <td width="10"></td>
                        </tr>
                        @else
                        <tr>
                            <td width="10"></td>
                            <td>
                                <p> Thank You. Your feedback is valuable for us. Our team will reply you soon. </p>
                                <br>
                            </td>
                            <td width="10"></td>
                        </tr>
                        @endif
                        <tr><td colspan="3" height="10"></td></tr>
                        <tr><td colspan="3" height="30" style="background-color:#e06f47;"></td></tr>
                    </tbody>
                </table>
            </td>
            <td width="10"></td>
        </tr>
        <tr><td colspan="3" height="10"></td></tr>
    </tbody>
</table>
</body>
</html>