<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'post_name','post_description','post_status','post_slug','post_meta_keywords'
    ];
    protected $primaryKey = 'post_id';
    protected $table = 'tbl_post';
}
