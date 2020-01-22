<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    
    protected $table = 'kelas';
    /**
     * The attributes that are mass assignable.
     *
    //  * @var array
     */
    protected $fillable = [
        'nama','sekolah_id'
    ];

    public function sekolah()
    {
        return $this->hasOne('App\Sekolah', 'sekolah_id');
    }


    public function siswa(){
        return $this->hasMany('App\Siswa', 'kelas_id');
    }
}
