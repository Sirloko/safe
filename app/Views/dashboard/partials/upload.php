<?php
use Core\FH;
use Core\H;
use Core\View;
?>
<form method="post" action="<?= $this->postAction ;?>"  enctype="multipart/form-data">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <h2>Client : <?=$this->opr->client?></h2>
    <h2>Guarantor : <?=$this->opr->category?></h2>
    <?= FH::uploadBlock('file','Upload','files[]',['class'=>''],['class'=>'form-group ']);?>
    <?= FH::textareaBlock('Report','report',$this->opr->report,['class'=>'form-control'],['class'=>'form-group col-md-12']);?>
    <?= FH::inputHiddenBlock('hidden','status','103');?>
   
    <!--  -->
    
    <!-- FH::HODBlock('Assign Handler',$this->hod['HOD'],'user_id',['class'=>'form-control'],['class'=>'form-group col-md-6']); this block assign's an handler -->
    
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>oprs" class="btn btn-default">Cancel</a>
        <?= FH::submitTag('Upload', ['class'=>'btn btn-primary']);?>
    </div>
</form>