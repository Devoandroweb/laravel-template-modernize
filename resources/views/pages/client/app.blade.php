<!DOCTYPE html>
<html lang="en">
@include('pages.client.panels.head',['title'=>$title])
<body class="bg-main">
    <div class="container p-4">
        @yield('content')
    </div>
    @include('pages.client.panels.js')
</body>
</html>
