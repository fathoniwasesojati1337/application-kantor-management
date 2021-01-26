<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detailt extends Model
{
    use HasFactory;

    protected $table = 'detailt';
    protected $primaryKey = 'id_detailt';
    protected $fillable = [
        'user_id',
        'nip',
        'pegawai',
        'address',
        'provinsi',
        'foto',
    ];

    public function fotoprofile(){

        if(!$this->foto){

            return asset('image/default.jpeg');

        }else{
            return asset('image/'.$this->foto);

        }

    }

}
