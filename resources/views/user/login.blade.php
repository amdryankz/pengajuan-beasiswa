<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <style>
        .loading-screen {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-500 to-blue-300 min-h-screen flex flex-col justify-center items-center">
    <div class="loading-screen" id="loadingScreen">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full">

        @if (session('message'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="text-center">
            <img class="mx-auto mb-3 w-20 " src="https://usk.ac.id/wp-content/uploads/2020/11/logo_unsyiah.png"
                alt="logo usk">
            <h1 class="text-xl font-semibold mb-6">Login Mahasiswa</h1>
        </div>
        <form action="" method="post" class="space-y-4" onsubmit="showLoadingScreen()">
            @csrf

            <div>
                <label for="npm" class="block">
                    <span class="block font-semibold mb-1">NPM</span>
                    <input placeholder="Masukkan NPM" type="text" name="npm" id="npm"
                        class="border rounded-md w-full block text-sm py-2 px-3 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-500"
                        required>
                </label>
            </div>

            <div class="relative">
                <label for="password" class="block">
                    <span class="block font-semibold mb-1">Password</span>
                    <input placeholder="Masukkan Password" type="password" name="password" id="password"
                        class="border rounded-md w-full text-sm py-2 px-3 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-500 relative"
                        required>
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-3 right-1 h-full flex items-center justify-center password-toggle"
                        onclick="togglePasswordVisibility()">
                        <i id="passwordIcon" class="material-icons" style="font-size: 16px">visibility_off</i>
                    </button>
                </label>
            </div>

            <div class="flex justify-center">
                <button type="submit"
                    class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-800">Login</button>
            </div>
        </form>
    </div>

    <div class="text-center mt-4 text-white text-sm">&copy; BEASISWA USK</div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById("password");
            const passwordIcon = document.getElementById("passwordIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordIcon.innerText = "visibility_off";
            } else {
                passwordInput.type = "password";
                passwordIcon.innerText = "visibility";
            }
        }

        function showLoadingScreen() {
            document.getElementById("loadingScreen").style.display = "flex";
        }
    </script>
</body>

</html>
