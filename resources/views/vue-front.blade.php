<!doctype html>
<html lang="en">
{{-- this is main view for budget management app --}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Budget Management</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('vue-assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('vue-assets/css/styles.min.css') }}" />
    @vite(['resources/js/app.js'])
</head>

<body>
    <!--  Body Wrapper -->
    <div id="app"></div>
    <script src="{{ asset('vue-assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vue-assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vue-assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('vue-assets/js/app.min.js') }}"></script>
    <script src="{{ asset('vue-assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vue-assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('vue-assets/js/dashboard.js') }}"></script>
</body>

</html>
