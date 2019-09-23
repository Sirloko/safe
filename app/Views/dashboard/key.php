<?php use Core\FH; ?>
<?php $this->setSiteTitle($this->user->username); ?>
<?php $this->start('body'); ?>

<div class="col-md-8 col-md-offset-2 well">
    <a href="<?=PROOT?>dashboard/workspace" class="btn btn-xs btn-default">Back</a>
    <h2 class="text-center">Update Password</h2>
    <form action="<?= $this->postAction ?>" method="POST" class="form" enctype="multipart/form-data">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <?= FH::inputBlock('password','New Password','password','', ['class' => 'form-control input-sm'],['class'=>'form-group']);?>
    <?= FH::inputBlock('password','Confirm New Password','confirm',$this->user->getConfirm(), ['class' => 'form-control input-sm'],['class'=>'form-group']);?>
    
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>dashboard/workspace" class="btn btn-default">Cancel</a>
        <?= FH::submitTag('Save', ['class'=>'btn btn-primary']);?>
    </div>
    
</div>
</form>
<?php $this->end('body'); ?>