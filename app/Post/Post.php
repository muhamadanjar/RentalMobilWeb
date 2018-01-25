<?php namespace App\Post;
use App\AuditTrail\Loggable;
use App\AuditTrail\RevisionableTrait;
use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model {
	const STATUS_DRAFT      = 'draft';
	const STATUS_PUBLISH    = 'published';
	use RevisionableTrait;
    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'position', 'status'];

    public function getPossibleStatus(){
    	$type = DB::select( DB::raw("SHOW COLUMNS FROM $this->table WHERE Field = 'status'") )[0]->Type;
		preg_match('/^enum\((.*)\)$/', $type, $matches);
		$enum = array();
		foreach( explode(',', $matches[1]) as $value ){		
			$v = trim( $value, "'" );
			$enum = array_add($enum, $v, $v);
		}
		return $enum;
    }
	public function getPossiblePosition(){

    	$type = DB::select( DB::raw("SHOW COLUMNS FROM $this->table WHERE Field = 'position'") )[0]->Type;
		preg_match('/^enum\((.*)\)$/', $type, $matches);
		$enum = array();
		foreach( explode(',', $matches[1]) as $value ){		
			$v = trim( $value, "'" );
			$enum = array_add($enum, $v, $v);
		}
		return $enum;
	}
	public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }
	public function category(){
    	return $this->belongsTo(Category::class);
    }
    public function tags(){
    	return $this->belongsToMany(Tag::class,'post_tag');
	}
	public function comments(){
    	return $this->hasMany(Comment::class);
	}
	public function hasTags($name){
        foreach($this->tags as $tags) {
            if ($tags->name == $name) {
                return true;
            }
        }
        return false;
    }
    
	
	public function scopeBerita($query){
		return $query->leftjoin(DB::raw('(SELECT tags.*,post_tag.post_id FROM tags INNER JOIN post_tag ON tags.id = post_tag.tag_id) AS qry'), function($join){
			$join->on('qry.post_id', '=', 'posts.id');
		})
		->join('users', 'posts.author_id', '=', 'users.id')
		->join('categories', 'posts.category_id', '=', 'categories.id')
		->select('posts.*',
			DB::raw('users.`name` AS authorname'),
			DB::raw('categories.`name` AS categoryname'),
			DB::raw('categories.`slug` AS categoryslug'),
			DB::raw('GROUP_CONCAT(qry.`name`) AS group_tags')
		)->groupBy('posts.id');        
	}
	
	public function scopePage($query){
		return $query
		->join('users', 'posts.author_id', '=', 'users.id')
		->select('posts.*',
			DB::raw('users.`name` AS authorname')
		);        
	}
	
	public function getPermalinkPost(){
        return url('images/uploads/post').DIRECTORY_SEPARATOR.'/';
    }

    public function getPathPost(){
        return public_path('images/uploads/post').DIRECTORY_SEPARATOR.'/';
    }
}
