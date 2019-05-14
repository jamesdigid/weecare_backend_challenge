<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $table = "content_type";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     * Relationships
     */
    public function album() {
        return $this->belongsTo("App\Album");
    }
}
