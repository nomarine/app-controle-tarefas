<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Controle de Tarefas')
<img src="https://raw.githubusercontent.com/nomarine/app-controle-tarefas/smtp-config/public/img/logo.png" class="logo" alt="Controle de Tarefas Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
