<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquete;
use App\Models\OpcaoResposta; // Adicione esta linha
use App\Events\EnqueteStatusUpdated;
class EnqueteController extends Controller
{
  
    public function store(Request $request)
{
    $data = $request->validate([
        'titulo' => 'required|string',
        'dataInicio' => 'required|date|',
        'dataFim' => 'required|date|after:dataInicio',
        'opcao1' => 'required|string',
        'opcao2' => 'required|string',
        'opcao3' => 'required|string',
    ]);

    // Converta a data para o formato apropriado antes de criar o objeto.
    

    // Certifique-se de que o campo dataInicio esteja no $fillable no modelo Enquete.
   
    $enquete = new Enquete($data);
   
    $enquete->status = $enquete->getStatusAttribute(); // Configura o status
    
    $enquete->save();
    broadcast(new EnqueteStatusUpdated());
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
       
        $enquete_id->status = $enquete_id->getStatusAttribute();
        
        $enquete_id->save();
        broadcast(new EnqueteStatusUpdated());
        return redirect()->route('home')
            ->with('enq_edit', 'Enquete editada com sucesso!');
    }

    public function destroy(Enquete $enquete_id)
{
    $enquete_id->delete();
    broadcast(new EnqueteStatusUpdated('external'));
    return redirect()->route('home')->with('enq_del', 'Enquete deletada com sucesso!');
}
public function show()
{
   return view('enquete.show');
}
    
    

}
