<?php
use Core\Router;
use Core\H;
use App\Models\Users;

$menu = Router::getMenu('menu_acl');//H::dnd($menu);
$admin = Router::getMenu('admin_acl');
$currentPage = H::currentPage();
?>
<div class="sidebar" data-color="blue" data-image="<?=PROOT?>/img/sidebar-4.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <span class="simple-text"><?= Users::currentUser()->lname?></span>
        </div>

        <ul class="nav">
            <li>
                <a href="<?=PROOT?>dashboard/workspace">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="pe-7s-user"></i>
                    <span>User Profile</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?=PROOT?>dashboard/profile">Update Profile</a></li>
                    <li><a href="<?=PROOT?>dashboard/changekey">Change Password</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="pe-7s-note2"></i>
                    <span>Documents</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?=PROOT?>jobs">My Documents</a></li>
                    <li><a href="<?=PROOT?>jobs/upload">New Document</a></li>
                    <li class="divider"></li>
                    <li><a href="<?=PROOT?>jobs/shared">Shared Files</a></li>
                </ul>
            </li>
            <?php foreach($admin as $key => $val): 
                $active = ''; 
                ?>
                <?php if(is_array($val)): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="pe-7s-user"></i><?=$key?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach($val as $k => $v): 
                                $active = ($v == $currentPage)? 'active': '';
                                ?>
                                <?php if($k == 'separator'): ?>
                                <li role="separator" class="divider"></li>
                                <?php else: ?>
                                    <li><a class="<?=$active?>" href="<?=$v?>"><?=$k?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                
                <?php endif;?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>