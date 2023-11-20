<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Task extends Model
{
    public $table = 'user_task';
    protected $fillable= [
        'user_id','task_id'
     ];
     public function task(){
        return $this->belongsTo(Task::class,'task_id');
    }
    public function user(){
       return $this->belongsTo(User::class,'user_id');
   }
     public $timestamps = false;
}
