<?php
use Core\Session;
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title><?=$this->siteTitle()?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="<?=PROOT?>css/custom.css" media="screen">
    <script src="<?=PROOT?>js/jquery.js"></script>
    <script src="<?=PROOT?>js/bootstrap.min.js"></script>
    
    <?= $this->content('head'); ?>

  </head>
  <body>
    <div class="container-fluid" style="min-height:cal(100% - 125px); ">
    <?= Session::displayMsg() ?>
      <?= $this->content('body');?>
    </div>
    
   
   
   
   
    <?= $this->content('footer');?>

  </body>
</html>