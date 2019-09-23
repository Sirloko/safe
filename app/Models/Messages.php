<?php
namespace App\Models;
use Core\Model;
use Core\H;
use Core\FH;
use Core\Router;
use Core\Validators\RequiredValidator;
use Core\Validators\MaxValidator;


class Messages extends Model{
    public $id,$sender,$receiver,$inbox,$status=0,$time,$deleted = 0;

    

    public function __construct(){
        $table = 'message';
        parent::__construct($table);
        $this->_softDelete = true;
    }

    public function fetchUserMessages($curr, $id, $params=[]){//H::dnd($id);
        $sql = "SELECT * FROM message  WHERE (sender = '$curr' AND receiver = '$id') OR (sender = '$id' AND receiver = '$curr') ORDER BY time ASC";
        $get =  $this->query($sql)->results();
        // $conditions = [
        //     'conditions' => 'sender = '.$curr.' AND receiver = '.$id.''  OR 'sender = '.$curr.' OR receiver = '.$id.' ',
        //     'bind' => [$id]
        // ];
        
        // $conditions = array_merge($conditions, $params);
        
        // $con = $this->find($conditions);
        return $get;

        //H::dnd($con);
//         SELECT * FROM chat_message 
//  WHERE (from_user_id = '".$from_user_id."' 
//  AND to_user_id = '".$to_user_id."') 
//  OR (from_user_id = '".$to_user_id."' 
//  AND to_user_id = '".$from_user_id."') 
    }

    //'conditions' => 'sender = '.$curr.' OR receiver = '.$id.' ',
}