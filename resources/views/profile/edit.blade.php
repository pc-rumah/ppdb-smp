<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-base-200 min-h-screen">
    <!-- Header -->
    <div class="navbar bg-base-100 shadow-sm">
        <div class="container mx-auto">
            <div class="flex-1">
                <a href="/dashboard" class="text-xl font-bold">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">

            <!-- Profile Information Card -->
            @include('profile.partials.update-profile-information-form')


            <!-- Update Password Card -->
            @include('profile.partials.update-password-form')

            <!-- Delete Account Card -->
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</body>

</html>
