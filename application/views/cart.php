<html>
    <head>
        <title>Cart</title>
        <?php include 'assets/css/css.php'; ?>
        <?php $this->load->view('navigationBar') ?>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,800" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

        <!-- CSS Files -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/material-kit.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
        <script type="text/javascript">
            function clear_cart() {
                var result = confirm('Are you sure want to clear the cart?');

                if (result) {
                    window.location = "<?php echo base_url(); ?>CartController/remove/all";
                } else {
                    return false; // cancel button
                }
            }
        </script>
    </head>
    <body>
        <a href="cart.php"></a>
        <div>
            <h1>Cart</h1>
            <?php
            $cart_check = $this->cart->contents();
            if (empty($cart_check)) {
                echo 'To add products to your shopping cart click on "Add" Button';
            }
            ?>
        </div>

        <?php
        if ($cart = $this->cart->contents()):
            ?>
            <div class="container">
                <table class="table-striped table" >
                    <thead class="thead-inverse">
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Cancel</th>
                    </thead>
                    <tbody>
                        <?php
                        echo form_open(base_url('CartController/update'));
                        $total = 0;
                        $i = 1;

                        foreach ($cart as $item):

                            echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                            echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                            ?>
                            <tr>
                                <td scope = "row" >
                                    <?php echo $i++; ?>
                                </td>
                                <td>
                                    <?php echo $item['name']; ?>
                                </td>
                                <td>
                                    $ <?php echo number_format($item['price'], 2); ?>
                                </td>
                                <td>
                                    <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                                </td>
                                <?php $total = $total + $item['subtotal']; ?>
                                <td>
                                    $ <?php echo number_format($item['subtotal'], 2) ?>
                                </td>
                                <td>

                                    <?php
                                    $path = "<img src='https://www.freeiconspng.com/uploads/remove-icon-png-24.png' width='25px' height='20px'>";
                                    echo anchor('CartController/remove/' . $item['rowid'], $path);
                                    ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td><b>Order Total: $<?php echo number_format($total, 2); ?></b></td>
                            <td colspan="5" align="right"><input   type="button" value="Clear Cart" class="btn btn-danger" onclick="clear_cart()">
                                <input  type="submit" value="Update Cart" class="btn btn-danger">
                                <?php echo form_close(); ?>
                                <?php echo form_open('CartController/order'); ?>
                                <input type="submit" class="btn btn-success"  value="Place Order">
                                <?php echo form_close(); ?>
                            </td>
                        </tr>

                    <?php endif; ?>
            </table>
        </tbody>
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