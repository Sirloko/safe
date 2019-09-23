<?php 
use Core\FH;
?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">Create New User</h4>
                    <p class="category">.</p>
                </div>
                <div class="content">
                    <form action="" class="form" method="POST">
                            <?= FH::csrfInput() ?>
                            <?= FH::displayErrors($this->displayErrors) ?>
                        <div class="row">
                            <?= FH::inputBlock('text','First Name','fname',$this->newUser->fname, ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                            <?= FH::inputBlock('text','Last Name','lname',$this->newUser->lname, ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                        </div>

                        <div class="row">
                            <?= FH::inputBlock('text','Email','email',$this->newUser->email, ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                            <?= FH::inputBlock('text','Username','username',$this->newUser->username, ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                        </div>

                        <div class="row">
                            <?= FH::inputBlock('password','Password','password',$this->newUser->password, ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                            <?= FH::inputBlock('password','Confirm Password','confirm',$this->newUser->getConfirm(), ['class' => 'form-control input-sm'],['class'=>'form-group col-md-6']);?>
                        </div>

                        <div class="row">
                            <?= FH::aclBlock('Access Level','users','acl', $this->newUser->acl,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                </div>
                            </div>
                        </div> -->
                        <?= FH::submitBlock('Create',['class'=>'btn btn-primary btn-large'],['class'=>'text-right']) ?>
                        <!-- <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button> -->
                        <div class="clearfix"></div>
                    </form>
                </div>
                
            </div>
        </div>

    </div>
</div> 
<?php $this->end(); ?>