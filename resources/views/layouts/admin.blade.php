<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <!-- Tambahkan CSS AdminLTE jika pakai -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    
    {{-- Sidebar --}}
    @include('partials.sidebar') <!-- Sidebar berisi menu: Dashboard, Dokter, dll -->

    {{-- Content --}}
    <div class="content-wrapper p-3">
        @yield('content')
    </div>

</div>

<!-- Tambahkan JS AdminLTE -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
</body>
</html>
