<?php

namespace fileSaver\Entity;

use Illuminate\Database\Eloquent\Model;

class Albums extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id', 'delete', 'image', 'photoCounter'
    ];
}