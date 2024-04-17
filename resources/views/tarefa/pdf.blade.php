<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .titulo{
                text-transform:uppercase;
                border:1px;
                background-color: #c2c2c2;
                font-weight: bold;
                text-align: center;
                width: 100%;
                margin-bottom: 25px;
            }

            table{
                width: 100%;
            }

            table th {
                text-align:left;
            }

            .page-break {
                page-break-after: always;
            }

        </style>
    </head>    

    <body>
        <div class="titulo">
            Lista de Tarefas
        </div>

        <table>
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

        <div class="page-break"></div>
        <h1>Page 2</h1>

        <div class="page-break"></div>
        <h1>Page 3</h1>
    </body>
