<!DOCTYPE html>
<html lang="pt-BR">
@include('include.header')
<body id="{{$pageId}}">
    <div class="container">
        <div class="default-container">
            @component('components.link_icon', ['url' => '', 'titulo' => 'Contas', 'id' => 'contas'])
                <i class="fas fa-address-book"></i>
            @endcomponent
            @component('components.link_icon', ['url' => '', 'titulo' => 'Categorias','id' => 'categoria'])
                <i class="fas fa-clipboard-list"></i>
            @endcomponent
            {{-- @component('components.link_icon', ['url' => '', 'titulo' => 'Vincular', 'id' => 'vincular'])
                <i class="fas fa-link"></i>
            @endcomponent --}}
            
        </div>
    </div>
    <div class="container-fluid">
        @yield('defaultPage')
    </div>
    @include('include.footer')   
</body>
</html>