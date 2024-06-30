<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "nationality","phone","date_of_birth","sex","branch"
        
    ];
    protected $primaryKey="id";
    protected $table="student";
    const CREATED_AT = 'name_of_created_at_column';
    const UPDATED_AT = 'name_of_updated_at_column';
    public $timestamps = false;
}
