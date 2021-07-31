<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $casts = [
        'nascimento' => 'date',
    ];

    public function cidade() {
        return $this->belongsTo(Cidade::class);
    }

    public function getIdadeFormatadaAttribute() {
        return Carbon::now()->diffForHumans($this->nascimento, CarbonInterface::DIFF_ABSOLUTE);
    }

    public function getIdadeAnosAttribute() {
        return Carbon::now()->diff($this->nascimento)->y;
    }
}
