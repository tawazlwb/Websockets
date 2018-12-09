<?php
namespace MyChatApp\Entities;

class Message extends \Illuminate\Database\Eloquent\Model{
    protected $fillable = ['text', 'sender'];
}
