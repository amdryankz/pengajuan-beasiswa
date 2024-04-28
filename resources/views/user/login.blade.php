<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite('resources/css/app.css')
</head>

<body class="">
    <div class="flex h-screen bg-cyan-50">

        <!-- Bagian Kiri (Form) -->
        <div class="w-1/2 flex items-center justify-center">

            <div class="bg-white p-8 rounded-lg shadow-md w-96">

                @if (session('status'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative"
                        role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="">
                    <img class="mx-auto mb-3 w-20 " src="https://usk.ac.id/wp-content/uploads/2020/11/logo_unsyiah.png"
                        alt="logo usk">
                </div>
                <h1 class="text-center text-xl font-semibold mb-6">Login Mahasiswa</h1>
                <form action="" method="post">
                    @csrf

                    <div class="mb-4 relative">
                        <label for="npm" class="block mb-1">
                            <span
                                class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600">
                                Npm
                            </span>

                            <input placeholder="masukkan npm" type="text" name="npm" id="npm"
                                inputmode="numeric"
                                class="border-slate-400 rounded-md w-full block text-sm py-2 px-3 placeholder:text-slate-400 hover:border-sky-500 focus:border-sky-500"
                                required>
                        </label>
                    </div>

                    <div class="mb-4 relative">
                        <label for="password" class="mb-1 block">
                            <span
                                class="block font-semibold mb-1 text-slate-700 after:content-['*'] after:text-red-600">
                                Password
                            </span>

                            <div class="w-full relative">
                                <input placeholder="masukkan password" type="password" name="password" id="password"
                                    class="border-slate-400 rounded-md w-full block text-sm py-2 px-3 appearance-none placeholder:text-slate-400 hover:border-sky-500 focus:border-sky-500"
                                    required>
                        </label>
                        <button type="button" id="togglePassword"
                            class="absolute top-0 right-[10px] h-full items-center password-toggle"
                            onclick="togglePasswordVisibility()">
                            <i id="passwordIcon" class="material-icons" style="font-size: 16px">visibility</i>
                        </button>
                    </div>
            </div>


            <div class="mt-4 flex items-center">
                <button type="submit"
                    class="mx-auto bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-800">Login</button>
            </div>
            </form>
        </div>
    </div>


    <!--(Background) -->
    <div class="w-screen  bg-gradient-to-r from-blue-500 to-blue-300 flex flex-col-reverse items-end">
        <div class="text-right mb-1 mr-3">
            <span id="copyright" class="text-md font-semibold text-white"> &copy; BEASISWA USK</span>
        </div>
    </div>
    {{-- end Background --}}



    </div>

    {{-- Copyright --}}
    <script>
        const currentYear = new Date().getFullYear();
        const copyrightElement = document.getElementById('copyright');
        copyrightElement.textContent = `© ${currentYear} BEASISWA USK`;
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

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
    </script>

</body>

</html>
