<!DOCTYPE html>
<html lang="en" data-theme="cupcake">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.18/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="min-h-screen flex items-center justify-center bg-base-200 px-4">

    <div class="w-full max-w-md p-8 space-y-6 bg-base-100 rounded-2xl shadow-xl">
        <!-- Icon & Title -->
        <div class="flex flex-col items-center text-center space-y-3">
            <img src="https://cdn-icons-png.flaticon.com/512/1032/1032284.png" alt="Forgot Icon" class="w-20 h-20" />
            <h2 class="text-2xl font-bold text-primary">Forgot Your Password?</h2>
            <p class="text-sm text-base-content">
                No problem. Just enter your email and we’ll send you a password reset link.
            </p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success shadow-sm text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-error shadow-sm text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div class="form-control">
                <label class="label" for="email">
                    <span class="label-text">Email</span>
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="input input-bordered w-full" />
                @error('email')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-primary btn-wide">Send Reset Link</button>
            </div>
        </form>
    </div>

</body>

</html>
