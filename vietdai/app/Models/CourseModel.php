<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","language","period","price","id"
    ];
    protected $primaryKey="stt";
    protected $table="course";
    const CREATED_AT = 'name_of_created_at_column';
    const UPDATED_AT = 'name_of_updated_at_column';
    public $timestamps = false;
}
