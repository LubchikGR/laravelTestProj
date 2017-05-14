<?php

namespace fileSaver\Entity;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'id', 'album_id', 'delete'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
