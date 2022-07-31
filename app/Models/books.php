<?php

 namespace App\Models;
 use Illuminate\Database\Eloquent\Model;

 class Books extends Model{
 protected $table = 'tblbooks';

 // column sa table
 protected $fillable = [
 'bookname', 'yearpublish', 'authorid'
 ];

 public $timestamps = false;
 protected $primarykey = 'id';
 }