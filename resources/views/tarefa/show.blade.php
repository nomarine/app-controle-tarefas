@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa }}</div>

                <div class="card-body">
                  <fieldset disabled>
                    <div class="mb-3">
                      <label for="dt_limite" class="form-label">Data Limite de Conclusão</label>
                      <input type="date" class="form-control" value="{{ $tarefa->dt_limite }}">
                      {{ $errors->has('dt_limite') ? $errors->first('dt_limite') : '' }}
                    </div>
                  </fieldset>
                  
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
