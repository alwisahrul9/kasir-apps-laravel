<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body>
    <main class="flex justify-center items-center flex-col w-full h-screen overflow-hidden relative">
        <img src="{{ url('assets/bg_login.jpg') }}" class="absolute top-0 left-0 h-screen w-full brightness-[.4]" alt="">
        <div class="absolute flex flex-col justify-center items-center xl:w-1/4 md:w-1/2 w-3/4">
            <img src="{{ url('assets/icon.png') }}" class="rounded-full w-24 h-24 mb-6" alt="">
            @if (session('status'))
                <div class="flex w-full items-center p-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                    <span class="font-semibold">Oops!</span> {{ session('status') }}
                    </div>
                </div>
            @endif
            <form action="/login-process" method="POST">
                @csrf
                <label for="username" class="mb-3 text-white font-semibold text-lg">Username</label>
                <input type="text" name="username" id="username" placeholder="Masukkan Username" class="w-full mb-4 rounded-full px-4 focus:ring-orange-400 focus:border-none" required>
                <label for="password" class="mb-3 text-white font-semibold text-lg">Password</label>
                <input type="password" name="password" id="password" placeholder="********" class="w-full mb-4 rounded-full px-4 focus:ring-orange-400 focus:border-none" required>
                <button type="submit" class="bg-orange-400 mt-4 w-full rounded-full py-2 text-lg text-white font-semibold">Login</button>
            </form>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>