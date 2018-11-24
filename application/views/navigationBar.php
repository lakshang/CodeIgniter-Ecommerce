<html>
    <body data-spy="scroll" data-target="#myScrollspy" data-offset="15">
        <nav class="navbar navbar-fixed-top" role="navigation" id="topnav">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img alt="Brand" src="<?php echo base_url('assets/images/National_Book_Store_2016_logo.svg'); ?>" width="100" height="100" class="img-responsive">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li ><a href="<?php echo base_url('IndexController'); ?>">Home</font></a></li>
                        <li ><a href="<?php echo base_url('CartController'); ?>">Go to Cart</font><span class="badge"><?php echo count($this->cart->contents()); ?></span></a></li>

                    </ul>
                    <?php $elements = array('class' => 'navbar-form navbar-right'); ?>
                    <?php echo form_open('IndexController/search', $elements) ?>

                    <div class="form-group label-floating">
                        <label class="control-label">Search Books</label>
                        <input type="text" name="book_search" class="form-control">
                    </div>
                    <button type="submit" name="search" class="btn btn-round btn-just-icon btn-primary"><i class="material-icons">search</i><div class="ripple-container"></div></button>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </nav>
    </body>
</html>
