<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotosModel extends Model
{
    protected $table="photos_url";
    protected $fillable=['id','title','html_id','url','created_at','updated_ats'];
}
