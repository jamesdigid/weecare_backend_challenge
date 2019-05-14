<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";

    protected $fillable = ['itunes_id', 'term', 'scheme'];
    protected $hidden = ['id', 'created_at', 'updated_at', 'itunes_id'];

    /**
     * Relationships
     */
    public function album() {
        return $this->hasMany("App\Album");
    }
}
