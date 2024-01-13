<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Enquete;
use App\Models\OpcaoResposta; // Adicione esta linha
use App\Events\EnqueteStatusUpdated;
class Votacao extends Component
{
    
    public function render()
    {
        $enquetesComVotos = $this->show();
        return view('livewire.votacao',compact('enquetesComVotos'));
    }
    public function show()
    {
        broadcast(new EnqueteStatusUpdated());
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
            // 
            return [
                'enquete' => $enquete,
                'status' => $enquete->status, // Adiciona o status aqui
                'opcoesComVotos' => $opcoesComVotos,
            ];
        });
        
        return $enquetesComVotos;
    }
}
