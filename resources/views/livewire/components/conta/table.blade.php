<div class="">
    {{-- Be like water. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="" wire:click.prevent='setOpcao(0)'>Cadastrar</a>
            <a href="" wire:click.prevent='setOpcao(1)'>Editar</a>
            <a href="" wire:click.prevent='showQuestionDelete'>Excluir</a>
            <a href="" wire:click.prevent='openModalFilter'>Buscar</a>
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
                @forelse ($conta_plataformas as $value)
                @if ($value->plataforma_id == 1)
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}" style="color: yellow">
                    <td>{{$value->email}}</td>
                    <td>{{$value->senha}}</td>
                    <td>{{$value->plataforma}}</td>
                </tr>
                @else
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}">
                    <td>{{$value->email}}</td>
                    <td>{{$value->senha}}</td>
                    <td>{{$value->plataforma}}</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="3">NENHUMA CONTA CADASTRADA!</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>

            </tfoot>
        </table>
        {{-- Paginação --}}
        <div class="row mt-3">
            <div class="col-md-12 d-flex justify-content-end">
                {{$conta_plataformas->links()}}
            </div>
        </div>
    </div>

    {{-- Modal de cadastro --}}
    @component('components.modal', ['titulo' => 'Cadastrar/Editar conta', 'id' => 'modalContaCreate'])
        <livewire:components.conta.formulario>
    @endcomponent

    {{-- Modal de filtro --}}
    @component('components.modal', ['titulo' => 'Buscar conta', 'id' => 'modalContaFilter'])
        <livewire:components.conta.form-filtro>
    @endcomponent
    <script>
        $(function(){
            Livewire.on('plataforma.table.marcarLinha', (id_linha) => {
                $('tr').removeClass('selecionado');
                $("tr#"+id_linha).addClass('selecionado');
            });
            Livewire.on('components.conta.openModalForm', () => {
                $('tr').removeClass('selecionado');
                $("#modalContaCreate").modal('show');
            });
            Livewire.on('components.conta.closeModalForm', () => {
                $("#modalContaCreate").modal('hide');
            });
            Livewire.on('components.conta.openModalContaFilter', () => {
                $('tr').removeClass('selecionado');
                $("#modalContaFilter").modal('show');
            });
            Livewire.on('components.conta.closeModalContaFilter', () => {
                $("#modalContaFilter").modal('hide');
            });

            Livewire.on('components.conta.table.showDeleteQuestion', (msg,id_linha) => {
                function deletar(){
                    Livewire.emit('deletePlataforma', id_linha);
                }
                showQuestion(msg.titulo, msg.information, deletar);
            });

            Livewire.on('conta.table.toast', (msg) => {
                showToast(msg.titulo, msg.information, msg.opcao);
                $('#modalPlataforma').modal('hide');
            });
        });
    </script>
</div>
