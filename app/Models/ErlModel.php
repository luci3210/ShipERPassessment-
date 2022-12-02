<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErlModel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'erp';
    protected $fillable = ['id','imgpro','imgurl'];
    // protected $primaryKey = 'id';
}
