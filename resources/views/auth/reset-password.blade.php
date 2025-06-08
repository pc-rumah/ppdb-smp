<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-base-200 flex items-center justify-center p-4">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-base-content">Reset Password</h1>
                <p class="text-base-content/70 mt-2">Enter your email and new password</p>
            </div>

            <form class="space-y-4" method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Field -->
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text font-medium">Email Address</span>
                    </label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        class="input input-bordered w-full" required />

                    @if ($errors->has('email'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                </div>

                <!-- Password Field -->
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text font-medium">New Password</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Enter new password"
                        class="input input-bordered w-full" minlength="8" required />
                    <label class="label">
                        <span class="label-text-alt text-base-content/60">Must be at least 8 characters</span>
                    </label>

                    @if ($errors->has('password'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                </div>

                <!-- Confirm Password Field -->
                <div class="form-control">
                    <label class="label" for="password_confirmation">
                        <span class="label-text font-medium">Confirm Password</span>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm new password" class="input input-bordered w-full" minlength="8"
                        required />

                    @if ($errors->has('password_confirmation'))
                        <div class="mt-2 text-sm text-red-600">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>

                <!-- Error Message -->
                <div id="errorMessage" class="alert alert-error hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span id="errorText"></span>
                </div>

                <!-- Success Message -->
                <div id="successMessage" class="alert alert-success hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Password reset successfully!</span>
                </div>

                <!-- Submit Button -->
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">
                        <span class="loading loading-spinner loading-sm hidden" id="loadingSpinner"></span>
                        <span id="buttonText">Reset Password</span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
