<?php
use Core\FH;
use Core\H;
use Core\View;
?>
<form action="<?= $this->postAction ?>" method="POST" class="form" enctype="multipart/form-data">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <?= FH::uploadBlock('file','Upload Profile Picture','files[]', '',['class'=>''],['class'=>'form-group col-md-offset-7']);?>
    <?= FH::inputBlock('text','First Name','fname',$this->user->fname,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <?= FH::inputBlock('text','Last Name','lname',$this->user->lname,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <?= FH::inputBlock('text','Username','username',$this->user->username,['class'=>'form-control'],['class'=>'form-group col-md-12']);?>
   
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>dashboard/profile" class="btn btn-default">Cancel</a>
        <?= FH::submitTag('Save', ['class'=>'btn btn-primary']);?>
    </div>
</form>
