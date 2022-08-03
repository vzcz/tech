<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $fillable = ["id", "name", "age", "country"];
    public $timestamps = false;

    public function file(){
        return $this->hasMany('App\Models\File', 'employee_id');
    }

}
