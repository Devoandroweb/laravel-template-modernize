<!doctype html>
<html lang="en">
@include('panels.head')
<body style="background: #edeff1">
<!--  Body Wrapper Start -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
data-sidebar-position="fixed" data-header-position="fixed">
<!-- Sidebar Start -->
@include('panels.sidebar')
<!--  Sidebar End -->
<!--  Main wrapper -->
<div class="body-wrapper ms-0">
@include('panels.navbar')
<div class="container mx-auto px-4" style="padding-top: 6rem;max-width:100%">
    @include('panels.content')
</div>
</div>
<!--  Body Wrapper End -->
@include('panels.script')
</body>
</html>
