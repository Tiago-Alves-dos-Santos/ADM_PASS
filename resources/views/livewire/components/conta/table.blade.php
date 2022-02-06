<div class="">
    {{-- Be like water. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalContaCreate">Cadastrar</a>
            <a href="">Editar</a>
            <a href="">Excluir</a>
            <a href="">Buscar</a>
        </div>
    </div>

    <div class="table-responsive height-table">
        <table class="myTable">
            <thead>
                <th>EMAIL</th>
                <th>SENHA</th>
                <th>PLATAFORMA</th>
            </thead>
            <tbody>
                @for ($i=0; $i < 40; $i++)
                <tr wire:click='marcarLinha({{$i}})' id="{{$i}}">
                    <td>teste@email.com</td>
                    <td>12345</td>
                    <td>PAGSEGURO</td>
                </tr>
                @endfor
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    {{-- Paginação --}}


    {{-- Modal de cadastro --}}
    @component('components.modal', ['titulo' => 'Cadastrar/Editar conta', 'id' => 'modalContaCreate'])
        <livewire:components.conta.formulario>
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
