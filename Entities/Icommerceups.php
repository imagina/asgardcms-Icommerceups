<?php

namespace Modules\Icommerceups\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Icommerceups extends Model
{
    use Translatable;

    protected $table = 'icommerceups__icommerceups';
    public $translatedAttributes = [];
    protected $fillable = [];
}
