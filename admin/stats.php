<?php
require_once "./../config.php";
$complete;
$completeamount;
$processing;
$processingamount;
$total;
$totalamount;
// Attempt select query execution
$sql = "SELECT SUM(amount) AS c_sum FROM sales WHERE status = 'completed'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $completeamount = $row['c_sum'];
    }
}
$sql = "SELECT SUM(amount) AS c_sum FROM sales WHERE status = 'delivered'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $deliveredamount = $row['c_sum'];
    }
}
$sql = "SELECT SUM(amount) AS c_sum FROM sales WHERE status NOT LIKE 'processing'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $totalamount = $row['c_sum'];
    }
}
$sql = "SELECT COUNT(amount) AS c_sum FROM sales WHERE status NOT LIKE 'processing'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $total = $row['c_sum'];
    }
}
$sql = "SELECT COUNT(amount) AS c_sum FROM sales WHERE status = 'delivered'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $delivered = $row['c_sum'];
    }
}
$sql = "SELECT COUNT(amount) AS c_sum FROM sales WHERE status = 'completed'";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $complete = $row['c_sum'];
    }
}


// echo $complete . '<br>';
// echo $completeamount . '<br>';
// echo $processing . '<br>';
// echo $processingamount . '<br>';
// echo $total . '<br>';
// echo $totalamount . '<br>';

?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            "packages": ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ["Category", "Revenue"],
                ["Delivered", <?php echo $deliveredamount ?>],
                ["Completed", <?php echo $completeamount ?>]
            ]);

            var options = {
                title: "Revenue Produced by Sales"
            };

            var chart = new google.visualization.PieChart(document.getElementById("piechart"));

            chart.draw(data, options);
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <br><br><br><br>
    <div class="container-fluid mx-auto">
        <div class="row">
            <div class="col-lg-6" style="padding-top: 201px;">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Processed Orders</th>
                            <th>Revenue</th>
                            <th>Delivered Orders</th>
                            <th>Revenue</th>
                            <th>Total Orders</th>
                            <th>Total Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $complete; ?></td>
                            <td><?php echo $completeamount; ?></td>
                            <td><?php echo $delivered; ?></td>
                            <td><?php echo $deliveredamount; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $totalamount; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div>

        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>