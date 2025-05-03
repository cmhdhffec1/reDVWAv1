<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="icon" href="/img/mlogo.png" sizes="32x32" type="image/x-icon">
    <title>CSRF Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: monospace;
        }

        body {
            background: #1a1a1a;
            min-height: 100vh;
        }

        header {
            background: #2a2a2a;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .logo {
            width: 100px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ff3333;
        }

        .login-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
        }

        .login-container {
            background: #2a2a2a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: #ccc;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #3a3a3a;
            color: #fff;
            font-size: 16px;
            transition: border 0.3s;
        }

        .input-group input:focus {
            outline: none;
            border: 2px solid #ff3333;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #ff3333;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-btn:hover {
            background: #cc2929;
        }

        .error-message {
            color: #ff3333;
            text-align: center;
            margin-top: 15px;
            display: none;
            font-size: 14px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #ff3333;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
        .sidebar {
    position: fixed;
    top: 0;
    right: -300px; 
    width: 300px;
    height: 100vh;
    background: #2a2a2a;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.5);
    transition: right 0.3s ease-in-out;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar.open {
    right: 0; 
}

.sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #3a3a3a;
}

.sidebar-header h3 {
    color: #fff;
    font-size: 20px;
}

.close-btn {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
}

.task-list {
    list-style: none;
    padding: 20px;
}

.task-list li {
    margin-bottom: 15px;
}

.task-list li a {
    color: #fff;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s;
}
div#notification {
    text-align: center;
}

.task-list li a:hover {
    color: #ff3333;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: none;
}
    </style>
    </style>
</head>
<body>
<header>
    <a href="/index.html">
        <img src="img/logo.png" class="logo" alt="EchoKill Logo">
    </a>
    <p style="color: #fff; font-size: 24px;">Level 1 (CSRF) - easy</p>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="https://t.me/EchoKill_Hack">Contact</a></li>
            <li><a href="#" id="all-tasks">All Tasks</a></li>
        </ul>
    </nav>
</header>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>All Tasks</h3>
        <button class="close-btn" id="close-sidebar">&times;</button>
    </div>
    <ul class="task-list">
    <li><a href="/xss.php">Lesson 1: XSS</a></li>
        <li><a href="/csrf.php">Lesson 2: CSRF</a></li>
        <li><a href="/sql.php">Lesson 3: SQL Injection</a></li>
        <li><a href="/rce.php">Lesson 4: RCE File Upload</a></li>
        <li><a href="/ci.php">Lesson 5: Command Injection</a></li>
    </ul>
</div>

    <section class="login-section">
        <div class="login-container">
	<h2>Login</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" required>
            </div>
            <button class="login-btn" onclick="handleLogin()">Login</button>
            <p class="error-message" id="error-message">Invalid username or password</p>
        </div>
        <script>
            $(".login-btn").click(function(){
    username = $("#username").val();
    password = $("#password").val();

    $.ajax({
        url:"/endpoints/csrf_login_endpoint.php",
        method: "post",
        data: {username, password},
        dataType: "json",
        success: function(info){
            if (info == "login"){
                window.location.replace("/csrftext.php");
            } else if (info == "false") {
                alert("Incorrect username or password");
            }
        },
        error: function(){
            alert("error");
        }
    });
});
        </script>

    </section>

    <script>
        function handleLogin() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('error-message');

            if (username === '' || password === '') {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        }

        // Allow login on Enter key press
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                handleLogin();
            }
        });
    </script>

<script>
$(document).ready(function() {
    
    $("#all-tasks").click(function(e) {
        e.preventDefault(); 
        if ($("#sidebar").hasClass("open")) {
            // Если меню открыто, закрываем его
            $("#sidebar").removeClass("open");
            $("#overlay").fadeOut(function() {
                $(this).remove();
            });
        } else {
            
            $("#sidebar").addClass("open");
            $("body").append('<div class="overlay" id="overlay"></div>');
            $("#overlay").fadeIn();
        }
    });

   
    $("#close-sidebar").click(function() {
        $("#sidebar").removeClass("open");
        $("#overlay").fadeOut(function() {
            $(this).remove();
        });
    });

  
    $(document).on("click", "#overlay", function() {
        $("#sidebar").removeClass("open");
        $(this).fadeOut(function() {
            $(this).remove();
        });
    });
});
</script>
</body>
</html>
