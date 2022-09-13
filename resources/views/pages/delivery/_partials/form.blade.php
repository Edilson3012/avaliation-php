<div class="row">
    <label class="col-md-2 col-form-label">{{ __('Título') }}</label>
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" name="title" class="form-control" value="{{ $delivery->title ?? old('title') }}"
                placeholder="Título" required>
        </div>
        @if ($errors->has('title'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <label class="col-md-2 col-form-label">{{ __('Descrição') }}</label>
    <div class="col-md-6">
        <div class="form-group">
            <input type="text" id="description" name="description" class="form-control"
                value="{{ $delivery->description ?? old('description') }}" placeholder="Descrição" required>
        </div>
        @if ($errors->has('description'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <label class="col-md-2 col-form-label">{{ __('Prazo de Entrega') }}</label>
    <div class="col-md-6">
        <div class="form-group">
            <input type="datetime-local" id="deadline" value="{{ $delivery->deadline ?? old('deadline') }}"
                name="deadline" class="form-control" required>
        </div>
        @if ($errors->has('deadline'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('deadline') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="row">
    <label class="col-md-2 col-form-label">{{ __('Entrega concluída?') }}</label>
    <div class="col-md-3">
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" name="completed" id="completed" value="{{ $delivery->completed ?? old('completed') }}"
                    class="form-check-input">
                Marcar se já foi entregue
                <span class="form-check-sign">
                    <span class="check"></span>
                </span>
            </label>
        </div>
        @if ($errors->has('completed'))
            <span class="invalid-feedback" style="display: block;" role="alert">
                <strong>{{ $errors->first('completed') }}</strong>
            </span>
        @endif
    </div>
</div>
