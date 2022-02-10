<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <form wire:submit.prevent='searchPlataform' method="get">
        <div class="row">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" list="plataformas" wire:model.lazy='plataforma'>
                    <label for="floatingInput">Plataforma:</label>
                    <datalist id="plataformas">
                        @foreach ($plataformas as $value)
                        <option value="{{$value->plataforma}}">
                        @endforeach
                    </datalist>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
            </div>
        </div>
    </form>

    <script>
        $(function(){
            Livewire.on('plataforma.form-filtro.closeModal', () => {
                $("#modalPlataformaFiltro").modal('hide');
            });
        });
    </script>
</div>
