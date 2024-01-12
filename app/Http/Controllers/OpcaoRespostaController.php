<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OpcaoResposta;
use App\Events\EnqueteStatusUpdated;
class OpcaoRespostaController extends Controller
{
    public function store(Request $request, $enquete_id)
    {
    
        $data = $request->validate([
            'opcao' => 'required|string',
        ]);
    
       
        $enquete_id = (int)$enquete_id; 
      
        $opcaoResposta = new OpcaoResposta();
        $opcaoResposta->opcao = $data['opcao'];
        $opcaoResposta->enquete_id = $enquete_id;
        $opcaoResposta->save();
        
        broadcast(new EnqueteStatusUpdated('external'));
        return redirect()->route('enquete.show')
            ->with('enq_resp', 'Enquete respondida com sucesso!');
    }
}
         

           
