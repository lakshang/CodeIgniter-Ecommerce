
<html>
    <head><title>National Store Admin Panel</title>

        <?php include 'assets/css/css.php'; ?>
        <?php $this->load->view('navigationBarAdmin'); ?>
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
    <body>
        <?php
        if ($this->session->flashdata('category_added')) {
            echo $this->session->flashdata('category_added');
        } elseif ($this->session->flashdata('error_message')) {
            echo $this->session->flashdata('error_message');
        }
        ?>
        <div class="container">
            <?php echo form_open('AdminController/add_category') ?>
            <br>
            <table class='table-striped' align='center' height='200' width='800' border='0' bgcolor='#187eae'>
                <tr>
                    <td><b>&nbsp;Book Category : </b></td>
                    <td><input type='text' name='book_category' placeholder='Enter Category' size='60' required=""/></td>
                    <td>&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr align='center'>
                    <td colspan='7'><?php
                        $btn = array(
                            'type' => 'submit',
                            'value' => 'Insert Category',
                            'class' => 'btn btn-success'
                        );
                        echo form_submit($btn);
                        ?></td>
                </tr>

            </table>

            <?php echo form_close() ?>
        </div>
    </body>
</html>
