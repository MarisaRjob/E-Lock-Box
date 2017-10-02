<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
</head>


<body>
<img src="{{$message->embed($imgPath)}}"/><br>
<p>Dear {{$name}},</p>
<br>
<p>You recently requested to reset your password for your e-Lockbox account. Please click the button below to reset your
    password.</p>
<a href="{{ url($link) }}">
    <button class="btn btn-primary">Reset your password</button>
</a>
<p>Or copy and paste the URL below into your web browser.</p>
{{$link}}
<p>If you did not request a password reset, please ignore this email or contact with your administrator. This password
    reset is only valid for
    the next 30 minutes.</p>
<br>
<p><b style="color: black">Please do not reply to this email.</b></p>
<p>For more information, please contact <a href="mailto:info@LivingAdvantageInc.org">info@LivingAdvantageInc.org</a> or
    visit <a href="www.mylaspace.com">www.mylaspace.com</a>.</p>
<br>
<p>Living Advantage Inc.</p>
<p>e-Lockbox</p>
<p><em>Developed by USC Team 10</em></p>
</body>
</html>