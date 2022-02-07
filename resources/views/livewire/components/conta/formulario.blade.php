<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <form wire:submit.prevent="">
        <div class="row">
            <div class="col-md-6">
                <label for="">Email</label>
                <input type="email" name="" id="" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="">Senha</label>
                <input type="text" name="" id="" class="form-control senha">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <label for="">Plataforma</label>
                <select name="" id="" class="form-select">
                    @foreach ($plataformas as $value)
                        <option value="{{$value->id}}">{{$value->plataforma}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </div>
        </div>
    </form>
</div>
