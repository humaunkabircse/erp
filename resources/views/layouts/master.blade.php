@include('layouts.inc.header')
<body class="theme-blue">
<div id="wrapper">
@include('layouts.inc.navbar')


@include('layouts.inc.sidebar')

    <div id="main-content">
        @yield('content')
    </div>
    
</div>

@include('layouts.inc.footer')

