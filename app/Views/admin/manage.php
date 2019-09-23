<?php use Core\H;?>
<?php $this->setSiteTitle('Manage Users'); ?>
<?php $this->start('body'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <div class="card">
              <div class="header">
                  <h4 class="title">Manage Users</h4>
              </div>
                <hr>
              <div class="col-md-6">
                <?php foreach($this->users as $user => $val): ?>
                  <div class="col-md-3">
                    <a href="#" type="submit" class="caption" onclick="getMsg(<?=$val->id?>)" >
                      <img class="avatar border-gray" src="<?=PROOT.$val->avatar?>" alt="..."/>
                      <br>
                      <small><?=$val->lname?></small>     
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
              <div id="control" class="col-md-6 well">
                <h2>Select a user to continue</h2>
              </div>
          </div>
        </div>
    </div>
</div>

<script type="text/javascript"> //view ajax controller
      function getMsg(id)
   {    
     $.ajax({
     type: "POST",             
     url: '<?=PROOT?>admin/control',
     data: "id=" + id,
      success: function(data) {
       $('#control').html(data);
    }
    });     
 }
</script>
<?php $this->end('body'); ?>

