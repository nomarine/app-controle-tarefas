@component('mail::message')
{{ $tarefa }}

Data Limite de Conclusão: {{ date('d/m/Y', strtotime($dt_limite)) }}

@component('mail::button', ['url' => $url])
Ver Tarefa
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
