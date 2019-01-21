<?php

namespace Modules\Icommerceups\Entities;

use Illuminate\Database\Eloquent\Model;

class IcommerceupsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'icommerceups__icommerceups_translations';
}
