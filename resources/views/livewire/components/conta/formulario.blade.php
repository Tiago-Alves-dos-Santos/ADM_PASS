<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <form wire:submit.prevent="createOrUpdater" method="get" class="needs-validation">
        <div class="row">
            <div class="col-md-6">
                <label for="">Email</label>
                <input type="email" wire:model.lazy='email' class="form-control @error('email') is-invalid @enderror">
                <div class="error-message">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="">Senha</label>
                <input type="text" wire:model.lazy='senha' class="form-control senha @error('senha') is-invalid @enderror">
                <div class="error-message">
                    @error('senha')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <label for="">Plataforma</label>
                <select wire:model.lazy='id_plataforma' class="form-select @error('id_plataforma') is-invalid @enderror">
                    <option value="0">Selecione a plataforma!</option>
                    @foreach ($plataformas as $value)
                        <option value="{{$value->id}}">{{$value->plataforma}}</option>
                    @endforeach
                </select>
                <div class="error-message">
                    @error('id_plataforma')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Salvar
                    <div class="spinner-border text-dark" role="status" wire:loading>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>
</div>
