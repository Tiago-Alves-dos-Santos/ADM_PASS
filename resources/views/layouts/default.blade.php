<!DOCTYPE html>
<html lang="pt-BR">
@include('include.header')
<body>
    <div class="container">
        <div class="default-container">
            @component('components.link_icon')
            
            @endcomponent
            @component('components.link_icon')
            
            @endcomponent
            @component('components.link_icon')
            
            @endcomponent
        </div>
    </div>
    <div class="container-fluid">
        @yield('defaultPage')
    </div>
    @include('include.footer')   
</body>
</html>