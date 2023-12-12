@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastro de Tarefa</div>

                <div class="card-body">
                    <form method="post" action="{{ route('tarefa.store') }}" >
                    @csrf
                        <div class="mb-3">
                          <label for="tarefa" class="form-label">Tarefa</label>
                          <input name ="tarefa" type="text" class="form-control" value="{{ old('tarefa') }}">
                          {{ $errors->has('tarefa') ? $errors->first('tarefa') : '' }}
                        </div>
                        <div class="mb-3">
                          <label for="dt_limite" class="form-label">Data Limite de Conclusão</label>
                          <input name="dt_limite" type="date" class="form-control" value="{{ old('dt_limite') }}">
                          {{ $errors->has('dt_limite') ? $errors->first('dt_limite') : '' }}
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastro</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
