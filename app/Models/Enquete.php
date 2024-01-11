<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Enquete extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'titulo',
        'dataInicio',
        'dataFim',
        'opcao1',
        'opcao2',
        'opcao3',
        'status',
    ];

    protected $table = 'enquetes';
    protected $dates = ['dataInicio', 'dataFim'];

    public function opcoesResposta()
    {
        return $this->hasMany(OpcaoResposta::class);
    }
    public function opcao1()
    {
        return $this->hasOne(OpcaoResposta::class, 'enquete_id')->where('nome_opcao', 'opcao1');
    }

    public function opcao2()
    {
        return $this->hasOne(OpcaoResposta::class, 'enquete_id')->where('nome_opcao', 'opcao2');
    }

    public function opcao3()
    {
        return $this->hasOne(OpcaoResposta::class, 'enquete_id')->where('nome_opcao', 'opcao3');
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($enquete) {
            $enquete->opcoesResposta()->delete();
        });
    }

    // Novo método para determinar o status
   // Novo método para determinar o status
  
   public function getStatusAttribute()
{
    $agora = now();

    // Lógica para determinar o status
    $dataInicio = new \DateTime($this->dataInicio);
    $dataFim = new \DateTime($this->dataFim);
    if (($agora > $dataInicio) && ($agora < $dataFim)) {
        $status = 'Em Andamento';
    } elseif ($agora > $dataFim) {
        $status = 'Finalizado';
    } elseif ($agora < $dataInicio) {
        $status = 'Não Iniciada';
    } else {
        // Defina um valor padrão ou lógica apropriada se necessário
        $status = 'Indefinido';
    }
   
    return $status;
}

}
   



