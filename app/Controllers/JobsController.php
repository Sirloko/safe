<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use Core\FH;
use App\Models\Jobs;
use App\Models\Users;

class JobsController extends Controller{

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->setLayout('dashboard');
        $this->load_model('Jobs');
    }

    const UPLOAD_DIR = 'app' .'/'. 'upload/';
    const UPLOAD_DIR_ACCESS_MODE = 0777;
    const UPLOAD_MAX_FILE_SIZE = 1000000000;
    const UPLOAD_ALLOWED_MIME_TYPES = ['jpeg', 'jpg', 'pdf','png','gif','zip','rar','docx', 'doc','xls','xlsx','ods','odt','ppt','pptx','txt'];


    public function IndexAction(){
        $jobs = $this->JobsModel->findJobs(Users::currentUser()->id);
        
        $menu = Router::getMenu('job_actions');
        $this->view->menu = $menu;
        $this->view->jobs = $jobs;
        $this->view->render('jobs/index');
    }

    

    public function sharedAction(){
        $doc =   $this->JobsModel->getFiles(Users::currentUser()->id);
        $userd =  Users::currentUser()->id;
        $user = new Users();
        $getUser = $user->findAll($doc['0']->user_id);
        $menu = Router::getMenu('shared_actions');
        $this->view->menu = $menu;
        $this->view->id = $userd;
        $this->view->user = $getUser;
        $this->view->doc = $doc;
        $this->view->render('jobs/shared');
    }

    public function uploadAction(){
        $job = new Jobs();
        $user= new Users();
       
        if($this->request->isPost()){ 
            $this->request->csrfCheck();
            $cleanInfo = FH::sanitize($_POST['info']);
            if(!empty($cleanInfo || $_FILES['files']['tmp_name'][0] )){
                if(isset($_POST['sendto'])){
                    $job->sendto = serialize($_POST['sendto']);
                }else{
                    $job->sendto = null;
                }
               
                $job->info = $cleanInfo;
                $job->updated = Users::currentUser()->username;
                $job->user_id = Users::currentUser()->id;
                if($job->save()){
                    $upload = $this->upload($this->JobsModel->returnLastId(), $job->user_id, $_FILES['files'], Users::currentUser()->username);
                    if(!$upload){
                        Session::addMsg('danger','File upload was not succesful,Please update file');
                        Router::redirect('jobs');
                    }
                    Session::addMsg('success','File succesfully Uploaded');
                    Router::redirect('jobs');
                }
                
            }
                Session::addMsg('danger','empty fields');
                Router::redirect('jobs/upload');
        }
        
        $this->view->user = $user->find();
        $this->view->job = $job;
        $this->view->title = "Upload";
        $this->view->displayErrors = $job->getErrorMsg();
        $this->view->postAction = PROOT . 'jobs' . DS . 'upload';
        $this->view->render('jobs/upload');
    }
    public function updateAction($id){
        $job = $this->JobsModel->findJob($id);
        if(!$job || strlen($job->sendto) < 4 ){
           Router::redirect('jobs');
       }
       
        $search_array = unserialize($job->sendto);
        if(is_array($search_array)){
            $uid = Users::currentUser()->id;
            if(in_array("$uid", $search_array, true)){
                $user= new Users();

                if($this->request->isPost()){ 
                    $this->request->csrfCheck();
                    $job->assign($this->request->get());
                    $job->user_id = Users::currentUser()->id;
                   
                    //decides what happens if the checkbox is checked or !
                    if(isset($_POST['sendto'])){
                        $job->sendto = serialize($_POST['sendto']);
                    }
                   
                    $job->updated = Users::currentUser()->username;
                    //if(empty($job->info))Router::redirect('jobs');
                    if($job->save()){
                        $upload = $this->upload($id, Users::currentUser()->id, $_FILES['files'], Users::currentUser()->username);
                        Session::addMsg('success','File succesfully Uploaded');
                        Router::redirect('jobs');
                    
                    }
                        Session::addMsg('danger','Please provide a file');
                        Router::redirect('jobs');
                }
            }else{
                Session::addMsg('danger','Unauthorized access');
                Router::redirect('jobs');
            }
        }

        $this->view->user = $user->find();
        $this->view->title = "Update";
        $this->view->job = $job;
        $this->view->displayErrors = $job->getErrorMsg();
        $this->view->postAction = PROOT . 'jobs' . DS . 'update'. DS . $id;
        $this->view->render('jobs/upload');
    }

    public function upload($id, $executive_id, array $files = [], $username) {
        $normalizedFiles = $this->normalizeFiles($files);
        // Upload each file.
        foreach ($normalizedFiles as $normalizedFile) {
            $uploadResult = $this->uploadFile($id, $executive_id, $normalizedFile, $username);

            if ($uploadResult !== TRUE) {
                $errors[] = $uploadResult;
            }
        }
        return empty($errors) ? TRUE : $errors;
    }
    private function normalizeFiles(array $files = []) {
        $normalizedFiles = [];

        foreach ($files as $filesKey => $filesItem) {
            foreach ($filesItem as $itemKey => $itemValue) {
                $normalizedFiles[$itemKey][$filesKey] = $itemValue;
            }
        }
        return $normalizedFiles;
    }
    
    private function createDirectory(string $path) {
        try {
            if (file_exists($path) && !is_dir($path)) {
                throw new UnexpectedValueException(
                'The upload directory can not be created because '
                . 'a file having the same name already exists!'
                );
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            exit();
        }

        if (!is_dir($path)) {
            mkdir($path, self::UPLOAD_DIR_ACCESS_MODE, TRUE);
        }

        return $this;
    }

    private function uploadFile($id, $executive_id, array $file = [], $username) {
        $rawName = $file['name'];
        $type = $file['type'];
        $tmpName = $file['tmp_name'];
        $error = $file['error'];
        $size = $file['size'];
        
        $name = strtolower($rawName);
        $fileExt = explode('.', $name);
        $fileActualExt = strtolower(end($fileExt));

        switch ($error) {
            case UPLOAD_ERR_OK: /* There is no error, the file can be uploaded. */
                if ($size > self::UPLOAD_MAX_FILE_SIZE) {
                    Session::addMsg('danger','File(s) too big');
                    Router::redirect('jobs');
                }
                // Validate the file type.
                if (!in_array($fileActualExt, self::UPLOAD_ALLOWED_MIME_TYPES)) {
                    Session::addMsg('danger','Please provide a valid Filetype');
                    Router::redirect('jobs');
                }
                //assign a unique name to the file(s)
                $fileNamesource = uniqid('', true).".".$fileActualExt;
                $uploadDirPath = self::UPLOAD_DIR;
                $uploadPath = $uploadDirPath  . $fileNamesource;
                // Create the upload directory.
                $this->createDirectory($uploadDirPath);
                if (!move_uploaded_file($tmpName, $uploadPath)) {
                    Session::addMsg('danger','The file"%s" could not be moved to the specified location');
                    Router::redirect('jobs');
                }
                $this->JobsModel->upload($id, $executive_id, $uploadPath, $username);
                return true;
                
            break;
            case UPLOAD_ERR_PARTIAL:
                Session::addMsg('danger','The provided file "%s" was only partially uploaded');
                Router::redirect('jobs');
            break;
            default:
                Session::addMsg('danger','There was a problem with the upload. Please update file.');
                Router::redirect('jobs');
            break;
        }
        return TRUE;
    }

    public function viewAction($id){
        $doc =   $this->JobsModel->viewFiles((int)$id);
        if(!$doc)Router::redirect('jobs');
        $user = new Users();
        $getUser = $user->findAll($doc['0']->user_id);
        $encode = json_decode(json_encode($doc), True);
        $data['FILES'] = $encode;

        $this->view->user = $getUser;
        $this->view->data = $data;
        $this->view->doc = $doc;
        $this->view->render('jobs/view');
    }
    public function deleteAction($id){
        $jobs = $this->JobsModel->findIdAndUserId((int)$id,Users::currentUser()->id);
        if($jobs){
            $jobs->delete();
            Session::addMsg('success','Job has been deleted');
            Router::redirect('jobs');
            
        }
        Session::addMsg('danger','Unauthorized access');
        Router::redirect('jobs');
    }
}