<html>
    <head>
        <title>Product Page</title>
        <?php include 'assets/css/css.php'; ?>
        <?php include 'navigationBar.php'; ?>
        <?php // include 'carousel.php'; ?>
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
    <body>
        <div class="container">
            <?php if (is_array($book)) : ?>
                <?php
                foreach ($book as $product) {
                    $id = $product->bookId;
                    $title = $product->bookTitle;
                    $image = $product->bookImage;
                    $description = $product->bookDescription;
                    $price = $product->bookPrice
                    ?>
                    <?php
                    echo form_open('CartController/add');
                    echo form_hidden('id', $id);
                    echo form_hidden('name', $title);
                    echo form_hidden('price', $price);
                    ?>
                    <table class="table-striped table">


                        <tr>
                            <td scope= "row" align = 'left' colspan = '2'><b>&nbsp; <?php echo $title ?></b></td>

                        </tr>
                        <tr>
                            <td align = 'left' rowspan = '3'><img  class='card-image' height='350px' width='200px' src='<?php echo base_url('assets/images/'), $image ?>'> </td>
                            <td align = 'left'><b>Description: </b></td>
                        </tr>
                        <tr>

                            <td align = 'justify'><?php echo $description ?></td>
                        </tr>
                        <tr>

                            <td align = 'right'><b>$ <?php echo number_format($price, 2) ?></b></td>

                        </tr>
                        <tr>


                            <td align = 'center' colspan='2'><input type="submit" class="btn btn-success"  value="Add to Cart"></td>
                            <?php echo form_close(); ?>
                        </tr>
                    </table>
                <?php } ?>
            <?php else: echo $book; ?>
            <?php endif; ?>

        </div>
        <div class="container-fluid">
            <?php if (!empty($topBooksDetails)): ?>
                <b>Related to items you've viewed :</b>
                <div class="row">
                    <div class="col-md-15">
                        <div class="carousel slide multi-item-carousel" id="theCarousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="col-xs-4" id="bk1">
                                        <img height='200px' width='100px' src='<?php echo base_url('assets/images/'), $topBooksDetails[0]->bookImage ?>'>
                                        <div class="c-content "><b><br><br><br><?php echo $topBooksDetails[0]->bookTitle ?></b><br> by <?php echo $topBooksDetails[0]->bookAuthor ?><br><br>
                                            <b>TOP VIEWED</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-xs-4" id="bk2">
                                        <img height='200px' width='100px' src='<?php echo base_url('assets/images/'), $topBooksDetails[1]->bookImage ?>'>
                                        <div class="c-content "><b><br><br><br><?php echo $topBooksDetails[1]->bookTitle ?></b><br> by <?php echo $topBooksDetails[1]->bookAuthor ?><br></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-xs-4" id="bk3">
                                        <img height='200px' width='100px' src='<?php echo base_url('assets/images/'), $topBooksDetails[2]->bookImage ?>'>
                                        <div class="c-content "><b><br><br><br><?php echo $topBooksDetails[2]->bookTitle ?></b><br> by <?php echo $topBooksDetails[2]->bookAuthor ?><br></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-xs-4" id="bk4">
                                        <img height='200px' width='100px' src='<?php echo base_url('assets/images/'), $topBooksDetails[3]->bookImage ?>'>
                                        <div class="c-content "><b><br><br><br><?php echo $topBooksDetails[3]->bookTitle ?></b><br> by <?php echo $topBooksDetails[3]->bookAuthor ?><br></div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-xs-4" id="bk5">
                                        <img height='200px' width='100px' src='<?php echo base_url('assets/images/'), $topBooksDetails[4]->bookImage ?>'>
                                        <div class="c-content "><b><br><br><br><?php echo $topBooksDetails[4]->bookTitle ?></b><br> by <?php echo $topBooksDetails[4]->bookAuthor ?><br></div>
                                    </div>
                                </div>

                            </div>
                            <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                            <a class="right carousel-control" href="#theCarousel" data-slide="next"></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </body>
    <?php include 'assets/js/js.php'; ?>
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

