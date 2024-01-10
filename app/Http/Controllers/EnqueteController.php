<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\OpcaoResposta; // Adicione esta linha

class EnqueteController extends Controller
{
  
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'titulo' => 'required|string',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after:dataInicio',
            'opcao1' => 'required|string',
            'opcao2' => 'required|string',
            'opcao3' => 'required|string',
        ]);

        $enquete = Enquete::create($data);

       

        return redirect()->route('home')
            ->with('enq_criada', 'Enquete criada com sucesso!');
    }
  
    public function update(Request $request, Enquete $enquete_id)
    {
        
        $data = $request->validate([
            'titulo' => 'required|string',
            'dataInicio' => 'required|date',
            'dataFim' => 'required|date|after:dataInicio',
            'opcao1' => 'required|string',
            'opcao2' => 'required|string',
            'opcao3' => 'required|string',
        ]);
    
        // Atualizar a enquete principal
        $enquete_id->update($data);
    
        // Atualizar opções de resposta
        $enquete_id->update([
            'opcao1' => $data['opcao1'],
            'opcao2' => $data['opcao2'],
            'opcao3' => $data['opcao3'],
        ]);

        return redirect()->route('home')
            ->with('enq_edit', 'Enquete editada com sucesso!');
    }

    public function destroy(Enquete $enquete_id)
{
    $enquete_id->delete();

    return redirect()->route('home')->with('enq_del', 'Enquete deletada com sucesso!');
}
public function show()
{
    $enquetes = Enquete::all();
    $enqueteIds = $enquetes->pluck('id')->toArray();
    $contagemVotos = OpcaoResposta::contagemVotosPorOpcao($enqueteIds)->get();

    // Preparar os dados para cada enquete
    $enquetesComVotos = $enquetes->map(function ($enquete) use ($contagemVotos) {
        $opcoesComVotos = collect(['opcao1', 'opcao2', 'opcao3'])->map(function ($opcao) use ($enquete, $contagemVotos) {
            return [
                'opcao' => $enquete->$opcao,
                'votos' => $contagemVotos->where('enquete_id', $enquete->id)->where('opcao', $enquete->$opcao)->first()->total ?? 0,
            ];
        });

        return [
            'enquete' => $enquete,
            'status' => $enquete->status, // Adiciona o status aqui
            'opcoesComVotos' => $opcoesComVotos,
        ];
    });

    return view('enquete.show', compact('enquetesComVotos'));
}

}
