
<?php $this->setSiteTitle('Workspace'); ?>
<?php $this->start('body'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="image">
                        <img src="<?=PROOT?>img/full-screen-image-3.jpg" alt="..."/>
                    </div>
                    <div class="contenta">
                        <div class="author">
                                <a href="#">
                            <img class="avatar border-gray" src="<?=PROOT.$this->user->avatar?>" alt="..." 
                            onerror="this.onerror=null;this.src='<?=PROOT?>img/fallback.png'"/>

                                <h4 class="title"><?=$this->user->fname?> <?=$this->user->fname?><br />
                                    <small><?=$this->user->username?></small>
                                </h4>
                            </a>
                        </div>
                    </div>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $this->end('body'); ?>