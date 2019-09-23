<?php $this->start('body'); ?>

    <?php switch($this->acl){
      case '["BANNED"]':
    ?>
      <a href="<?=PROOT?>admin/unbanUser/<?= $this->id?>" type="submit" class="btn btn-xs btn-primary">Lift Restriction</a>
    <?php
    break;

    default:
    ?>
      <a href="<?=PROOT?>admin/banUser/<?= $this->fetch->id?>" type="submit" class="btn btn-xs btn-primary">Restrict <?= $this->fetch->lname?></a>
    <?php
      }
    ?>
      <a href="<?=PROOT?>admin/resetPwd/<?= $this->id?>" type="submit" class="btn btn-xs btn-primary">Reset Password</a>
        
<?php $this->end('body'); ?>


