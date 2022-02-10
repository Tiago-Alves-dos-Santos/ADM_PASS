<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="" wire:click.prevent="createOpenModal">Cadastrar</a>
            <a href="" wire:click.prevent='editOpenModal'>Editar</a>
            <a href="" wire:click.prevent='showAlertQuestion'>Excluir</a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalPlataformaFiltro">Buscar</a>
        </div>
    </div>

    <div class="table-responsive height-table">
  
        <table class="myTable">
            <thead>
                <th>
                    PLATAFORMA
                    @if ($search_plataform !== '' & $search_plataform !== null)
                    , PROCURANDO: {{$search_plataform}}
                    @endif
                </th>
            </thead>
            <tbody>
                @forelse ($plataformas as $value)
                @if ($value->id == 1)
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}" style="color: yellow">
                    <td>{{$value->plataforma}}</td>
                </tr>
                @else
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}">
                    <td>{{$value->plataforma}}</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td>NENHUMA PLATAFORMA CADASTRADA!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
        {{-- Paginação --}}
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
                {{$plataformas->links()}}
            </div>
        </div>
    </div>

    {{-- Modal de cadastro --}}
    @component('components.modal', ['titulo' => 'Cadastrar/Editar plataforma', 'id' => 'modalPlataforma'])
        <livewire:components.plataforma.formulario>
    @endcomponent
    {{-- Modal de filtro --}}
    @component('components.modal', ['titulo' => 'Buscar plataforma', 'id' => 'modalPlataformaFiltro'])
        <livewire:components.plataforma.form-filtro>
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
