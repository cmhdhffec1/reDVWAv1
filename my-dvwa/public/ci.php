<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="/img/mlogo.png" sizes="32x32" type="image/x-icon">
    <title>Command Injection Page</title>
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

        .command-section {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px);
        }

        .command-container {
            background: #2a2a2a;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .command-container h2 {
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

        .execute-btn {
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

        .execute-btn:hover {
            background: #cc2929;
        }

        .error-message, #loader {
            color: #ff3333;
            text-align: center;
            margin-top: 15px;
            display: none;
            font-size: 14px;
            white-space: pre-wrap;
        }

        #response {
           color: #33ff33;
            text-align: center;
            margin-top: 15px;
            display: none;
            font-size: 14px;
            white-space: pre-wrap;
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
</head>
<body>
<header>
    <a href="/index.html">
        <img src="img/logo.png" class="logo" alt="EchoKill Logo">
    </a>
    <p style="color: #fff; font-size: 24px;">Level 1 (Command Injection) - easy</p>
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
        <button class="close-btn" id="close-sidebar">×</button>
    </div>
    <ul class="task-list">
        <li><a href="/xss.php">Lesson 1: XSS</a></li>
        <li><a href="/csrf.php">Lesson 2: CSRF</a></li>
        <li><a href="/sql.php">Lesson 3: SQL Injection</a></li>
        <li><a href="/rce.php">Lesson 4: RCE File Upload</a></li>
        <li><a href="/ci.php">Lesson 5: Command Injection</a></li>
        <li><a href="/xxe.php">Lesson 6: XXE Vulnerability</a></li>
    </ul>
</div>

<section class="command-section">
    <div class="command-container">
        <h2>Ping Command</h2>
        <div class="input-group">
            <label for="ip">Enter IP Address to Ping</label>
            <input type="text" id="ip" name="ip" placeholder="e.g., 127.0.0.1" required>
        </div>
        <button class="execute-btn">Execute</button>
        <p class="error-message" id="error-message"></p>
        <p class="response" style='display: none;' id="response"></p>
        <p id="loader"></p>
    </div>
</section>

<script>
$(document).ready(function() {
    // Sidebar toggle
    $("#all-tasks").click(function(e) {
        e.preventDefault();
        if ($("#sidebar").hasClass("open")) {
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


// Allow execution on Enter key press
document.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        executeCommand();
    }
});
</script>
<script>
    function showmessage(content){
        $('#error-message').text(content).css('display', 'block');
        $('#response').text('').css('display', 'none');
    }
    function showresponse(content){
        $('#response').text(content).css('display', 'block');
        $('#error-message').text('').css('display', 'none');
    }
</script>
<script>
    $('.execute-btn').click(function(){
        showmessage('');
        showresponse('');
        ip = $("#ip").val();
        $(document).ajaxStart(function () {
            $("#loader").html('<i class="fas fa-spinner fa-spin"></i> Loading...').css('display', 'block');
        });
        $.ajax({
        url: '/endpoints/ci_endpoint.php',
        method: 'GET',
        data: { ip },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showresponse(response.output);
            } else {
                showmessage(response.message);
            }
        },
        error: function() {
            showmessage('Server error');
        }
    });
    $(document).ajaxStop(function () {
        $("#loader").css('display', 'none').html('');
    });
    });
</script>
</body>
</html>