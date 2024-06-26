<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NovaTarefaMail;
use App\Exports\TarefasExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $logged_user = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $logged_user)->paginate(2);

        return view('tarefa.index', ['tarefas' => $tarefas]);
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

        $dados = $request->all('tarefa', 'dt_limite');
        $dados['user_id'] = auth()->user()->id;
        $tarefa = Tarefa::create($dados);

        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));

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
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');   
        }
        return view('tarefa.edit', ['tarefa' => $tarefa]);
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

        $dados = $request->all('tarefa', 'dt_limite');

        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');    
        }
        $tarefa->update($dados);
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if(!$tarefa->user_id == $user_id){
            return view('acesso-negado');    
        }
        $tarefa->destroy($tarefa->id);

        return redirect()->route('tarefa.index');
    }

    public function export($extensao) 
    {
        if(in_array(strtolower($extensao), ['csv','xlsx'])){
            return Excel::download(new TarefasExport, 'tarefas.'.$extensao);
        } else if(strtolower($extensao) == 'pdf'){
            $tarefas = auth()->user()->tarefas()->get();
            $pdf = Pdf::loadView('tarefa.pdf', ['tarefas' => $tarefas]);
            $pdf->setPaper('a4', 'landscape');
            
            return $pdf->stream('tarefas.pdf');
        }

        return redirect()->route('tarefa.index');    
    }
}
