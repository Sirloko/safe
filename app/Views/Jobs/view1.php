<?php $this->setSiteTitle($this->job[0]->invoice); ?>
<?php $this->start('body'); ?>

<div class="col-md-8 col-md-offset-2 well">
    <a href="<?=PROOT?>jobs" class="btn btn-xs btn-default">Back</a>
    <h2 class="text-center">hello</h2>
    <div class="col-md-6">
        <p><strong>Invoice: </strong><?=$this->job[0]->invoice; ?></p>
        <p><strong>Assigned On </strong><?=$this->job[0]->assign; ?></p>
        <p><strong>Client: </strong><?=$this->job[0]->client; ?></p>
        <p><strong>Creator: </strong><?=$this->job[0]->creator; ?></p>
        <p><strong>Start Date: </strong><?=$this->job[0]->start; ?></p>
        <p><strong>Completed On: </strong><?=$this->job[0]->end; ?></p>
        <p><strong>Job Status: </strong><?=$this->job[0]->status; ?></p>
    </div>
    <div class="col-md-6">
    <p><strong>Handled by: </strong><?=$this->job[0]->username; ?></p>
    </div>
</div>

<?php $this->end('body'); ?>