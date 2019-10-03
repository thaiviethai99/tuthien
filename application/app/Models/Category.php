<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

	public $timestamps = false;
    public $fillable = ['title','parent_id'];


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function childs() {
        return $this->hasMany('App\Models\Category','parent_id','id') ;
    }
}