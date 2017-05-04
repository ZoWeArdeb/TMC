<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competition';

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Competition::class, 'parent');
    }
}