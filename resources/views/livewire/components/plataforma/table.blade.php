<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="" wire:click.prevent="createOpenModal">Cadastrar</a>
            <a href="" wire:click.prevent='editOpenModal'>Editar</a>
            <a href="" wire:click.prevent='showAlertQuestion'>Excluir</a>
            <a href="">Buscar</a>
        </div>
    </div>

    <div class="table-responsive height-table">
        <table class="myTable">
            <thead>
                <th>PLATAFORMA</th>
            </thead>
            <tbody>
                @forelse ($plataformas as $value)
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}">
                    <td>{{$value->plataforma}}</td>
                </tr>
                @empty
                <tr>
                    <td>NENHUMA PLATAFORMA CADASTRADA!</td>
                </tr>
                @endforelse
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
            Livewire.on('plataforma.table.marcarLinha', (id_linha) => {
                $('tr').removeClass('selecionado');
                $("tr#"+id_linha).addClass('selecionado');
                id_selecionado = id_linha;
            });

            Livewire.on('plataforma.table.openModal', () => {
                $('tr').removeClass('selecionado');
                id_selecionado = 0;
                $('#modalPlataforma').modal('show');
            });


            Livewire.on('plataforma.table.questionMsg', (msg, id_linha) => {
                function deletarPlataforma(){
                    Livewire.emit('deletarPlataforma', id_linha);
                }
                showQuestion(msg.titulo, msg.information, deletarPlataforma);
            });
        });
    </script>
</div>
