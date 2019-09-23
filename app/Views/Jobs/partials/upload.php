<?php
use Core\FH;
use Core\H;
use Core\View;
?>
<form method="post" action="<?= $this->postAction ;?>"  enctype="multipart/form-data">
    <?=FH::displayErrors($this->displayErrors)?>
    <?=FH::csrfInput(); ?>
    <?= FH::uploadBlock('file','Upload','files[]', 'multiple',['class'=>''],['class'=>'form-group col-md-6 ']);?>
    <?= FH::inputBlock('text','Details','info',$this->job->info,['class'=>'form-control'],['class'=>'form-group col-md-6']);?>

        <?php foreach($this->user as $user => $val): ?>

        <label for="sendto"><?=$val->username?>
        <input type="checkbox"  name="sendto[]" value ="<?=$val->id?>">
        </label>


            <?php endforeach; ?>
    <div class="col-md-12 text-right">
        <a href="<?=PROOT?>jobs" class="btn btn-default">Return</a>
        <?= FH::submitTag($this->title, ['class'=>'btn btn-primary']);?>
    </div>
</form>