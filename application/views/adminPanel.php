<html>
    <head><title>National Store Admin Panel</title>

        <?php include 'assets/css/css.php'; ?>
        <?php $this->load->view('navigationBarAdmin'); ?>

        <!--Load the AJAX API--> 
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 

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
        <!--Div that will hold the pie chart--> 
        <br>
        <h2 align="center">Mostly Viewed Top 5 Books</h2> 
        <div id="chart_div" align="center">
            <script type="text/javascript">
                google.charts.load('current', {'packages': ['corechart', 'bar']});
                google.charts.setOnLoadCallback(generateChart);
                function generateChart() {
                    var jsonData = $.ajax({
                        url: "<?php echo base_url('adminController') . '/statistics' ?>",
                        dataType: "json",
                        async: false
                    }).responseText;
                    var data = new google.visualization.DataTable(jsonData);


                    var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
                    chart.draw(data, {width: 1000, height: 500}, );
                }

            </script> 
        </div> 
    </body> 


</body>
</html>

