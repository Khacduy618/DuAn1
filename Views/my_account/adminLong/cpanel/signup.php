<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #1f293a;
            color: #fff;
        }
        .container-signup {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-radius: 8px;
            background: #2c4766;
            width: 350px;
        }
        h2 {
            font-size: 2em;
            color: #0ef;
            margin-bottom: 20px;
        }
        .input-box {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }
        .input-box input {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 2px solid #2c4766;
            outline: none;
            border-radius: 25px;
            font-size: 1em;
            color: #fff;
            transition: border-color 0.3s ease;
        }
        .input-box input:focus, 
        .input-box input:not(:placeholder-shown) {
            border-color: #0ef;
        }
        .input-box label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #fff;
            pointer-events: none;
            transition: 0.3s;
            font-size: 0.9em;
        }
        .input-box input:focus + label,
        .input-box input:not(:placeholder-shown) + label {
            top: -10px;
            font-size: 0.75em;
            background: #1f293a;
            padding: 0 5px;
            color: #0ef;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #0ef;
            color: #1f293a;
            font-weight: bold;
            border: none;
            outline: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0bd;
        }
        .forgot-pass, .signup-link {
            margin-top: 10px;
            text-align: center;
        }
        .forgot-pass a, .signup-link a {
            color: #0ef;
            text-decoration: none;
            font-weight: bold;
        }
        .forgot-pass a:hover, .signup-link a:hover {
            text-decoration: underline;
        }
        .captcha-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background: #1f293a;
            border-radius: 25px;
        }
        .captcha-box span {
            font-weight: bold;
            color: #0ef;
        }
    </style>
</head>
<body>
    <div class="container-signup">
        <h2>Sign-Up</h2>
        <form autocomplete="off" action="?act=adminLong&ctlr=AdminLongController&method=auttc_signup" method="POST">
            <?php if(isset($msg)): ?>
                <span style="color:blue;font-weight:bold;"><?php echo $msg; ?></span>
            <?php endif; ?>
            <div class="input-box">
                <input type="text" name="fullname" placeholder=" " required>
                <label>Full Name</label>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder=" " required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>
            <div class="input-box">
                <input type="password" name="confirmpassword" placeholder=" " required>
                <label>Password Confirm</label>
            </div>
            
            
            <div class="captcha-box">
                <span id="txtCaptchaDiv"></span>
                <input type="hidden" id="txtCaptcha">
                <input type="text" name="captcha" id="txtInput" placeholder="Enter captcha" required>
            </div>
            <button type="submit" name="btnsignup" class="btn">Sign-Up</button>
            <div class="forgot-pass">
                <a href="#">Forgot Password?</a>
            </div>
            <div class="signup-link">
                <a href="?act=adminLong&ctlr=AdminLongController&method=login">Already have an account? Log In</a>
            </div>
        </form>
    </div>

    <script>
        // Generates the captcha
        const code = Array.from({ length: 5 }, () => Math.floor(Math.random() * 10)).join('');
        document.getElementById("txtCaptcha").value = code;
        document.getElementById("txtCaptchaDiv").textContent = code;
    </script>
</body>
</html>
