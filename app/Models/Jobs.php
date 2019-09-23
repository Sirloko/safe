<?php
namespace App\Models;
use Core\Model;
use Core\H;


class Jobs extends Model{
    public $id,$user_id,$info,$status,$sendto,$updated,$deleted = 0;

    public function __construct(){
        $table = 'job';
        parent::__construct($table);
        $this->_softDelete = true;
    }

    public function findJobs($user_id, $params=[]){
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        $conditions = array_merge($conditions,$params);
        return $this->find($conditions);
    }

    public function findAllByUserId($user_id, $params=[]){
        $conditions = [
            'conditions' => 'user_id = ?',
            'bind' => [$user_id]
        ];
        $conditions = array_merge($conditions,$params);
        return $this->find($conditions);
    }

    public function FindCurrentJob($id,$params=[]){
        $sql = "SELECT * 
        FROM job 
        INNER JOIN users 
        ON users.id = job.user_id 
        WHERE job.id=$id 
        AND job.deleted !=1";

        return $this->query($sql)->results();
        // $conditions = [
        //     'conditions' => 'id = ? ',
        //     'bind' => [$id]
        // ];
        // $conditions = array_merge($conditions,$params);//H::dnd($conditions);
        // return $this->findFirst($conditions);
      }

      public function returnLastId(){
         return $this->lastId();
    }

    public function upload($jobid, $executive_id, $uploadpath, $username){
        $sql = "INSERT INTO upload (job_id, user_id, file, creator) VALUES ('$jobid', $executive_id, '$uploadpath', '$username') ";
        return $this->query($sql)->results();
    }

    public function getFiles($id){

        // $conditions = [
        //     'conditions' => 'job_id = ? ',
        //     'bind' => [$id]
        // ];
        // $conditions = array_merge($conditions);
        // $con = $this->findFirst($conditions);
        // if($con->status == 911)return false;
        $sql = "SELECT * FROM UPLOAD INNER JOIN job ON job.id=upload.job_id WHERE deleted =0 GROUP BY job.id ORDER BY time DESC ";
        return $this->query($sql)->results();
    }
    public function viewFiles($id){
        $sql = "SELECT * FROM job  INNER JOIN upload ON upload.job_id=job.id WHERE job.id = $id AND deleted = 0 ORDER BY time DESC";
        return $this->query($sql)->results();
    }
    public function fetchSharedFiles(){

        // $conditions = [
        //     'conditions' => 'job_id = ? ',
        //     'bind' => [$id]
        // ];
        // $conditions = array_merge($conditions);
        // $con = $this->findFirst($conditions);
        // if($con->status == 911)return false;
        $sql = "SELECT * FROM UPLOAD INNER JOIN job ON job.id=upload.job_id";
        return $this->query($sql)->results();
    }

    public function FindHandler($id,$params=[]){
        $sql = "SELECT * FROM users WHERE id = $id";
        return $this->query($sql)->results();
      }

    public function findIdAndCreatorId($job_id,$creator_id,$params=[]){
        $conditions = [
            'conditions' => 'id = ? AND creator = ?',
            'bind' => [$job_id, $creator_id]
        ];
        $conditions = array_merge($conditions,$params);
        return $this->findFirst($conditions);
    }
    public function findIdAndUserId($job_id,$user_id,$params=[]){
        $conditions = [
            'conditions' => 'id = ? AND user_id = ?',
            'bind' => [$job_id, $user_id]
        ];
        $conditions = array_merge($conditions,$params);
        return $this->findFirst($conditions);
    }
    public function findJob($id,$params=[]){
        $conditions = [
            'conditions' => 'id = ? ',
            'bind' => [$id]
        ];
        $conditions = array_merge($conditions,$params);//H::dnd($conditions);
        return $this->findFirst($conditions);
    }

   

  
    

    // public function initOps($params){
    //     $jo = new Operation();
       
    //     $jo->client = $params->client;
    //     $jo->job_id = $params->id;
    //     $jo->info = $params->info;
    //     $jo->handler_id = $params->user_id;
    //     $jo->category = $params->category;
    //     $jo->status = "100"; H::dnd($jo->save());
    //     //$jo->assign();
    // }

    

    public function displayName(){
        return $this->fname . ' ' . $this->lname;
    }
}