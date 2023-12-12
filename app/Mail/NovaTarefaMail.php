<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Tarefa;

class NovaTarefaMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $tarefa;
    public $dt_limite;
    public $url;

    public function __construct(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa->tarefa;
        $this->dt_limite = $tarefa->dt_limite;
        $this->url = "http://localhost:8000/tarefa/$tarefa->id";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.nova-tarefa')->subject($this->tarefa);
    }
}
