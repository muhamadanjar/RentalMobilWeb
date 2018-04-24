<?php namespace App\Post;
use App\Post\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
class EloquentRepository implements RepositoryInterface {

    /**
     * @type Post
     */
    private $post;
    private $comment;
    private $tag;
    private $category;

    function __construct(Post $post,Comment $comment,Tag $tag,Category $category){
        $this->post = $post;
        $this->comment = $comment;
        $this->tag = $tag;
        $this->category = $category;
    }

    public function all(){
        return $this->post->all();
    }
    public function get(){
        return $this->post->get();
    }
    public function alltags(){
        return $this->tag->limit(15)->get();
    }

    public function allcategory(){
        return $this->category->limit(15)->get();
    }

    public function tag_has($tag){
        foreach($this->tag_get() as $k){
            if($k == $tag){
                return true;
            }
        }
        return false;
    }

    public function findBySlug($slug){
        return $this->post->whereSlug($slug)->first();
    }
    public function getByPosition($position){
        return $this->post->wherePosition($position)->get();
    }

    public function countByPosition($position){
        return $this->post->wherePosition($position)->count();
    }

    public function getByType($type){
        return $this->post->whereTypePost($type)->get();
    }

    public function countByType($type){
        return $this->post->whereTypePost($type)->count();
    }

    public function create($input, $author){
        $post = $this->post->create($input);
        $post->author()->associate($author)->save();
        return $post;
    }

    public function update($id, $input){
        return $this->post->findOrFail($id)->update($input);
    }

    public function find($id){
        return $this->post->findOrFail($id);
    }

    public function delete($id){
        $post = $this->post->findOrFail($id);
        $tag = $post->tags()->sync([]);

        return $post->delete();
    }

    public function getPagination($page){
        return $this->post->whereStatus('published')->whereTypePost('post')->paginate($page);
    }

    public function getPost($type='post'){
        return $this->post->whereStatus('published')
        ->whereTypePost($type)
        ->orderBy('posts.posted_at','DESC')
        ->paginate();
    }

    public function getPostBySearch($search){
        return $this->post->whereStatus('published')
        ->where('type_post','post')
        ->where('posts.slug','like','%'.$search.'%')->where('posts.title','like','%'.$search.'%')
        ->paginate();
    }

    public function getPostByCategory($category){
        return $this->post->berita()->whereStatus('published')
        ->whereTypePost('post')
        ->orderBy('posts.posted_at','DESC')
        ->where('categories.slug',$category)
        
        ->paginate();
    }
    public function getPostByTag($tags){
        return $this->post->whereStatus('published')
        ->whereTypePost('post')
        ->orderBy('posts.posted_at','DESC')
        ->paginate();
    }
    public function getRandomPost($count){
        return $this->post->whereStatus('published')->whereTypePost('post')->limit($count)->inRandomOrder()->get();
    }

    public function getRecentPost($count){ 
        return $this->post->whereStatus('published')->whereTypePost('post')->limit($count)->get();
    }

    public function getPage($slug){
        return $this->post->page()->whereStatus('published')
        ->whereTypePost('page')
        ->where('posts.slug',$slug)
        ->first();
    }

    public function getInformasi($slug,$type){
        return $this->post->page()->whereStatus('published')
        ->whereTypePost($type)
        ->where('posts.slug',$slug)
        ->first();
    }

    public function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');

        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }

    public function store_comment($request,$post_id){
        $post = $this->post->find($post_id);
        $comment = new Comment();
        $comment->author_id = $request->author_id;
        $comment->content = $request->content;
        $comment->posted_at = Carbon::now();
        //$comment->approved = true;
        $comment->post()->associate($post);
        
        $comment->save();

        
        return $comment;
    }

    public function update_comment($request, $id){
        $comment = Comment::find($id);

        $this->validate($request, array('comment' => 'required'));

        $comment->comment = $request->comment;
        $comment->save();

        return $comment;
    }
    public function destroy_comment($id){
        $comment = Comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        return $comment;
    }
    public function getBerita(){
        return $this->post->berita()->whereStatus('published');
    }
    public function postfeatureimage($path = ''){
        $dir = public_path().$path;
        if(!is_dir($dir))
            mkdir($dir);
            $ext = pathinfo($_FILES["images"]["name"],PATHINFO_EXTENSION);
            $filename = time().'_'.urlencode(pathinfo($_FILES["images"]["name"],PATHINFO_FILENAME)).'.'.$ext;
            if(move_uploaded_file($_FILES["images"]["tmp_name"], $dir. $filename)){
                return json_encode(array(
                        'error'=>false,
                        'dir'=>$dir,
                        'filename'=>$filename,
                        'data'=>$_FILES["images"]
                ));
                exit;
            }
        return json_encode(array('error'=>true,'message'=>'Upload process error'));
        exit;
    }

    public function popularPost(){
        $berita = $this->post->whereStatus('published')
        ->where('posts.type_post','post')->orderBy('dibaca','DESC')->limit(5)->get();

        return $berita;
    }

    public function recentPost(){
        $berita = $this->post->whereStatus('published')
        ->where('posts.type_post','post')->orderBy('posted_at','DESC')->limit(5)->get();

        return $berita;
    }

    public function postDibaca($id){
        //return $this->post->findOrFail($id)->increment('dibaca','1');
        return $this->post->where('id',$id)->update(['dibaca'=>DB::raw('dibaca+1')]);
    }
    
}

