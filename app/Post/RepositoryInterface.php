<?php namespace App\Post;

interface RepositoryInterface {

    public function all();

    public function get();

    public function alltags();
    public function allcategory();

    public function findBySlug($slug);

    public function getByPosition($position);

    public function countByPosition($position);

    public function getByType($type);

    public function countByType($type);

    public function create($input, $authorId);

    public function update($id, $input);

    public function find($id);

    public function delete($id);
    
    public function getPagination($page);
    
    public function getPost();

    public function getPostBySearch($search);

    public function getPostByCategory($category);

    public function getRandomPost($count);

    public function getRecentPost($count);

    public function getPage($slug);

    public function getInformasi($slug,$type);

    public function seo_title($s);

    public function store_comment($request,$post_id);

    public function update_comment($request, $id);

    public function destroy_comment($id);

    public function getBerita();

    public function postfeatureimage($path);

    public function popularPost();

    public function recentPost();

    public function postDibaca($id);
}
