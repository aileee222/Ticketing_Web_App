<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up Page</title>
    <link rel="stylesheet" href="{{ asset('_sign/styles.css') }}" />
</head>
<body>
    <form id="signup_form_submit" class="login_box" method="POST" action="{{ route('register') }}" >
        @csrf
        <img src="{{ asset('_sign/login_red_user.jpg') }}" alt="user_picture">
        <div class="field">
            <input type="text" name="firstname" class="firstname_box" placeholder="Firstname">
            <div id="firstname_error" class="error hide">Please enter your firstname.</div>
        </div>
        <div class="field">
            <input type="text" name="lastname" class="lastname_box" placeholder="Lastname">
            <div id="lastname_error" class="error hide">Please enter your lastname.</div>
        </div>
        <div class="field">
            <input type="text" name="email" class="email_box" placeholder="Email">
            <div id="email_error" class="error hide">Please enter your email.</div>
        </div>
        <div class="field">
            <input type="date" name="birthday" class="birthday_box" placeholder="Birthday">
            <div id="birthday_error" class="error hide">Please enter your birthday.</div>
        </div>
        <div class="field">
            <input type="tel" name="tel" pattern="[0-9]{2,3}[0-9]{8}" class="phone_box" placeholder="Phone">
            <div id="phone_error" class="error hide">Please enter your phone number.</div>
        </div>
        <div class="field">
            <input type="text" name="location" class="location_box" placeholder="Location">
            <div id="location_error" class="error hide">Please enter your location.</div>
        </div>
        <div class="field">
            <input type="text" name="education" class="education_box" placeholder="Education">
            <div id="education_error" class="error hide">Please enter your education.</div>
        </div>
        <div class="field">
            <select name="status" class="status_box" required>
                <option value="2">Manager</option>
                <option value="1">Developper</option>
                <option value="0" selected>Client</option>
            </select>
            <div id="status_error" class="error hide">Please enter your status.</div>
        </div>
        <div class="field">
            <input type="password" name="password" class="passwd_box" placeholder="Password">
            <div id="passwd_error" class="error hide">Please enter a password.</div>
        </div>
        <div class="field">
            <input type="password" name="password_confirmation" class="passwd_box" placeholder="Confirm password" required>
            <div id="passwd_error" class="error hide">Please enter a password.</div>
        </div>
        <button class="submit">Sign Up</button>
    </form>
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
    @endif
    <script src="{{ asset('_sign/script.js') }}"></script>
</body>
</html>