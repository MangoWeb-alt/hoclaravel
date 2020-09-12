<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'posts_name','posts_description','posts_status','posts_slug','posts_meta_keywords','posts_content','post_category_id','posts_image'
    ];
    protected $primaryKey = 'posts_id';
    protected $table = 'tbl_posts';
}
