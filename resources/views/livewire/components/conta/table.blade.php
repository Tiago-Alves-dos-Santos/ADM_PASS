<div class="">
    {{-- Be like water. --}}
    <div class="conta-container-acoes">
        <div class="acoes">
            <a href="">Cadastrar</a>
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
                <tr>
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
</div>
