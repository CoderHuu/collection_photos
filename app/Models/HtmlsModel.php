<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HtmlsModel extends Model
{
    protected $table="htmls_url";
    protected $fillable=['id','url','title','created_at','updated_at'];
}
