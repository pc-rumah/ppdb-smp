<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <title>Login / Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.18/dist/full.css" rel="stylesheet" />
    <style>
        /* Additional custom responsive styles if needed */
        @media (max-width: 320px) {
            .auth-container {
                padding: 1rem;
                margin: 0.5rem;
            }

            .auth-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-base-200 px-2 sm:px-4 md:px-6 lg:px-8">

    <div
        class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl p-4 sm:p-6 md:p-8 bg-base-100 rounded-2xl shadow-xl space-y-4 sm:space-y-6">
        <!-- Header -->
        <div class="flex flex-col items-center text-center space-y-2 sm:space-y-3">
            <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" alt="Auth Icon"
                class="w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20" />
            <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-primary">Welcome Back</h2>
            <p class="text-xs sm:text-sm md:text-base text-base-content">Please login to your account</p>
        </div>

        <!-- Session / Error -->
        @if (session('status'))
            <div class="alert alert-success shadow-sm text-xs sm:text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any()))
            <div class="alert alert-error shadow-sm text-xs sm:text-sm">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM START -->
        <form method="POST" action="{{ route('login') }}" class="space-y-3 sm:space-y-4">
            @csrf

            <!-- Email -->
            <div class="form-control">
                <label class="label" for="email">
                    <span class="label-text text-xs sm:text-sm">Email</span>
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('email')
                    )
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-control">
                <label class="label" for="password">
                    <span class="label-text text-xs sm:text-sm">Password</span>
                </label>
                <input id="password" name="password" type="password" required
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('password')
                    )
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-control flex-row items-center gap-2">
                <input type="checkbox" name="remember" class="checkbox checkbox-secondary checkbox-sm sm:checkbox-md"
                    id="remember_me" />
                <label for="remember_me" class="text-xs sm:text-sm">Remember me</label>
            </div>

            <!-- Submit & Link -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <a href="{{ route('password.request') }}" class="text-xs sm:text-sm link link-secondary">Forgot
                    password?</a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto sm:btn-wide">Log In</button>
            </div>
        </form>
    </div>

</body>

</html>
