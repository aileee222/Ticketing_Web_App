<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('_sign/styles.css') }}" />
</head>
<body>
    <form id="login_form_submit" class="login_box" method="POST" action="{{ route('login') }}">
        @csrf
        <img src="{{ asset('_sign/login_red_user.jpg') }}" alt="user_picture">
        <div class="field">
            <input type="text" name="email" class="email_box" placeholder="Email">
            <div id="email_error" class="error hide">Please enter your email.</div>
        </div>
        <div class="field">
            <input type="password" name="password" class="passwd_box" placeholder="Password">
            <div id="passwd_error" class="error hide">Please enter a password.</div>
        </div>
        <button class="submit">Login</button>
        <div class="signup_box">
            <span>Not a member ?&nbsp</span>
            <a href="{{ route('register') }}" class="signup_txt">Sign up now</a>
        </div>
    </form>
    <script src="{{ asset('_sign/script.js') }}"></script>
</body>
</html>