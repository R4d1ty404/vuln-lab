<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - ToDo App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-straight/css/uicons-bold-straight.css'>
    </head>
<body class="bg-gray-100 p-10">

    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Dashboard</h1>

    <div class="flex justify-end mb-4">
    <button onclick="location.href='index.php'" name="logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Logout</button>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Card OS Command Injection -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test OS Command Injection</h2>
        <p class="text-sm text-gray-500 mb-4">Enter IP Address to ping (Ex: <code>127.0.0.1</code> or try: <code>127.0.0.1;ls</code>)</p>

        <form method="GET" action="">
            <input type="text" name="ip" placeholder="IP address..." class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Ping</button>
        </form>
        <form method="POST" class="mt-4 flex gap-2">
            <button type="submit" name="execute_payload_os" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white py-2 rounded">Execute All Payloads</button>
            <button type="button" onclick="togglePayload('os')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded" id="toggleBtn-os">See Payloads</button>        
        </form>

        <!-- Wrapper Payload -->
        <div id="payloadContent-os" class="hidden mt-4 bg-black text-yellow-300 p-2 rounded">
            <?php $lines = file('payload_os.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
            ?>
        </div>

        <?php
        // OS Command Injection Vulnerability
        if (isset($_GET['ip'])) {
            $ip = $_GET['ip'];
            echo "<p class='mt-4 text-gray-700 font-semibold'>Ping Result:</p><pre class='bg-black text-green-400 p-2 rounded mt-2'>";
            system("ping -c 4 " . $ip);
            echo "</pre>";
        }
        // Execute all payloads from file
        if (isset($_POST['execute_payload_os'])) {
            echo "<p class='mt-4 text-gray-700 font-semibold'>Execute all Payloads from <code>payload_os.txt</code>:</p><pre class='bg-black text-green-400 p-2 rounded mt-2'>";
            $lines = file('payload_os.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo "\n$ " . htmlspecialchars($line) . "\n";
                system("ping -c 1 " . $line);
                echo "\n";
            }
            echo "</pre>";
        }
        ?>
        </div>

        <!-- Card Path Traversal -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test Path Traversal</h2>
        <p class="text-sm text-gray-500 mb-4">Enter file name to read (Ex: <code>payload_os.txt</code> or try: <code>../../etc/passwd</code>)</p>

        <form method="GET" action="">
            <input type="text" name="file" placeholder="Nama file..." class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Open File</button>
        </form>
        <form method="POST" class="mt-4 flex gap-2">
            <button type="submit" name="execute_payload_path" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white py-2 rounded">Execute All Payloads</button>
            <button type="button" onclick="togglePayload('path')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded" id="toggleBtn-path">See Payloads</button>        
        </form>

        <!-- Wrapper Payload -->
        <div id="payloadContent-path" class="hidden mt-4 bg-black text-yellow-300 p-2 rounded">
            <?php $lines = file('payload_path.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
            ?>
        </div>


        <?php

        // Path Traversal Vulnerability
        if (isset($_GET['file'])) {
            $file = $_GET['file'];

            echo "<p class='text-sm text-gray-500'>Input: <code>$file</code></p>";

            echo "<pre class='bg-black text-white p-2 rounded mt-2 overflow-x-auto'>";
            if (file_exists($file)) {
                echo htmlspecialchars(file_get_contents($file));
            } else {
                echo "File not found.";
            }
            echo "</pre>";
        }
        // Execute all payloads from file
        if (isset($_POST['execute_payload_path'])) {
            echo "<p class='mt-4 text-gray-700 font-semibold'>Execute all Payloads from <code>payload_path.txt</code>:</p><pre class='bg-black text-green-400 p-2 rounded mt-2'>";
            $lines = file('payload_path.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo "\n$ " . htmlspecialchars($line) . "\n";
                system("ping -c 1 " . $line);
                echo "\n";
            }
            echo "</pre>";
        }
        ?>
        </div>

        <!-- Card SQL Injection -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test SQL Injection</h2>
        <p class="text-sm text-gray-500 mb-4">Enter username to search (Ex: <code>admin</code> or try: <code>' OR '1'='1</code>)</p>

        <form method="GET" action="">
            <input type="text" name="usersearch" placeholder="Cari Username" class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Search User</button>
        </form>
        <form method="POST" class="mt-4 flex gap-2">
            <button type="submit" name="execute_payload_sql" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white py-2 rounded">Execute All Payloads</button>
            <button type="button" onclick="togglePayload('sql')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded" id="toggleBtn-sql">See Payloads</button>        
        </form>

        <!-- Wrapper Payload -->
        <div id="payloadContent-sql" class="hidden mt-4 bg-black text-yellow-300 p-2 rounded">
            <?php $lines = file('payload_sql.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
            ?>
        </div>

        <?php
        include '../db_connect.php';
        $query = "SELECT * FROM userdata";

        if (isset($_GET['usersearch']) && $_GET['usersearch'] !== '') {
            $input = $_GET['usersearch'];
            $query = "SELECT * FROM userdata WHERE username = '$input'";
            echo "<p class='text-sm text-gray-500 mt-2'>Query: <code>$query</code></p>";
        }

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<div class='mt-4 overflow-x-auto'><table class='min-w-full border text-sm text-gray-700'>";
            echo "<thead><tr><th class='border px-2 py-1'>ID</th><th class='border px-2 py-1'>Username</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td class='border px-2 py-1'>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td class='border px-2 py-1'>" . htmlspecialchars($row['username']) . "</td></tr>";
            }
            echo "</tbody></table></div>";
        } else {
            echo "<p class='text-red-600 mt-4'>No results.</p>";
        }
        ?>
        </div>

        <!-- Card XSS Injection -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test XSS (Cross-Site Scripting)</h2>
        <p class="text-sm text-gray-500 mb-4">Enter your name (Ex: <code>&lt;script&gt;alert('XSS')&lt;/script&gt;</code>)</p>

        <form method="GET" action="">
            <input type="text" name="xssname" placeholder="Enter your name..." class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Send</button>
        </form>
        <form method="POST" class="mt-4 flex gap-2">
            <button type="submit" name="execute_payload_xss" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white py-2 rounded">Execute All Payloads</button>
            <button type="button" onclick="togglePayload('xss')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded" id="toggleBtn-xss">See Payloads</button>        
        </form>

        <!-- Wrapper Payload -->
        <div id="payloadContent-xss" class="hidden mt-4 bg-black text-yellow-300 p-2 rounded">
            <?php $lines = file('payload_xss.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
            ?>
        </div>

        <?php
        if (isset($_GET['xssname'])) {
            $xssname = $_GET['xssname'];
            echo "<div class='mt-4 text-gray-800'>Hello, <strong>$xssname</strong>!</div>";
        }
        ?>
        </div>

        <!-- Card Upload Backdoor -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test Backdoor Upload</h2>
        <p class="text-sm text-gray-500 mb-4">Upload PHP file (Ex: <code>shell.php</code>) and if succcess try to access URL <code>/uploads/shell.php</code></p>

        <form method="POST" enctype="multipart/form-data" action="">
            <input type="file" name="file" class="mb-4">
            <button type="submit" name="upload" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Upload File</button>
        </form>

        <?php
        if (isset($_POST['upload'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "<p class='text-green-600 mt-4'>File successfully uploaded to <code>$target_file</code></p>";
                echo "<p>Akses file: <a class='text-blue-600 underline' href='$target_file' target='_blank'>$target_file</a></p>";
            } else {
                echo "<p class='text-red-600 mt-4'>Upload failed.</p>";
            }
        }
        ?>
        </div>

        <!-- Card SSRF -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test SSRF (Server-Side Request Forgery)</h2>
        <p class="text-sm text-gray-500 mb-4">Enter URL image or endpoint (Ex: <code>http://localhost:8000</code> or <code>http://127.0.0.1/etc/passwd</code>)</p>

        <form method="GET" action="">
            <input type="text" name="url" placeholder="URL target..." class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Ambil Konten</button>
        </form>

        <?php
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            echo "<p class='text-sm text-gray-500 mt-2'>Requested URL: <code>$url</code></p>";

            echo "<pre class='bg-black text-green-400 p-2 rounded mt-2 overflow-x-auto'>";
            echo htmlspecialchars(@file_get_contents($url));
            echo "</pre>";
        }
        ?>
        </div>

        <!-- Card LFI (Local File Inclusion) -->
        <div class="bg-white rounded-xl p-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-700">Test LFI (Local File Inclusion)</h2>
        <p class="text-sm text-gray-500 mb-4">Enter name of the file (Ex: <code>file1</code> will try to open <code>pages/file1.php</code>)</p>

        <form method="GET" action="">
            <input type="text" name="page" placeholder="Nama halaman..." class="w-full p-2 border rounded mb-4">
            <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-white py-2 rounded">Open Page</button>
        </form>
        <form method="POST" class="mt-4 flex gap-2">
            <button type="submit" name="execute_payload_lfi" class="flex-1 bg-blue-800 hover:bg-blue-900 text-white py-2 rounded">Execute All Payloads</button>
            <button type="button" onclick="togglePayload('lfi')" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded" id="toggleBtn-lfi">See Payloads</button>        
        </form>

        <!-- Wrapper Payload -->
        <div id="payloadContent-lfi" class="hidden mt-4 bg-black text-yellow-300 p-2 rounded">
            <?php $lines = file('payload_lfi.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                echo htmlspecialchars($line) . "<br>";
            }
            ?>
        </div>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page']; 
            $filepath = "pages/" . $page . ".php";
            echo "<p class='text-sm text-gray-500 mt-2'>Path: <code>$filepath</code></p>";
            
            if (file_exists($filepath)) {
                include($filepath);
            } else {
                echo "<p class='text-red-600'>Page not found.</p>";
            }
        }
        ?>
        </div>
    </div>

    <script>
    function togglePayload(suffix) {
        const content = document.getElementById("payloadContent-" + suffix);
        const btn = document.getElementById("toggleBtn-" + suffix);

        if (content.classList.contains("hidden")) {
            content.classList.remove("hidden");
            btn.innerText = "Close Payloads";
        } else {
            content.classList.add("hidden");
            btn.innerText = "See Payload";
        }
    }
    </script>

    </body>
</html>
