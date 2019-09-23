<?php $this->setSiteTitle('New Document') ?>

<?php $this->start('body'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title"><?=$this->title?> New Document</h4>
                    <p class="category">.</p>
                </div>
                <div class="col-md-8 col-md-offset-2 ">
                    <hr>
                    <?php $this->partial('jobs', 'upload'); ?>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php $this->end('body'); ?>