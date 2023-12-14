<h2>Lista de Tarefas</h2>
<table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tarefa</th>
        <th scope="col">Data Limite de Conclusão</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tarefas as $tarefa)
      <tr>
        <th scope="row">{{ $tarefa->id }}</th>
        <td>{{ $tarefa->tarefa }}</td>
        <td>{{ date('d/m/Y', strtotime($tarefa->dt_limite)) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>