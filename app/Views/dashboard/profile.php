<?php use Core\H; ?>
<?php $this->setSiteTitle($this->user->username); ?>
<?php $this->start('body'); ?>

<div class="col-md-8 col-md-offset-2 ">
    <h2 class="text-center">Update Profile</h2>
    
    <?php $this->partial('dashboard', 'form'); ?>
    
</div>

<?php $this->end('body'); ?>