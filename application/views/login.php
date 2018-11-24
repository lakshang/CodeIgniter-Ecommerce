<html lang="en">
    <head>
        <title>Admin Panel Login</title>
        <?php include 'assets/css/css.php'; ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <div>&nbsp;</div>
        <div class="login-form">
            <?php echo form_open('AdminController/login') ?>
            <h2 class="text-center">Log in</h2>       
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
            <?php
            if ($this->session->flashdata('error_message')) {
                echo "<p>" . $this->session->flashdata('error_message') . "</p>";
            }
            ?>
            <?php echo form_close(); ?>
        </div>

    </body>

</html>                                		                            