<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetType extends Model
{
    use HasFactory;
    protected $fillable = [
        'set_id',
        'type_id',
        'price',
        'table_count',
    ];
    protected $table = 'set_type';
    protected $with=['set','type'];

    public function set(){
        return $this->belongsTo(Set::class);
    }
    
    public function type(){
        return $this->belongsTo(Type::class);
    }


}
