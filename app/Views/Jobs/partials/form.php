<?php
use Core\FH;
use Core\H;
use Core\View;
?>
<form action="<?= $this->postAction ?>" method="POST" class="form">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <?= FH::inputBlock('text','Client','client',$this->job->client,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    <?= FH::selectBlock('Job type','category','category', $this->job->category,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>
    
    <?= FH::textareaBlock('Job Description','info',$this->job->info,['class'=>'form-control'],['class'=>'form-group col-md-12']);?>
   
    <!-- FH::HODBlock('Assign Handler',$this->hod['HOD'],'user_id',['class'=>'form-control'],['class'=>'form-group col-md-6']); this block assign's an handler -->
    
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>jobs" class="btn btn-default">Cancel</a>
        <?= FH::submitTag('Save', ['class'=>'btn btn-primary']);?>
    </div>
</form>