<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff dan Guru Kami</title>

    <!-- Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/styles.css') }}">

    <!-- Configure Tailwind with our color palette -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#9FB3DF',
                        'secondary': '#9EC6F3',
                        'accent': '#BDDDE4',
                        'neutral': '#FFF1D5',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <!-- Header -->
    @include('layouts.staffgallery.staffheader')

    @include('layouts.staffgallery.hero_Filter')

    @include('layouts.staffgallery.staff_Footer')

    <!-- Custom JavaScript -->
    <script src="{{ asset('staff&gallery/script.js') }}"></script>
</body>

</html>
