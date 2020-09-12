<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'post_category_name','post_category_description','post_category_status','post_category_slug','post_category_meta_keywords'
    ];
    protected $primaryKey = 'post_category_id';
    protected $table = 'tbl_category_post';
}
