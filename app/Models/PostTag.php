<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function post()
    {
        return $this -> belongsTo(Post::Class);
    }

    public function tagBlogs()
    {
        return $this -> belongsTo(TagBlog::Class, 'tagBlog_id', 'id');
    }
}
