<?php use Core\H; ?>
<?php $this->setSiteTitle($this->doc['0']->id); ?>
<?php $this->start('body'); ?>

<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="header">
                        <h4 class="title">Viewer</h4>
                        <p class="category">.</p>
                    </div> -->
                   
               <hr>
               <?php foreach ($this->data['FILES'] as $file): ?>
    
    <div class="ht col-md-3" style="text-align: center;">
    <img src="<?= PROOT?>img/document-management-big.png" style="height: 2em;" alt=""><br>
    <div class="cap">
        <span><?= $file['info'];?></span><br>
        <span><?= $file['time'];?></span><br>
        <span>Updated by <?= $file['creator'];?></span><br>

        <a href="<?= PROOT;?><?= $file['file'];?>">download</a>
    </div>
        
    </div>

    
       
    <?php endforeach;?>
    </div> 
                </div>
            </div>

        
    </div>
<?php $this->end('body'); ?>