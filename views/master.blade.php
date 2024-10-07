<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion de contacts - @yield('title')</title>
</head>
<body>
<div class="container">
    @include('header')

    <main role="main" class="main-container">
        @yield('main')
    </main>

    @include('footer')
</div>
@yield('scripts')
</body>
</html>
