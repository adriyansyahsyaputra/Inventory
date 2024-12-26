<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div
        class="min-h-screen bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 flex items-center justify-center p-4">
        <div
            class="w-full max-w-md bg-white/20 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/30 overflow-hidden">
            <div class="bg-white/20 text-white p-8 text-center">
                <div class="flex justify-center mb-4">
                    <Shield size={64} class="text-white" />
                </div>
                <h2 class="text-3xl font-bold mb-2">Admin Dashboard</h2>
                <p class="text-white/80">Secure Access Portal</p>
            </div>

            <form action="{{ route('login.authenticate') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-user text-white/50 w-5 h-5"></i>
                    </div>
                    <input type="text" placeholder="Username" name="username"
                        class="w-full pl-10 pr-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30"
                        autofocus required value="{{ old('username') }}" />
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-lock text-white/50 w-5 h-5"></i>
                    </div>
                    <input type="password" placeholder="Password" name="password"
                        class="w-full pl-10 pr-3 py-2 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/30"
                        required />
                </div>
                
                @if(session()->has('error'))
                    <p class="text-red-500 text-xs mt-1">{{ session('error') }}</p>
                @endif

                <button type="submit"
                    class="w-full py-3 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white/30">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>
