<?php namespace App\Moderator;

use App\Moderator\Models\User;
use App\Moderator\Models\Group;
use App\Moderator\Models\Resource;
use Illuminate\Support\Facades\Hash;

class EloquentRepository implements RepositoryInterface{

    /**
     * @type User
     */
    private $user;

    /**
     * @type Group
     */
    private $group;

    /**
     * @type Resource
     */
    private $resource;

    function __construct(User $user, Group $group, Resource $resource)
    {
        $this->user = $user;
        $this->group = $group;
        $this->resource = $resource;
    }

    public function users()
    {
        return $this->user->all();
    }

    public function usersByGroups($groups)
    {
        $groups = (array) $groups;

        return $this->user->whereHas('groups', function($q) use ($groups) {
            return $q->whereIn('name', $groups);
        });
    }

    public function findUserById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function addUser($input)
    {
        $input['password'] = Hash::make($input['password']);
        $user = $this->user->create($input);
        $user->groups()->sync(array_get($input, 'groups', []));

        return $user;
    }

    public function updateUser($id, $input)
    {
        $user = $this->user->findOrFail($id);
        $saved = $user->update($input);

        if($saved){
            $user->groups()->sync(array_get($input, 'groups', []));
        }

        return $user;
    }

    public function updatePassword($id, $plainPassword)
    {
        $user = $this->user->findOrFail($id);
        return $user->update(['password' => Hash::make($plainPassword)]);
    }

    public function deleteUser($id)
    {
        return $this->user->findOrFail($id)->delete();
    }

    public function groups()
    {
        return $this->group->all();
    }

    public function findGroupById($id)
    {
        return $this->group->findOrFail($id);
    }

    public function findGroupByName($name)
    {
        return $this->group->whereName($name)->first();
    }

    public function addGroup($input)
    {
        return $this->group->create($input);
    }

    public function updateGroup($id, $input)
    {
        return $this->group->findOrFail($id)->update($input);
    }

    public function deleteGroup($id)
    {
        return $this->group->findOrFail($id)->delete();
    }

    public function resources()
    {
        return $this->resource->all();
    }

    public function findResourceById($id)
    {
        return $this->resource->findOrFail($id);
    }

    public function addResource($input)
    {
        return $this->resource->create($input);
    }

    public function updateResource($id, $input)
    {
        return $this->resource->findOrFail($id)->update($input);
    }

    public function deleteResource($id)
    {
        return $this->resource->findOrFail($id)->delete();
    }

    public function assignGroups($userId, $groups)
    {
        $this->user->findOrFail($userId)->groups()->sync((array) $groups);
    }

    public function assignPermissions($groupId, $resources)
    {
        $this->group->findOrFail($groupId)->resources()->sync((array) $resources);
    }

    public function resetOfficerPassword($officer)
    {
        if($officer->user)
        {
            return $this->resetPassword($officer->user);
        }

        return false;
    }

    public function resetPassword($user)
    {
        $newPassword = $this->generateReadablePassword(8, false);
        $user->password = Hash::make($newPassword);
        $user->save();

        return $newPassword;
    }

    // Generates a strong password of N length containing at least one lower case letter,
    // one uppercase letter, one digit, and one special character. The remaining characters
    // in the password are chosen at random from those four sets.
    //
    // The available characters in each set are user friendly - there are no ambiguous
    // characters such as i, l, 1, o, 0, etc. This, coupled with the $add_dashes option,
    // makes it much easier for users to manually type or speak their passwords.
    //
    // Note: the $add_dashes option will increase the length of the password by
    // floor(sqrt(N)) characters.
    function generateReadablePassword($length = 9, $add_dashes = false, $available_sets = 'luds'){
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';

        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if(!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    function UploadImage($fupload,$vdir_upload ='',$name_upload ='',$image_thumbnail=false,$watermark_show=false){
      	//direktori gambar
        //$fupload = $request->file('images');
        $fuploadName = $name_upload;/*$fupload->getClientOriginalName();str_random(20).'.'.$fupload->getClientOriginalExtension();*/
        $fuploadExt = $fupload->getClientOriginalExtension();
        $fuploadSize = $fupload->getSize();

        $vdir_upload = public_path($vdir_upload);
        $vfile_upload = $vdir_upload .'/'. $fuploadName;
        
        $fupload->move($vdir_upload, $fuploadName);

        //identitas file asli
        switch($fuploadExt) {
            case "gif":
                $im_src=imagecreatefromgif($vfile_upload); 
                break;
            case "pjpeg":
            case "jpeg":
            case "jpg":
            case "JPG":
                $im_src=imagecreatefromjpeg($vfile_upload); 
                break;
            case "png":
            case "x-png":
                $im_src=imagecreatefrompng($vfile_upload); 
                break;
        }
      
        $src_width = imageSX($im_src);
        $src_height = imageSY($im_src);

      	//Simpan dalam versi besar 400 pixel
      	//Set ukuran gambar hasil perubahan
        if($src_width>=350){
            $dst_width = 350;
        } else {
            $dst_width = $src_width;
        }
        $dst_height = ($dst_width/$src_width)*$src_height;

        //proses perubahan ukuran
        $im = imagecreatetruecolor($dst_width,$dst_height);
        imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);
       
	   	if($image_thumbnail == true){
      	//Simpan gambar
			switch($fuploadExt) {
				case "gif":
					imagegif($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
				case "pjpeg":
				case "jpeg":
				case "jpg":
				case "JPG":
					imagejpeg($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
				case "png":
				case "x-png":
					imagepng($im,$vdir_upload.'/medium_'.$fuploadName);
					break;
			}
		}


        //Simpan dalam versi small 200 pixel
        //Set ukuran gambar hasil perubahan

        $dst_width2 = 200;
        $dst_height2 = ($dst_width2/$src_width)*$src_height;

        //proses perubahan ukuran
        $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
        imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);
	  
	    if($image_thumbnail == true){
		  //Simpan gambar
		    switch($fuploadExt) {
				case "gif":
					imagegif($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
				case "pjpeg":
				case "jpeg":
				case "jpg":
				case "JPG":
					imagejpeg($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
				case "png":
				case "x-png":
					imagepng($im2,$vdir_upload . "/small_" . $fuploadName);
					break;
		    }
	    }
	  
        //Hapus gambar di memori komputer
        imagedestroy($im_src);
        imagedestroy($im);
        imagedestroy($im2);
        if($watermark_show == true) $this->watermark_image($vdir_upload.'/'.$fuploadName);
    }

    function watermark_image($oldimage_name){
        $image_path_watermark = $this->image_path_watermark;
        $image_type = exif_imagetype($oldimage_name);

        list($owidth,$oheight) = getimagesize($oldimage_name);
        $width = $owidth;
        $height = $oheight;    
        $im = imagecreatetruecolor($width, $height);
        
        switch ($image_type) {
            case 1: 
                $img_src = imagecreatefromgif($oldimage_name);
                break;
            case 2:
                $img_src = imagecreatefromjpeg($oldimage_name);
                break;
            default:
                $img_src = imagecreatefrompng($oldimage_name);
                break;
        }

        imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
        $watermark = imagecreatefrompng($image_path_watermark);
        list($w_width, $w_height) = getimagesize($image_path_watermark);        
        $pos_x = $width - $w_width -5; 
        $pos_y = $height - $w_height - 5;
        imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
        imagejpeg($im, $oldimage_name, 100);
        imagedestroy($im);
        return true;
    }

    function countUser(){
        return $this->user->count();
    }
}
