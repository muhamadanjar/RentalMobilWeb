<?php

namespace App\Post;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Comment extends Model
{
    protected $fillable = [
        'author_id',
        'post_id',
        'content',
        'posted_at'
    ];
  
    
    protected $dates = [
        'posted_at'
    ];
  
    public function scopeLastWeek($query){
          return $query->whereBetween('posted_at', [Carbon::now()->subWeek(), Carbon::now()])
                       ->latest();
    }

    public function scopeLatest($query){
          return $query->orderBy('posted_at', 'desc');
    }
  
    public function author(){
          return $this->belongsTo(User::class, 'author_id');
    }
  
    public function post(){
          return $this->belongsTo(Post::class);
    }
}
