<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexo - Software</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        * {
            font-family: 'Noto Sans', serif;
        }

        body {
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            margin: 0;
            padding: 0;
            width: 100vw;
            height: 100vh;
        }

        img {
            width: 100%;
            height: 100%;
        }

        a {
            text-decoration: none;
        }

        ::placeholder {
            color: white;
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        #preloader {
            backdrop-filter: blur(20px);
            z-index: 20;
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #preloader .loader {
            width: 150px;
            height: 150px;
            background-image: linear-gradient(120deg, #a1c4fd 0%, #c2e9fb 100%);
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 30px 4px rgba(0, 0, 0, 0.5) inset,
                0 5px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        #preloader .loader:before,
        #preloader .loader:after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 45%;
            top: -40%;
            background-color: #fff;
            animation: wave 5s linear infinite;
        }

        #preloader .loader:before {
            border-radius: 30%;
            background: rgba(255, 255, 255, 0.4);
            animation: wave 5s linear infinite;
        }

        @keyframes wave {
            0% {
                transform: rotate(0);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        #rcms_login_block {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }

        #rcms_login_block .login-form-block {
            width: 500px;
            background: white;
            background-size: cover;
            background-position: center;
        }

        #rcms_login_block .login-form-block .top-block {
            padding: 50px 20px 15px;
            border-bottom: 2px solid white;
        }

        #rcms_login_block .login-form-block .logo {
            width: 280px;
            margin: 0 auto 30px;
        }

        #rcms_login_block .login-form-block .logo img {
            filter: brightness(0) invert(1);
        }

        #rcms_login_block .login-form-block .head {
            font-size: 1.6rem;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            color: white;
            letter-spacing: 2px
        }

        #rcms_login_block .login-form-block form {
            padding: 30px;
        }

        #rcms_login_block .group-input {
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: 70px 1fr;
            align-items: center;
            border: 2px solid white;
            padding: 5px;
            border-radius: 5px;
        }

        #rcms_login_block label {
            font-size: 1.2rem;
            margin-bottom: 3px;
            color: white;
            display: block;
            font-weight: bold;
            text-align: center;
        }

        #rcms_login_block input {
            border: 0;
            outline: none;
            background: transparent;
            color: white
        }

        #rcms_login_block select {
            border: 0;
            outline: none;
            background: #162e67;
            color: white
        }

        #rcms_login_block input[type="submit"] {
            display: block;
            text-align: center;
            width: 100%;
            padding: 10px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .15) 0%, rgba(255, 255, 255, 0) 100%), #f6f8fa;
            color: black;
            margin-left: auto;
            text-transform: uppercase;
            font-weight: bold;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s linear;
            cursor: pointer;
        }
        .group-input {
            position: relative;
        }
        .group-input input[type="password"] {
            padding-right: 30px; /* Adjust this value as needed */
        }
        .toggle-password {
            position: absolute;
            right: 5px; /* Adjust this value as needed */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>

    {{-- ======================================
                    PRELOADER
    ======================================= --}}
    <div id="preloader">
        <span class="loader"></span>
    </div>

    {{-- ======================================
                    LOGIN FORM
    ======================================= --}}
    <div id="rcms_login_block" style="background-image: url('{{ asset('user/images/rcms-login-bg.png') }}')">
        <div class="login-form-block" style="background-image: url('{{ asset('user/images/rcms-login-bg2.png') }}')">
            <div class="top-block">
                <div class="logo">
                    <img src="{{ asset('user/images/logo.png') }}" alt="..." class="w-100 h-100">
                </div>
                <div class="head">
                    Set Your New Password </div>
            </div>
            <form id="updatePasswordForm" method="POST" action="/reset-password">
                @csrf
            <input type="hidden" name="mailId" value="{{ $email }}">

                <div class="group-input">
                    <label for="password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Enter Your Password" required minlength="8">
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <div class="group-input">
                    <label for="confirmPassword"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Your Password" required minlength="8">
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirmPassword')">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <div>
                    <input type="submit" value="Update Password">
                </div>
            </form>
        </div>
    </div>



    {{-- ======================================
                    SCRIPT TAGS
    ======================================= --}}
    <script>
        window.onload = function() {
            document.querySelector("#preloader").style.display = "none";
        }
    </script>

<script>

function togglePasswordVisibility(fieldId) {
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        if (!passwordPattern.test(password.value)) {
            password.setCustomValidity("Password must contain at least 8 characters with at least one number, one uppercase letter, and one lowercase letter.");
        } else {
            password.setCustomValidity("");
        }
        
            var field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmPassword");

    function validatePassword() {
        if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords Don't Match");
        } else {
            confirmPassword.setCustomValidity('');
        }
    }

    password.addEventListener("change", validatePassword);
    confirmPassword.addEventListener("keyup", validatePassword);

    // Display error messages
    password.addEventListener("input", function() {
        if (password.validity.patternMismatch) {
            password.setCustomValidity("Password must contain at least 8 characters.");
        } else {
            password.setCustomValidity("");
        }
    });
    confirmPassword.addEventListener("input", function() {
        confirmPassword.setCustomValidity('');
    });
</script>

</body>

</html>