<div class="">
    {{-- Be like water. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="" wire:click.prevent='setOpcao(0)'>Cadastrar</a>
            <a href="">Editar</a>
            <a href="">Excluir</a>
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
                <tr wire:click='marcarLinha({{$value->id}})' id="{{$value->id}}">
                    <td>{{$value->email}}</td>
                    <td>{{$value->senha}}</td>
                    <td>{{$value->plataforma}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">NENHUMA CONTA CADASTRADA!</td>
                </tr>
                @endforelse
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
            Livewire.on('conta.table.toast', (msg) => {
                showToast(msg.titulo, msg.information, msg.opcao);
                $('#modalPlataforma').modal('hide');
            });
        });
    </script>
</div>
