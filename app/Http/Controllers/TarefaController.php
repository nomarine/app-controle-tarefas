<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = auth()->user()->id;
        $nome = auth()->user()->name;
        $email = auth()->user()->email;
        return "ID: $id | Nome: $nome | E-mail: $email";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'tarefa' => 'required|max:200',
            'dt_limite' => 'after_or_equal:today'
        ];

        $feedback = [
            'max' => 'O campo :attribute tem que ter no máximo :max caracteres.',
            'required' => 'Obrigatório informar :attribute.',
            'after_or_equal' => 'Deve ser a data de hoje ou posterior.'
        ];

        $request->validate($regras, $feedback);

        $tarefa = Tarefa::create($request->all());

        return redirect()->route('tarefa.show', 
            ['tarefa' => $tarefa->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        echo 'Tarefa #' . $tarefa->id . ' ' . $tarefa->tarefa . ' | Data Limite de Conclusão ' . date('d/m/Y', strtotime($tarefa->dt_limite));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
