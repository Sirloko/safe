<?php
    namespace Core;
   use App\Models\Users; 


class Model {
    protected $_db, $_table, $_modelName, $_softDelete = false, $_validates = true,$_validationErrors=[];
    public $id;

    public function __construct($table){
        $this->_db = DB::getInstance();
        $this->_table = $table;
        $this->_modelName = str_replace( ' ','', ucwords(str_replace('_',' ', $this->_table)));
    }

    protected function get_columns(){
        return $this->_db->get_columns($this->_table);
    }

    protected function _softDeleteParams($params){
        if($this->_softDelete){
            if(array_key_exists('conditions',$params)){
                if(is_array($params['conditions'])){
                    $params['conditions'][] = "deleted != 1";
                }else{
                    $params['conditions'] .=" AND deleted != 1";
                }
            }else{
                $params['conditions'] = "deleted != 1";
            }
        }
        return $params;
    }

    public function find($params = []){
        $params = $this->_softDeleteParams($params);
        $resultsQuery = $this->_db->find($this->_table,$params,get_class($this));//H::dnd($resultsQuery);
        if(!$resultsQuery) return []; 
        return $resultsQuery;
    }

    public function findFirst($params = []){
        $params = $this->_softDeleteParams($params); 
        $resultsQuery = $this->_db->findFirst($this->_table,$params,get_class($this));//H::dnd($resultsQuery);
        return $resultsQuery;
    }

    public function findById($id){
        return $this->findFirst([
            'conditions' => ['id = ?'], 
            'bind' => [$id] 
            ]);
    }

    public function save(){
        $this->Validator();
        if($this->_validates){
            $this->beforeSave();
            $fields = H::getObjectProperties($this);// H::dnd($fields);
            //determine whether to update or insert
            if(property_exists($this, 'id') && $this->id != ''){
                $save = $this->update($this->id,$fields);
                $this->afterSave();
                return $save;
            }else{
                $save = $this->insert($fields);
                $this->afterSave();
                return $save;
            }
        }

        return false;
    }
    

    public function insert($fields){
        if(empty($fields)) return false;
        return $this->_db->insert($this->_table,$fields);
    }

    public function update($id, $fields){
        if(empty($fields) || $id == '') return false;
        return $this->_db->update($this->_table, $id, $fields);
    }
    public function delete($id = ''){
        if($id == '' && $this->id == '')return false;
        $id = ($id == '') ? $this->id : $id;
        if($this->_softDelete){
            return $this->update($id, ['deleted' => 1]);
        }
        return $this->_db->delete($this->_table, $id);
    }
    public function query($sql, $bind = []){
        return $this->_db->query($sql,$bind);
    }
    public function lastId(){
        return $this->_db->lastId();
    }
    public function data(){
        $data = new stdClass();
        foreach(getObjectProperties($this) as $column => $value){
            $data->column = $value;
        }
        return $data;
    }
    public function assign($params = []){
        if(!empty($params)){
            foreach($params as $key => $value){
                if(property_exists($this, $key)){
                    $this->$key = $value;
                }
            }
            return true;
        }
        return false;
    }
    protected function populateObjData($result){
        foreach($result as $key => $val){
            $this->$key = $val;
        }
    }

    public function Validator(){}

    public function runValidation($validator){//H::dnd($validator);
        $key = $validator->field;
        if(!$validator->success){
            $this->_validates = false;
            $this->_validationErrors[$key] = $validator->msg;
        }
    }

    public function getErrorMsg(){
        return $this->_validationErrors;
    }

    public function validationPasses(){
        return $this->_validates;
    }

    public function addErrorMsg($field,$msg){
        $this->_validates = false;
        $this->_validationErrors[$field] = $msg;
    }

    public function beforeSave(){}
    public function afterSave(){}

    public function isNew(){
        return (property_exists($this,'id') && !empty($this->id)? false : true);
    }
    public function notNew(){
        return (property_exists($this,'password') && !empty($this->password)? true : false);
    }
    public function findJobAndId($job_id,$user_id,$params=[]){
        $conditions = [
            'conditions' => 'id = ? INNER JOIN user ON user_id = ?',
            'bind' => [$job_id, $user_id]
        ];
        $conditions = array_merge($conditions,$params);
        return $this->findFirst($conditions);
    }

}
