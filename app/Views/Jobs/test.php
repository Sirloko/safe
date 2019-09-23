<?php $this->setSiteTitle('Edit job'); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2 well">
<?php foreach($this->handler['HND'] as $handle): ?>

                
<a href="<?=PROOT?>jobs/assignHandler/<?= $this->jobid?>/<?= $handle['id']?>" type="submit" class="btn btn-xs btn-primary" >
    <i class="glyphicon glyphicon-plus"></i> <?= $handle['fname']; ?>
              

    </a>
                  <?php endforeach; ?>
                  
   
</div>

<?php $this->end('body'); ?>

