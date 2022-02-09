<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <form wire:submit.prevent='setSearchValues'>
        <div class="row">
            <div class="col-md-12">
                <label for="">Email</label>
                <input type="text" class="form-control email" wire:model.lazy='email'>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="">Plataforma</label>
                <input type="text" name="" id="" list="plataformas" class="form-control" wire:model.lazy='plataforma'>
                <datalist id="plataformas">
                    @foreach ($plataformas as $value)
                        <option value="{{$value->plataforma}}"></option>
                    @endforeach
                </datalist>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary">
                    Buscar
                </button>
            </div>
        </div>
    </form>
</div>
