<?php
include 'database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Generate a complete Bcrypt hash for the password
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $password_hash]);

    // Redirect to a new page
    header("Location: login.php");
    exit(); // Ensure that no more code is executed after the redirect
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <?php
    require('header.php');
    ?>
    <style>
        .register-container {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            position: relative; /* Add this line */
        }

        .register-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(6px);
            z-index: -1; /* Ensure the pseudo-element is behind all other content */
        }

        .register-container input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
            border-bottom: 2px solid navy;
        }

        @keyframes form {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .register-container .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 40vh; /* vh stands for viewport height */
        }

        .register-container .alignbutton {
            padding: 0 0 30px 0;
            text-align: center;
        }
        .register-container .alignbuttonreg {
            text-align: center;
        }
        .register-container form {
            background-color: rgba(255, 255, 255, 0.9); /* Use rgba to add transparency */
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation-name: form;
            animation-duration: 2s;
            animation-timing-function: ease-out;
        }

        .register-container button {
            text-align: center;
            background-color: #1d72ae; /* Green */
            border-radius: 25px;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .register-container button:hover {
            background-color: rgb(23, 186, 251);
        }

        .register-container h1,p {
            padding: 30px 0 0 0;
            text-align: center;
            color: #333;
        }
        .register-container p {
            padding: 5px 0 0 0;
            text-align: center;
            color: #333;
        }
        
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
    <div class="form-container">
        <form method="POST" action="">
    <input type="text" name="username" required placeholder="Username">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
             <div class="alignbuttonreg">
            <button type="submit">Register</button>
            </div>
            <p>By signing up you agree to our <a href="privacy.php">Privacy Policy</a></p>
            <p>Already an user?</p><br>
            <div class="alignbutton">
              <a href="login.php"><button class="login" type="button">Login</button></a>
            </div>
        </form>
    </div>
    </div>
    </body>
</html>
<?php
require('footer.php');
?>

