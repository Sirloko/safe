<?php
use Core\Session;
use App\Models\Users;
use Core\Router;
use Core\H;

$menu = Router::getMenu('menu_acl');//H::dnd($menu);
$currentPage = H::currentPage();//dnd($currentPage);
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
    <link href="<?=PROOT?>css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=PROOT?>css/animate.min.css" rel="stylesheet" />
    <link href="<?=PROOT?>css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />
    <link href="<?=PROOT?>css/pe-icon-7-stroke.css" rel="stylesheet" />
    
    <script src="<?=PROOT?>js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <script src="<?=PROOT?>js/bootstrap-notify.js"></script>


    
    <?= $this->content('head'); ?>

  </head>
  <body>

 <div class="wrapper">
        <?php include 'sidebar.php'?>

        <div class="main-panel">
            <?php include 'panel.php'?> 
            <div class="content">  
             <?= Session::displayMsg() ?>
            <?= $this->content('body');?>
</div>
        
            <?php include 'footer.php'?>
        </div>
    </div>


    
   
     
    
    
   
   
   
   
    
</div>
  </body>
</html>