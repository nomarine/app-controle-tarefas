@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  <div class=row>
                    <div class="col-6">
                      Tarefas
                    </div>
                    <div class="col-6">
                      <div class="float-right">
                        <a class="mr-3" href="{{ route('tarefa.export', ['extensao' => 'xlsx']) }}">XLSX</a>
                        <a class="mr-3" href="{{ route('tarefa.export', ['extensao' => 'csv']) }}">CSV</a>
                        <a class="mr-3" href="{{ route('tarefa.export', ['extensao' => 'pdf']) }}" target="_blank">PDF</a>
                        <a class="" href="{{ route('tarefa.create') }}">Novo</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tarefa</th>
                        <th scope="col">Data Limite de Conclusão</th>
                        <th scope="col" colspan="2">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($tarefas as $tarefa)
                      <tr>
                        <th scope="row">{{ $tarefa->id }}</th>
                        <td>{{ $tarefa->tarefa }}</td>
                        <td>{{ date('d/m/Y', strtotime($tarefa->dt_limite)) }}</td>
                        <td>
                          <a href="{{ route('tarefa.edit', ['tarefa' => $tarefa->id] ) }}">Editar</a>
                        </td>
                        <td>
                          <form id="form_{{$tarefa->id}}" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id] ) }}" method="post">
                          @csrf
                          @method("DELETE")
                            <a href="#" onclick="document.getElementById('form_{{$tarefa->id}}').submit()" >Excluir</a>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <nav>
                    <ul class="pagination">
                      <li class="page-item {{ $tarefas->onFirstPage() ? "disabled" : '' }}"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Anterior</a></li>
                      @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                        <li class="page-item {{ $tarefas->currentPage() == $i ? "active" : '' }}"><a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a></li>
                      @endfor
                      <li class="page-item {{ $tarefas->onLastPage() == $i ? "disabled" : '' }}"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Próximo</a></li>
                    </ul>
                  </nav>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
