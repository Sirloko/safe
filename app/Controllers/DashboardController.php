<?php
namespace App\Controllers;
use Core\Controller;
use Core\Session;
use Core\Router;
use Core\H;
use Core\FH;
use App\Models\Users;
use App\Models\Login;

class DashboardController extends Controller{

    public function __construct($controller, $action){
        parent::__construct($controller, $action);
        $this->view->setLayout('dashboard');
        $this->load_model('Users');
    }

    const UPLOAD_DIR = 'app' .'/'. 'upload/' . 'profile/';
    const UPLOAD_DIR_ACCESS_MODE = 0777;
    const UPLOAD_MAX_FILE_SIZE = 100000;
    const UPLOAD_ALLOWED_MIME_TYPES = ['jpeg', 'JPG', 'jpg','png'];


    public function indexAction(){
       $loginModel = new Login();
        if($this->request->isPost()){
            //Form validation
            $this->request->csrfCheck();
            $loginModel->assign($this->request->get());
            $loginModel->validator();
            if($loginModel->validationPasses()){
                $user = $this->UsersModel->findUserByUsernameOrEmail($_POST['username']);
            if($user && password_verify($this->request->get('password'), $user->password)){
                echo "hello";
                $rememberMe = $loginModel->getRememberMe();
                $user->login($rememberMe);
                Session::addMsg('success','Welcome back! '.$user->lname.'');
                Router::redirect('dashboard/workspace');
            } else {
                $loginModel->addErrorMsg('username', 'There is an error with your username or password');
                }
            }
        }
        $this->view->login = $loginModel;
        $this->view->displayErrors = $loginModel->getErrorMsg();
        $this->view->setLayout('default');
        $this->view->render('dashboard/index');
    }
    public function workspaceAction(){
        $user = Users::currentUser();
        $this->view->user = $user;
        $this->view->render('dashboard/workspace');
    }
    
    public function logoutAction(){
        if(Users::currentUser()){
            Users::currentUser()->logout();
            Session::addMsg('info','Logged Out Successfully');
        }
        Router::redirect('dashboard/index');
    }

    public function profileAction(){
        $getUser = $this->UsersModel->findAll(Users::currentUser()->id);
        if($this->request->isPost()){
            $this->request->csrfCheck();
            $getUser->assign($this->request->get());
            $upload = $this->upload(Users::currentUser()->id, $_FILES['files']);
            $getUser->avatar = $upload['0'];
            if($getUser->save()){
                Session::addMsg('success','Profile Updated Successfully');
                Router::redirect('dashboard/workspace');
            }
        }
        $this->view->user = $getUser;
        $this->view->postAction = PROOT . 'dashboard' . DS . 'profile';
        $this->view->displayErrors = $getUser->getErrorMsg();
        $this->view->render('dashboard/profile');
    }
    public function changeKeyAction(){
        $User = $this->UsersModel->findAll(Users::currentUser()->id);
        $curr = $User->password;

        if($this->request->isPost()){
            $this->request->csrfCheck();
            $User->assign($this->request->get());
           
            //H::dnd($_POST['currpassword']);
           
            $User->setConfirm($this->request->get('confirm'));
            //$User->password = $this->password;
            //H::dnd($User);
            if($User->save()){
                Session::addMsg('success','Password Updated Successfully');
                Router::redirect('dashboard/workspace');
            }
        }
        $this->view->user = $User;
        $this->view->postAction = PROOT . 'dashboard' . DS . 'changeKey';
        $this->view->displayErrors = $User->getErrorMsg();
        $this->view->render('dashboard/key');
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
    public function upload($user_id, array $files = []) {
        $normalizedFiles = $this->normalizeFiles($files);
        // Upload each file.
        foreach ($normalizedFiles as $normalizedFile) {
            $uploadResult = $this->uploadFile($user_id, $normalizedFile);

            if ($uploadResult !== TRUE) {
                $errors[] = $uploadResult;
            }
        }
        return empty($errors) ? TRUE : $errors;
    }
    private function uploadFile($id, array $file = []) {
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
                    Router::redirect('dashboard');
                }
                // Validate the file type.
                if (!in_array($fileActualExt, self::UPLOAD_ALLOWED_MIME_TYPES)) {
                    Session::addMsg('danger','Please provide a valid input');
                    Router::redirect('dashboard');
                }
                //assign a unique name to the file(s)
                $fileNamesource = uniqid('', true).".".$fileActualExt;
                $uploadDirPath = self::UPLOAD_DIR;
                $uploadPath = $uploadDirPath  . $fileNamesource;
                // Create the upload directory.
                $this->createDirectory($uploadDirPath);
                if (!move_uploaded_file($tmpName, $uploadPath)) {
                    Session::addMsg('danger','The file"%s" could not be moved to the specified location');
                    Router::redirect('dashboard');
                }
                //$this->UsersModel->upload($user_id, $uploadPath);
                return $uploadPath;
                
            break;
            case UPLOAD_ERR_PARTIAL:
                Session::addMsg('danger','The provided file "%s" was only partially uploaded');
                Router::redirect('dashboard');
            break;
            case UPLOAD_ERR_NO_FILE:
                Session::addMsg('danger','No file provided. Please select at least one file.');
                Router::redirect('dashboard');
            break;
            default:
                Session::addMsg('danger','There was a problem with the upload. Please try again.');
                Router::redirect('dashboard');
            break;
        }
        return TRUE;
    }
}