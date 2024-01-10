<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcaoResposta extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo_id',
        'opcao',
      ];
    protected $table = 'opcao_respostas';
    public function enquete()
{
    return $this->belongsTo(Enquete::class);
}
public static function contagemVotosPorOpcao(array $enqueteIds)
    {
        return static::whereIn('enquete_id', $enqueteIds)
            ->select('enquete_id', 'opcao', \DB::raw('count(*) as total'))
            ->groupBy('enquete_id', 'opcao');
    }
}  
    
