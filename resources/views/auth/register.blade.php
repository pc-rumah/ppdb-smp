<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.18/dist/full.css" rel="stylesheet" />
    <style>
        /* Additional custom responsive styles */
        @media (max-width: 320px) {
            .auth-container {
                padding: 0.75rem;
                margin: 0.25rem;
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
            <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-primary">Create Account</h2>
            <p class="text-xs sm:text-sm md:text-base text-base-content">Register for a new account</p>
        </div>

        <!-- Session / Error -->
        @if (session('status'))
            <div class="alert alert-success shadow-sm text-xs sm:text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error shadow-sm text-xs sm:text-sm">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM START -->
        <form action="{{ route('register') }}" method="POST" class="space-y-3 sm:space-y-4">
            @csrf

            <!-- Name -->
            <div class="form-control">
                <label class="label" for="name">
                    <span class="label-text text-xs sm:text-sm">Full Name</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('name')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-control">
                <label class="label" for="email">
                    <span class="label-text text-xs sm:text-sm">Email</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('email')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-control">
                <label class="label" for="password">
                    <span class="label-text text-xs sm:text-sm">Password</span>
                </label>
                <input type="password" id="password" name="password" required
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('password')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-control">
                <label class="label" for="password_confirmation">
                    <span class="label-text text-xs sm:text-sm">Confirm Password</span>
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="input input-bordered w-full text-xs sm:text-sm" />
                @error('password_confirmation')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 mt-3 sm:mt-4">
                <a href="{{ route('login') }}" class="text-xs sm:text-sm link link-secondary">Already registered?</a>
                <button type="submit" class="btn btn-primary w-full sm:w-auto sm:btn-wide">Register</button>
            </div>
        </form>
    </div>

</body>

</html>
