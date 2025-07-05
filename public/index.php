<?php
include '../db_connect.php';

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tidak dilakukan validasi atau filtering input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query tanpa prepared statement (rentan SQL Injection)
    $query = "SELECT * FROM userdata WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - ToDo App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    </head>
    <body style="font-family: Plus Jakarta Sans;">

        <div class="flex flex-col items-center justify-center h-dvh p-8 bg-gray-100">

            <!-- <div class="w-full max-w-md flex justify-end items-center mb-2">
                <button onclick="location.href='register.php'" type="button" class="flex items-center gap-2 bg-blue-800 hover:bg-blue-600 text-white py-2 px-4 rounded transition duration-200">Register Akun
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div> -->

            <div class="w-full max-w-md bg-white p-8 rounded-lg">

                <div class="mb-12 text-gray-800">
                    <h1 class="text-4xl font-semibold mb-2">Login</h1>
                    <p>Hello, Login to your account to get started!</p>
                </div>

                <form method="POST" action="" class="mb-4 text-gray-800">
                    <p class="mb-2">Username</p>
                    <input id="username" type="text" name="username" placeholder="Enter Your Username" class="w-full p-2 border rounded mb-4">
                    <p class="mb-2">Password</p>
                    <input id="password" type="password" name="password" placeholder="Enter Your Password" class="w-full p-2 border rounded mb-4">
                    <button type="submit" value="login" id="loginBtn" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded transition duration-200">Login</button>
                </form>
            </div>

        </div>
        
        <script>
            const loginButton = document.getElementById('loginBtn');
            loginButton.addEventListener('click', () => {
              const username = document.getElementById('username').value.trim();
              const password = document.getElementById('password').value.trim();
          
            if (!username && !password) {
                alert("Username and password is empty.");
            } else if (!username){
                alert("Username is empty.");
            } else if (!password){
                alert("Password is empty.");
            }
            });
        </script>
          

    </body>
</html>
