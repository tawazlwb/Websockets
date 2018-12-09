<?php
namespace MyChatApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use MyChatApp\Entities\Message;

class Chat implements MessageComponentInterface {
    
    protected $clients;

    function __construct(){
        $this->clients = new \SplObjectStorage;
    }
    
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        /*$numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        */

        $msg = json_decode($msg);
        switch ($msg->type) {
            case 'message':
                foreach ($this->clients as $client) {
                    if ($from !== $client) {
                        $client->send($msg->text);
                    }
                }
        
                Message::create([
                    'text' => $msg->text,
                    'sender' => $msg->sender
                ]);
                break;
            
            default:
                # code...
                break;
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
