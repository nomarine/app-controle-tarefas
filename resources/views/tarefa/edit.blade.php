@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alteração da Tarefa</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}" >
                    @method('PUT')  
                    @csrf
                        <div class="mb-3">
                          <label for="tarefa" class="form-label">Tarefa</label>
                          <input name ="tarefa" type="text" class="form-control" value="{{ $tarefa->tarefa ?? old('tarefa') }}">
                          {{ $errors->has('tarefa') ? $errors->first('tarefa') : '' }}
                        </div>
                        <div class="mb-3">
                          <label for="dt_limite" class="form-label">Data Limite de Conclusão</label>
                          <input name="dt_limite" type="date" class="form-control" value="{{ $tarefa->dt_limite ?? old('dt_limite') }}">
                          {{ $errors->has('dt_limite') ? $errors->first('dt_limite') : '' }}
                        </div>

                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Alterar Tarefa</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
