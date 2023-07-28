<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = "pengeluaran";
    protected $primaryKey = 'nobukti';
    protected $keyType = 'string';
    protected $guarded = [];


    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'format' => function () {
                    return 'SO/' . date('Y.m.d') . '/' . $this->branch . '/?';
                },
                'length' => 5,
            ]
        ];
    }
}
