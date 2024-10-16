<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessorController extends Controller
{

    public function  __construct(Professor $professor){
        $this->professor = $professor;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professor = $this->professor::all();
        return response()->json($professor, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->professor->rules(), $this->professor->feedback());

        $this->professor->nome = $request->nome;
        $this->professor->email = $request->email;
        $this->professor->telefone = $request->telefone;
        $this->professor->foto = $request->file('foto')->store('public');
        $this->professor->save();

        return response()->json($this->professor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $professor = $this->professor::find($id);

        if ($professor === null) 
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);

        return response()->json($professor, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professor $professor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $professor = $this->professor::find($id);

        if ($professor === null) 
            return response()->json(['erro' => 'Não foi possível atualizar! Recurso não existe'], 404);

        $request->validate($this->professor->rules(), $this->professor->feedback());


        $professor->update($request->all());
        return response()->json($professor, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $professor = $this->professor::find($id);

        if ($professor === null) 
            return response()->json(['erro' => 'Não foi possível deletar! Recurso não existe'], 404);

        $professor->delete();
        Storage::delete($professor->foto);
        return response()->json(['message' => 'Professor deletado com sucesso!'], 200);
    }
}
