<?php
use Core\H;
 $this->start('body'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">All Jobs</h4>
                        <p class="category">Have a blessed week</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <input type="text" class="form-control form-group pull-right" style="width:40%;"  id="myInput" onkeyup="myFunction()" placeholder="Search Filter...">
                        <table class="table table-hover table-striped" id="myTable">
                            <thead>
                                <th>Name</th>
                                <th>Last Updated By</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <?php foreach($this->jobs as $job): ?>
                                    <tr>
                                        <td class="bw">
                                            <a href="<?= PROOT ?>jobs/view/<?=$job->id?>" >
                                                <?= $job->info; ?>
                                            </a>
                                        </td>
                                        <td>
                                            <span> <?= $job->updated; ?></span>
                                        </td>
                                        <td>
                                            <span> <?= $job->instance; ?></span>
                                        </td>
                                        <td>
                                            <?php foreach($this->menu as $key => $val):?>
                                                <?php
                                                    $destination = "$val/$job->id";
                                                    $C = explode('/', $val); //Explodes '/' from the url to access the controller
                                                    switch ($C[3]){
                                                        
                                                        
                                                        case 'view':
                                                        $cat = 'btn btn-xs btn-default';
                                                        $toggle = '';
                                                        $icon = 'glyphicon glyphicon-view';
                                                        $confirm = " ";

                                                        break;
                                                        case 'update':
                                                        $cat = 'btn btn-xs btn-primary';
                                                        $toggle = '';
                                                        $icon = 'glyphicon glyphicon-remove';
                                                        $confirm = "";
                                                        
                                                        break;

                                                        case 'delete':
                                                        $cat = 'btn btn-xs btn-danger';
                                                        $toggle = '';
                                                        $icon = 'glyphicon glyphicon-remove';
                                                        $confirm = "if(!confirm('Are you sure ?')){return false;}";

                                                    
                                                        break;
                                                        default:
                                                        $cat = 'btn btn-xs btn-primary';
                                                    }
                                                ?>
                                                <a href="<?=$destination?>"class="<?= $cat?> " data-id="<?=$job->id?>" onclick="<?= $confirm?>"  >
                                                    <i class="<?=$icon?>"></i> <?=$key?>
                                                </a>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
</script>

<?php $this->end('body'); ?>
