<?php
namespace App\Controllers;
use Core\Controller;
use Core\Router;
use Core\Session;
use Core\H;
use App\Models\Users;
use App\Models\Login;


class AdminController extends Controller{

    public function __construct($controller, $action){
        parent:: __construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('dashboard');
    }

    public function IndexAction(){
        $this->view->render('manage');  
    }

    public function CreateAction(){
        $newUser = new Users();
        if($this->request->isPost()){
            $this->request->csrfCheck();
            $newUser->assign($this->request->get());
            $newUser->setConfirm($this->request->get('confirm'));
            if(preg_match("/[a-z]/i", $newUser->acl)){
                 $newUser->acl = '["'.$newUser->acl.'"]';
            }else{
                $newUser->acl = '["USER"]';
            }
           
           // H::dnd($newUser);
            if($newUser->save()){
                Session::addMsg('success', ' New User Succesfully Created' );
                Router::redirect('admin/create');
            }
            //$newUser->login();
        }

        $this->view->newUser = $newUser;
        $this->view->displayErrors = $newUser->getErrorMsg();
        $this->view->render('admin/create');
    }

    public function ManageAction(){
        $acl = '["Admin"]';
       $Users = $this->UsersModel->findUsers($acl) ;
        $array = json_decode(json_encode($Users), True);
         
        $this->view->users = $Users;//
        $this->view->render('admin');
    }

    public function controlAction(){
        if($_POST) {
            $id = $_POST['id'];
            $fetch = $this->UsersModel->findAll($id);

    }
        $this->view->acl = $fetch->acl;
        $this->view->fetch = $fetch;
        $this->view->id = $id;
        $this->view->setLayout('plain');
        $this->view->render('admin/control');
    }
    public function banUserAction($userId){
       $ban = $this->UsersModel->findAll($userId);
        $ban->acl = '["BANNED"]';
        if($ban->save()){
            Session::addMsg('success', ' '.$ban->lname.' has been banned Succesfully' );
            Router::redirect('admin');
        }
        Router::redirect('admin');
    }
    public function unbanUserAction($userId){
       $ban = $this->UsersModel->findAll($userId);
        $ban->acl = ' ';
        $ban->assign();
        if($ban->save()){
            Session::addMsg('success', ' '.$ban->lname.' has been unbanned Succesfully' );
            Router::redirect('admin/manage');
        }
        Router::redirect('admin');
    }
    public function resetPwdAction($userId){
       $ban = $this->UsersModel->findAll($userId);
        $ban->password = 'BciPwdReset##';
        $ban->assign();
        if($ban->save()){
            Session::addMsg('success', ' '.$ban->lname.' password has been succesfully Resetted' );
            Router::redirect('admin/manage');
        }
        Router::redirect('admin');
    }


    
}
