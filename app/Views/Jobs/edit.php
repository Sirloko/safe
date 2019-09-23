<?php $this->setSiteTitle('Edit job'); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2 well">
    <h2 class="text-center">Edit <?=$this->job->client; ?></h2>
    <?php $this->partial('jobs', 'form'); ?>
</div>

<?php $this->end('body'); ?>