<?php
use Core\FH;
use Core\H;
use Core\View;
?>
<form action="<?= $this->postAction ?>" method="POST" class="form">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <?= FH::selectBlock('Job type','users','category', $this->newUser->acl,['class'=>'form-control'],['class'=>'form-group ']);?>
    
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>jobs" class="btn btn-default">Cancel</a>
        <?= FH::submitTag('Save', ['class'=>'btn btn-primary']);?>
    </div>
</form>