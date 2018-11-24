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

        <?php echo form_open_multipart('AdminController/add_book') ?>
        <?php
        if ($this->session->flashdata('error_message')) {
            echo $this->session->flashdata('error_message');
        } elseif ($this->session->flashdata('book_added')) {
            echo $this->session->flashdata('book_added');
        }
        ?>
        <table class='table-striped' align='center' height='500' width='800' border='0' bgcolor='#187eae'>
            <br>
            <tr >
                <td scope= "row" align='left'><b><font color='red'>*</font>Author:</b></td>
                <td><input type='text' placeholder='Enter Book Author' name='author' size='60' required/></td>
            </tr>
            <tr>
                <td align='left'><b>Book Keywords:</b></td>
                <td><input type='text' placeholder='Enter Book Keywords' name='keywords' size='50'/></td>
            </tr>

            <tr>
                <td align='left'><b><font color='red'>*</font>Product Title:</b></td>
                <td><input type='text' placeholder='Enter Book Title' name='title' size='60' required/></td>
            </tr>
            <tr>
                <td align='left'><b><font color='red'>*</font>Product Category:</b></td>
                <td>
                    <select   name="category" >
                        <option >Select a Category</option>
                        <?php if (count($allCategory)): ?>
                            <?php foreach ($allCategory as $categories): ?>
                                <option value=<?php echo $categories->category; ?>><?php echo $categories->category ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align='left'><b><font color='red'>*</font>Product Description:</b></td>
                <td><textarea name='desc' placeholder='Enter Book Description' cols='60' rows='5'></textarea></td>
            </tr>
            <tr>
                <td align='left'><b><font color='red'>*</font>Product Price:</b></td>
                <td><input type='number' step=".01" placeholder='Enter Book Price' name='price' required/></td>
            </tr>
            <tr>
                <td align='left'><b><font color='red'>*</font>Product Image:</b></td>
                <td><input type='file' name='image' multiple="true"/></td>
            </tr>




            <tr align='center'>
                <td colspan='7'><?php
                    $btn = array(
                        'type' => 'submit',
                        'value' => 'Insert Book',
                        'class' => 'btn btn-success'
                    );
                    echo form_submit($btn);
                    ?></td>
            </tr>
        </table>

        <?php echo form_close(); ?>
    </body>
</html>
