<!DOCTYPE html>
<html>
<head>
    <title>Modern Login & Register</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

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
            background: linear-gradient(135deg,rgb(10, 25, 90),rgb(55, 67, 117),rgb(107, 3, 10),rgb(0, 0, 0), rgb(131, 127, 127), rgb(255, 255, 255));
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            padding: 20px;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            position: relative;
            width: 850px;
            min-height: 580px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        }

        .form-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
        }

        .form-section {
            position: relative;
            width: 50%;
            transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            padding: 50px 40px;
        }

        .form-section.signin {
            background: rgba(255, 255, 255, 0.95);
        }

        .form-section.signup {
            background: rgba(255, 255, 255, 0.85);
        }

        h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
            position: relative;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg,rgb(10, 25, 90),rgb(55, 67, 117),rgb(107, 3, 10),rgb(0, 0, 0), rgb(131, 127, 127), rgb(255, 255, 255));
            border-radius: 3px;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .social-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .social-button::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: scale(0);
            transition: 0.3s;
        }

        .social-button:hover::before {
            transform: scale(1);
        }

        .social-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.3);
        }

        .input-box {
            position: relative;
            margin-bottom: 30px;
        }

        .input-box input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            outline: none;
            font-size: 16px;
            transition: all 0.3s;
        }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #666;
            transition: 0.3s;
        }

        .input-box input:focus ~ i {
            color: #23a6d5;
        }

        .input-box span {
            position: absolute;
            left: 45px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #666;
            pointer-events: none;
            transition: all 0.3s;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-color: #23a6d5;
            box-shadow: 0 0 10px rgba(35, 166, 213, 0.1);
        }

        .input-box input:focus ~ span,
        .input-box input:valid ~ span {
            top: -10px;
            left: 15px;
            font-size: 13px;
            padding: 0 5px;
            background: white;
            color: #23a6d5;
        }

        .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg,rgb(10, 25, 90),rgb(55, 67, 117),rgb(107, 3, 10),rgb(0, 0, 0), rgb(131, 127, 127), rgb(255, 255, 255));
            background-size: 300% 300%;
            animation: gradient 15s ease infinite;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .password-strength {
            height: 4px;
            margin-top: 8px;
            border-radius: 2px;
            background: #ddd;
            overflow: hidden;
            position: relative;
        }

        .password-strength::after {
            content: '';
            position: absolute;
            left: 0;
            height: 100%;
            width: var(--strength, 0%);
            transition: all 0.3s;
            background: linear-gradient(90deg, #ee7752, #e73c7e);
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            gap: 10px;
        }

        .remember input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #23a6d5;
        }

        .remember label {
            color: #666;
            font-size: 14px;
        }

        .switch-form {
            margin-top: 25px;
            text-align: center;
        }

        .switch-form a {
            color: #23a6d5;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s;
            position: relative;
        }

        .switch-form a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: #23a6d5;
            left: 0;
            bottom: -4px;
            transform: scaleX(0);
            transition: 0.3s;
        }

        .switch-form a:hover::after {
            transform: scaleX(1);
        }

        @media (max-width: 768px) {
            .container {
                width: 100%;
                height: auto;
            }

            .form-container {
                flex-direction: column;
            }

            .form-section {
                width: 100%;
                padding: 30px 20px;
            }

            .slide-left {
                transform: translateY(-100%);
            }

            .slide-right {
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-section signin">
                <form>
                    <h2>Welcome Back</h2>
                    <div class="social-buttons">
                        <button type="button" class="social-button facebook"><i class="fab fa-facebook-f"></i></button>
                        <button type="button" class="social-button google"><i class="fab fa-google"></i></button>
                        <button type="button" class="social-button twitter"><i class="fab fa-twitter"></i></button>
                    </div>
                    <div class="input-box">
                        <input type="text" name="email" required>
                        <span>Username/Email</span>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" required>
                        <span>Password</span>
                    </div>
                    <div class="remember">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn">
                        <span class="text">Sign In</span>
                        <span class="loading"><div class="loading-spinner"></div></span>
                    </button>
                    <div class="switch-form">
                        <a href="#" onclick="toggleForms()">New here? Create an account</a>
                    </div>
                </form>
            </div>

            <div class="form-section signup">
                <form>
                    <h2>Create Account</h2>
                    <div class="input-box">
                        <input type="text" name="name" required>
                        <span>Full Name</span>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" required>
                        <span>Email Address</span>
                    </div>
                    <div class="input-box">
                        <input type="password" class="password-input" name="password" required>
                        <span>Create Password</span>
                        <div class="password-strength"></div>
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirm_password" required>
                        <span>Confirm Password</span>
                    </div>
                    <button type="submit" class="btn">
                        <span class="text">Sign Up</span>
                        <span class="loading"><div class="loading-spinner"></div></span>
                    </button>
                    <div class="switch-form">
                        <a href="#" onclick="toggleForms()">Already have an account? Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleForms() {
            const signin = document.querySelector('.signin');
            const signup = document.querySelector('.signup');
            signin.classList.toggle('slide-left');
            signup.classList.toggle('slide-right');
        }

        const passwordInput = document.querySelector('.password-input');
        const strengthBar = document.querySelector('.password-strength');

        passwordInput.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            strengthBar.style.setProperty('--strength', `${strength}%`);
            strengthBar.style.width = `${strength}%`;
            
            if (strength < 33) strengthBar.style.background = '#ff4444';
            else if (strength < 66) strengthBar.style.background = '#ffbb33';
            else strengthBar.style.background = '#00C851';
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            if (password.length > 6) strength += 25;
            if (password.match(/[A-Z]/)) strength += 25;
            if (password.match(/[0-9]/)) strength += 25;
            if (password.match(/[^A-Za-z0-9]/)) strength += 25;
            return strength;
        }
    </script>
    
    <script src="/js/auth.js"></script>
</body>
</html>