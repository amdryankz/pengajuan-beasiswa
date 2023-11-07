<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://cdn.tailwindcss.com"></script>



  @vite('resources/css/app.css')


</head>

<body>
  <div class="w-100 h-screen flex flex-row text-[#34364A]">
    <div id="Banner"
      class="w-1/2 bg-[url('/admin/images/GraphicSide.png')] bg-cover text-white flex flex-col justify-between font-sans">
      <div class="flex items-center pt-3 ml-3">
        <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c3/Unsyiah-logo.svg/640px-Unsyiah-logo.svg.png"
          alt="Logo Beasiswa" class="w-9 h-9 mr-2">
        <h2 class="text-xl font-semibold text-slate-100">BEASISWA USK</h2>
      </div>
      <div class="bg-gradient-to-t from-blue-800 pl-2 pb-2 pr-[25%]">
        <span class="text-md font-semibold text-slate-400"> &copy; 2023 BEASISWA USK</span>
      </div>
    </div>
    <div id="FormSection" class="w-1/2 flex flex-col justify-center items-center ">

      <h1 class="text-center mt-0 mb-8 text-2xl font-bold"><span class="text-xl">Selamat Datang </span><br />Admin
        Beasiswa Universitas Syiah Kuala</h1>
      <div id="Forms" class="flex flex-col gap-y-6 text-center w-7/12">
        @if (session('status'))
          <div class="alert alert-danger">
            {{ session('message') }}
          </div>
        @endif
        <form method="POST" action="" class="text-left font-medium flex flex-col gap-[16px]">
          @csrf
          <div class="flex flex-col">
            <label class="mb-2" for="NIP">NIP</label>
            <input type="text" id="nip" inputmode="numeric"
              class="border rounded-md border-gray-400 text-sm hover:border-sky-500 focus:border-sky-500 p-[8px_10px]"
              name="nip" placeholder="masukkan nip" required />
          </div>

          <div class="flex flex-col">
            <label class="mb-2" for="password">Password</label>
            <div class="relative">
              <input type="password" id="password"
                class="border rounded-md border-gray-400 text-sm hover:border-sky-500 focus:border-sky-500 p-[8px_10px] w-full"
                name="password" placeholder="masukkan password" required />
              <button type="button" id="togglePassword"
                class="items-center absolute top-[50%] right-[15px] transform -translate-y-1/2 password-toggle"
                onclick="togglePasswordVisibility()">
                <i id="passwordIcon" class="material-icons" style="font-size: 16px">visibility</i>
              </button>
            </div>
          </div>


          <div class="mt-4 flex items-center">
            <button type="submit"
              class="mx-auto bg-blue-600 text-white py-10 px-5 pt-2 pb-2 rounded-md hover:bg-blue-800">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @vite('resources/js/app.js')

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
