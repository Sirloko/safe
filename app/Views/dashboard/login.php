<?php
use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-6 col-md-offset-3 well">
    <h3 class="text-center">Login</h3>
    <form action="<?= PROOT?>dashboard/login" method="POST">
    <?= FH::csrfInput();?>
    <?= FH::displayErrors($this->displayErrors) ?>
    <?=FH::inputBlock('text', 'Username / Email', 'username',$this->login->username,['class'=>'form-control'],['class'=>'form-group']) ?>
    <?=FH::inputBlock('password', 'Password', 'password',$this->login->password,['class'=>'form-control'],['class'=>'form-group']) ?>
    <?=FH::checkboxBlock('Remember Me', 'remember_me',$this->login->getRememberMe(),[],['class'=>'form-group']) ?>
    <?=FH::submitBlock('Login', ['class'=>'btn btn-large btn-primary'],['class'=>'form-group']) ?>
      
    </form>
</div>
<?php $this->end(); ?>