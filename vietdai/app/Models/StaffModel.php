<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffModel extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", "sex","date_birthday","address","address1","phone","email","cccd","form_work","id_branch","languages","calendar","status"
    ];
    protected $primaryKey="id";
    protected $table="staff";
    const CREATED_AT = 'name_of_created_at_column';
    const UPDATED_AT = 'name_of_updated_at_column';
    public $timestamps = false;
}
    
