<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    //Postモデルのリレーション（1対多）
    //$site->logs
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

}
