<html>
    <head>
        <title>National Book Store</title>
        <?php include 'assets/css/css.php'; ?>
        <?php $this->load->view('navigationBar'); ?>
        <?php //  include 'carousel.php'; ?>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,800" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/material-kit.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
    </head>
    <body data-spy="scroll" data-target="#myScrollspy" data-offset="15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-2" id="myScrollspy">
                    <ul data-offset-top="225" data-spy="affix" class="nav nav-pills  nav-stacked">
                        <?php foreach ($category as $item): ?>

                            <?php echo "<li role=\"presentation\"><a href=\"" . base_url('IndexController/category/') . $item->category . "\">" . $item->category . "</a></li>"; ?>

                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-lg-10 col-md-10" id="mainarea">
                    <div class="container-fluid">
                        <div class="row">
                            <?php if (is_array($results)) { ?>
                                <?php
                                foreach ($results as $item) {

                                    $id = $item->bookId;
                                    $title = $item->bookTitle;
                                    $author = $item->bookAuthor;
                                    $price = $item->bookPrice;
                                    $image = $item->bookImage;
                                    ?>

                                    <div class = 'col-lg-5 col-md-8'>
                                        <div class = 'card'>
                                            <img class='card-img' height='200px' width='100px' src='<?php echo base_url('assets/images/'), $image ?>'>
                                            <span class = 'content-card'>
                                                <h6><?php echo $title ?><br></h6>
                                                <h7><?php echo $author ?><br></h7>
                                                <b><h7><?php echo "$" . number_format($price, 2) ?></h7></b>
                                            </span>
                                            <?php
                                            echo form_open('CartController/add');
                                            echo form_hidden('id', $id);
                                            echo form_hidden('name', $title);
                                            echo form_hidden('price', $price);
                                            ?>

                                            <?php
                                            $btn = array(
                                                'button class' => 'buybtn btn btn-warning btn-round btn-sm',
                                                'value' => 'Add',
                                                'name' => 'action'
                                            );
                                            echo form_submit($btn);
                                            echo form_close();
                                            ?>

                                            <a href='<?php echo base_url('ProductController/index/') . $id ?>'><button class='knowbtn btn btn-warning btn-round btn-sm' data-toggle='modal' data-target='#'>
                                                    Know More
                                                </button></a>

                                        </div>
                                    </div>


                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="footer" >
            <div class="pagination-sm" align="center">
                <?php echo $links; ?>
            </div>
        </div>
    </body>
    <!--   Core JS Files   -->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/material.min.js"></script>

    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/nouislider.min.js" type="text/javascript"></script>

    <!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
    <script src="assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
    <script src="assets/js/material-kit.js" type="text/javascript"></script>
    <script src="assets/js/carousel.js" type="text/javascript"></script>
    <script src="assets/js/myscripts.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</html>
