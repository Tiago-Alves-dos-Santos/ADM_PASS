<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form wire:submit.prevent='createUpdate' method="get" class="needs-validation">
        <div class="row">
            <div class="col-md-12">
                <label for="">Plataforma</label>
                <input type="text" wire:model.lazy='plataforma' class="form-control @error('plataforma') is-invalid @enderror" autofocus>
                <div class="error-message">
                    @error('plataforma')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end mt-2">
                <button class="btn btn-primary">
                    <span class="d-block">Salvar</span>
                    <div class="spinner-border text-dark" role="status" wire:loading>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>
    <script>
        $(function(){
            Livewire.on('plataforma.formulario.toast', (msg) => {
                showToast(msg.titulo, msg.information, msg.opcao);
                $('#modalPlataforma').modal('hide');
            });
        });
    </script>
</div>
