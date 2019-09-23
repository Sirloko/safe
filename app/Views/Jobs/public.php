<?php use Core\H; ?>
<?php $this->setSiteTitle($this->doc['0']->id); ?>
<?php $this->start('body'); ?>

<div class="col-md-8 col-md-offset-2 well">
    <a href="<?=PROOT?>jobs" class="btn btn-xs btn-default">Back</a>
    <h2 class="text-center">hello</h2>
    <div class="col-md-6">
        <p><strong>Invoice: </strong><?=$this->doc[0]->user_id; ?></p>
        <?php //H::dnd($this->doc[0]->file); ?>
        <?php foreach ($this->data['FILES'] as $file): ?>
        
            <embed src="/vault/<?= $file['file'];?>" width="100px" height="100px" type="">
            <span><?= $file['info'];?></span>
            <span><?= $file['time'];?></span>
            <a href="<?= $file['file'];?>">download</a>
            
           
        <?php endforeach;?>
        
        
        
    </div>
    <div class="col-md-6">
    <p><strong>Handled by: <?= $this->user->lname?></p>
    </div>
</div>
<?php $this->end('body'); ?>