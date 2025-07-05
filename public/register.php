<?php
include 'db_connect.php';

$message = "";
$toastClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $checkEmailStmt = $conn->prepare("SELECT email FROM userdata WHERE email = ?");
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        $message = "Email already exists";
        $toastClass = "#007bff"; // Primary color
    } else {
        // Prepare and bind
        $query = "INSERT INTO userdata (email, password) VALUES ('$email', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "Akun berhasil dibuat!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
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

            <div class="w-full max-w-md flex justify-start items-center mb-2">
                <button onclick="location.href='login.html'" type="button" class="flex items-center gap-2 bg-blue-800 text-white py-2 px-4 rounded transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                Login Akun
                </button>
            </div>

            <div class="w-full max-w-md bg-white p-8 rounded-lg">

                <div class="mb-12 text-gray-800">
                  <h1 class="text-4xl font-semibold mb-2">Register</h1>
                  <p>Hello, buat akun mu disini</p>
                </div>

                <form method="post" action="">
                    <div class="text-gray-800">
                        <p class="mb-2">Email</p>
                        <input id="email" type="text" placeholder="Masukan Email Kamu" class="w-full p-2 border rounded mb-4">
                        
                        <p class="mb-2">Password</p>
                        <input id="password" type="password" placeholder="Masukan Password Kamu" class="w-full p-2 border rounded mb-4">
                    
                        <input type="submit" id="regBtn" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded transition duration-200">Register</input>
                    </div>
                </form>
              
              </div>
              

        </div>

        <script>
            const regButton = document.getElementById('regBtn');
            regButton.addEventListener('click', () => {
              const username = document.getElementById('username').value.trim();
              const password = document.getElementById('password').value.trim();
          
            if (!username && !password) {
                alert("Username dan password kosong.");
            } else if (!username){
                alert("Username kosong.");
            } else if (!password){
                alert("Password kosong.");
            } else {
                // Jika terisi, redirect ke login
                alert("Akun berhasil dibuat.");
                location.href = 'index.html';
              }
            });
        </script>          
        
    </body>
</html>
