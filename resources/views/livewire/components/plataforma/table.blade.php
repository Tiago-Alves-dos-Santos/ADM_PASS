<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPlataforma">Cadastrar</a>
            <a href="">Editar</a>
            <a href="">Excluir</a>
            <a href="">Buscar</a>
        </div>
    </div>

    <div class="table-responsive height-table">
        <table class="myTable">
            <thead>
                <th>PLATAFORMA</th>
            </thead>
            <tbody>
                @for ($i=0; $i < 40; $i++)
                <tr wire:click='' id="{{$i}}">
                    <td>PAGSEGURO {{$i}}</td>
                </tr>
                @endfor
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    {{-- Paginação --}}


    {{-- Modal de cadastro --}}
    @component('components.modal', ['titulo' => 'Cadastrar/Editar plataforma', 'id' => 'modalPlataforma'])
        <livewire:components.plataforma.formulario>
    @endcomponent
    <script>
        $(function(){
            let id_selecionado = 0;
            Livewire.on('evt.marcarLinha', (id_linha) => {
                $('tr').removeClass('selecionado');
                $("tr#"+id_linha).addClass('selecionado');
                id_selecionado = id_linha;
            })
        });
    </script>
</div>
