<?php namespace App\Moderator;

interface RepositoryInterface {

    public function users();

    public function usersByGroups($roles);

    public function findUserById($id);

    public function addUser($input);

    public function updateUser($id, $input);

    public function deleteUser($id);

    public function groups();

    public function findGroupById($id);

    public function addGroup($input);

    public function updateGroup($id, $input);

    public function deleteGroup($id);

    public function resources();

    public function findResourceById($id);

    public function addResource($input);

    public function updateResource($id, $input);

    public function deleteResource($id);

    public function assignGroups($userId, $group);

    public function assignPermissions($groupId, $resources);

    function UploadImage($fupload,$vdir_upload ='',$name_upload ='',$image_thumbnail=false,$watermark_show=false);

    function watermark_image($oldimage_name);

    function countUser();

}
