<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Http\Requests\StoreContatoRequest;
use App\Http\Requests\UpdateContatoRequest;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ContatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contatos = Contato::where('user_id', auth()->id())->orderBy('nome')->get();

        return Inertia::render('Contatos/Index', [
            'contatos' => $contatos,
        ]);
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
    public function store(StoreContatoRequest $request)
    {
        //Armazenando a imagem no storage
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('contatos', 'public');
        } else {
            $imagem = null;
        }

        // Criando um novo contato
        Contato::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'imagem' => $imagem,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('contatos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contato $contato)
    {
        $contato->formatted_updated_at = $contato->updated_at->format('d/m/Y H:i');
        return Inertia::render('Contatos/Show', [
            'contato' => $contato,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contato $contato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContatoRequest $request, Contato $contato)
    {
        //Atualizando a imagem no storage
        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('contatos', 'public');
        } else {
            $imagem = $contato->imagem;
        }

        //Atualizando o contato
        $contato->update([
            'nome' => $request->nome,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'imagem' => $imagem,
        ]);

        return redirect()->route('contatos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contato $contato)
    {
        //Deletando a imagem do storage
        try {
            Storage::delete($contato->imagem);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao deletar o contato');
        }
        $contato->delete();
        return redirect()->route('contatos.index')->with('success', 'Contato deletado com sucesso');
    }
}
