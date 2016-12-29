<!DOCTYPE html>
<html>

@include('partials._head')

<body>

    @include('partials._nav')

    <div class="container">
    	@include('partials._messages')
    	
        @yield('content')

        @include('partials._footer')
    </div>

    @include('partials._common_scripts')    

    @yield('scripts')

</body>
</html>