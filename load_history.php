<?php
use MyChatApp\Entities\Message;

require dirname(__FILE__) . '\vendor\autoload.php';

echo Message::all()->toJSON();
