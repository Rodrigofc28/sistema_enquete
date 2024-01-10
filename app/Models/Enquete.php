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
   
       if ($this->dataInicio <= $agora && $agora <= $this->dataFim) {
           $status = 'Em Andamento';
       } elseif ($agora > $this->dataFim) {
           $status = 'Finalizado';
       } elseif ($agora < $this->dataInicio) {
           $status = 'Não Iniciada';
       } else {
           // Pode adicionar lógica para outros casos, se necessário
           return null;
       }
   
       // Emitir evento de atualização
       //event(new \App\Events\EnqueteStatusUpdated($this));
   
       return $status;
   }

   

}

