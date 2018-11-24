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
                        <?php
                        if ($this->session->username) {
                            $sess = $this->session->username;
                            echo "<li><a href='". base_url('AdminController/index')."'>Hi " . $this->session->username . " !</a></li>";
                        }
                        ?>
                        <li class=""><a href="<?php echo base_url('AdminController/category'); ?>">Insert Category</a></li>
                        <li class=""><a href="<?php echo base_url('AdminController/book'); ?>">Insert Book</a></li>
                        <li class=""><a href="<?php echo base_url('AdminController/view_book'); ?>">View Book</a></li>
                        <li class=""><a href="<?php echo base_url('AdminController/logout'); ?>">Logout</a></li>

                    </ul>

                </div>
            </div>
        </nav>
    </body>
</html>
