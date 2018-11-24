<html>
    <head>
        <title>National Store Admin Panel</title>
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
        <div class="container-fluid" align='center'>
            <br>
            <?php echo form_open('AdminController/search_book') ?>
            <table class='table-striped' align="center" height="200" width='700' border='0'>
                <tr align='center'>
                    <td><input type='text' name='author' size='70'  placeholder="Enter Book Title or Book Author" required/>

                </tr>
                <tr align='center'><td><?php
                        $btn = array(
                            'type' => 'submit',
                            'value' => 'Search',
                            'class' => 'btn btn-success'
                        );
                        echo form_submit($btn);
                        ?></td></tr>

            </table>
            <?php echo form_close() ?>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?php if (!(empty($result))) { ?>
                    <?php
                    foreach ($result as $item) {

                        $id = $item->bookId;
                        $title = $item->bookTitle;
                        $author = $item->bookAuthor;
                        $price = $item->bookPrice;
                        $image = $item->bookImage;
                        $count = $item->bookViewCount;
                        ?>

                        <div class = 'col-lg-4 col-md-8'>
                            <div class = 'card'>
                                <img class='card-img' height='200px' width='100px' src='<?php echo base_url('assets/images/'), $image ?>'>
                                <span class = 'content-card'>
                                    <h6><?php echo $title ?><br></h6>
                                    <h7><?php echo $author ?><br></h7>
                                    <b><h7><?php echo "View Count : ". $count?></h7></b>
                                </span>
                                <?php
                                echo form_open('AdminController/edit_book');
                                echo form_hidden('id', $id);
                                echo form_hidden('name', $title);
                                echo form_hidden('price', $price);
                                ?>

                                <?php
                                $btn = array(
                                    'button class' => 'buybtn btn btn-warning btn-round btn-sm',
                                    'value' => 'View Details',
                                    'name' => 'action'
                                );
                                echo form_submit($btn);
                                echo form_close();
                                ?>
                            </div>
                        </div>


                    <?php } ?>
                    <?php
                } else {
                    
                }
                ?>
            </div>
            <div class="row">
                <?php if (!empty($book)): ?>
                    <?php
                    foreach ($book as $product) {
                        $id = $product->bookId;
                        $author = $product->bookAuthor;
                        $title = $product->bookTitle;
                        $image = $product->bookImage;
                        $description = $product->bookDescription;
                        $category = $product->bookCategory;
                        $price = $product->bookPrice
                        ?>
                        <?php
                        echo form_open('AdminController/update_book');
                        echo form_hidden('id', $id);
                        echo form_hidden('name', $title);
                        echo form_hidden('price', $price);
                        ?>
                        <table class="table-striped table" align="center" height="200" width='700' border='0' >


                            <tr>
                                <td scope= "row" align = 'left' colspan = '2'>Book Id:<?php echo $id ?>&nbsp;<b>Book Title :</b><input type="text" size="60" name="title" value="<?php echo $title; ?>">&nbsp; <b>Author :</b><input type="text" size="50"  name="author" value="<?php echo $author; ?>"></td>

                            </tr>
                            <tr>
                                <td align = 'left' rowspan = '3'><img  class='card-image' height='350px' width='200px' src='<?php echo base_url('assets/images/'), $image ?>'> </td>
                                <td align = 'left'><b>Description: </b></td>
                            </tr>
                            <tr>

                                <td align = 'justify'><textarea style='resize:none'name='desc' cols='100' rows='15'><?php echo htmlentities($description); ?></textarea></td>
                            </tr>

                            <tr>

                                <td align = 'left'><b>Category : </b><select name="category" >
                                        <option><?php echo $category ?></option>
                                        <?php if (count($category_book)): ?>
                                            <?php foreach ($category_book as $categories): ?>
                                                <option required value=<?php echo $categories->category; ?>><?php echo $categories->category ?></option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    </select></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td align = 'left'><b>Price :</b> <input value="<?php echo $price ?>" type='text' name='price' required/></td>
                            </tr>
                            <tr>
                                <td align = 'center' colspan='2'><input type="submit" class="btn btn-success"  value="Update"></td>
                            </tr>

                        </table>
                        <?php echo form_close(); ?>
                    <?php } ?>
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>