<?php
// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => 0, // expire when the browser is closed
    'path' => '/',
    'domain' => '',
    'secure' => true, // or false if not using HTTPS
    'httponly' => true,
    'samesite' => 'Strict' // or 'Lax'
]);

session_start();
include 'database.php';


$message = ''; // Initialize an empty message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database to check if the user exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Set the user's ID in the session
        header("Location:dashboard.php"); // Redirect to the dashboard
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    require('header.php');
    ?>
    <title>Login</title>
    <style>
        .login-container {
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px,0px,70px,0px;
            position: relative;
        }

        .login-container::before {
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
            z-index: -1;
            /* Ensure the pseudo-element is behind all other content */
        }

        .login-container input {
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

        .login-container .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 40vh;
            padding: 70px;
        }

        .login-container .alignbutton {
            text-align: center;
        }

        .login-container .alignbuttonlogin {
            padding: 0 0 30px 0;
            text-align: center;
        }

        .login-container form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            margin: 50px auto;
            max-width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation-name: form;
            animation-duration: 2s;
            animation-timing-function: ease-out;
        }

        .login-container button {
            text-align: center;
            background-color: #34A3ED;
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

        .login-container button:hover {
            background-color: #34E2ED;
        }

        .login-container h1 {
            padding: 8px 0 0 0;
            text-align: center;
            color: #333;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="form-container">

            <form method="POST" action="">
                <h1>Login to continue</h1>
                <?php if ($message) : ?>
                <p style= "text-align:center;color:red"><?php echo $message; ?></p>
            <?php endif; ?>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="alignbutton">
                    <button type="submit">Login</button>
                </div>
                <h2>Not an user ?</h2>
                <div class="alignbuttonlogin">
                    <a href="register.php"><button type="button">Register Now</button></a>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
<?php
require('footer.php');
?>