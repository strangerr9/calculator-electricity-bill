<!-- PROGRAMMER NAME : MUHAMMAD IRFAN BIN MUHAMMAD ZAKI -->
<!-- PROGRAM : CALCULATOR ELECTRICITY BILL -->


<?php

function calculateElectricityBill($voltage, $current, $rate, $hours)
{
    $power = $voltage * $current; // Power in watts
    $energy = $power * $hours / 1000; // Energy in kWh
    $totalCharge = $energy * ($rate / 100); // Total charge 



    return [
        'power' => $power, // in Watts
        'energy' => $energy, // in kWh
        'totalCharge' => $totalCharge // in currency
    ];
}
$power = $energy = $totalCharge = $currentRate = '0';
$tableData = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = $_POST["voltage"];
    $current = $_POST["current"];
    $rate = $_POST["rate"];
    // Calculate power just once because it doesn't change over the hours
    $power = $voltage * $current; // Power in watts'
   // $currentRate = $current / 100;

    for ($hour = 1; $hour <= 24; $hour++) {
        $result = calculateElectricityBill($voltage, $current, $rate, $hour);
        $tableData[] = [
            'hour' => $hour,
            'energy' => $result['energy'],
            'totalCharge' => $result['totalCharge']
        ];
    }

    // Format the power for display
    $power = $power . " W";
    // Assign the first hour's results for energy and total charge for display
    $energy = $tableData[0]['energy'] . " kWh";
    $totalCharge = "RM " . number_format($tableData[0]['totalCharge'], 2);
    $currentRate = $rate / 100 . "RM";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Electricity Bill Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">

</head>

<body>



    <div class="container mt-5">


        <!-- Div body to define flex display and to set child in it to center-->
        <div class="container-body">
            <!-- First content set as a left  -->
            <div class="container-left">
                <div class="card_form">

                    <h2>Calculate Electricity </h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="voltage">Voltage (V)</label>
                            <input type="number" class="form-control" id="voltage" name="voltage" required>
                        </div>
                        <div class="form-group">
                            <label for="current">Current (A)</label>
                            <input type="number" class="form-control" id="current" step="0.01" name="current" required>
                        </div>
                        <div class="form-group">
                            <label for="rate">Current Rate (sen/kWh)</label>
                            <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="number" class="form-control" id="hours" name="hours" required>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Calculate</button>
                    </form>

                </div>
            </div>


            <!-- Second content set as a right  -->
            <div class="container-right">

                <!-- CSS class to display card output -->
                <div class="card">

                    <div class="bg">
                        <div class="results">
                            <h2>Result</h2>
                            <!-- <p>Power: <?php echo htmlspecialchars($power); ?></p> -->
                            <p>Power: <?php echo htmlspecialchars($energy); ?></p>
                            <p>Rate : <?php echo htmlspecialchars($currentRate); ?></p>
                        </div>
                    </div>
                    <div class="blob"></div>
                </div>
            </div>


        </div>



        

        



    </div>


    
            <!-- Table HTML -->
            <div class="container mt-5">
            <div class="tbl">
                <table class="table tbl-energy">
                    <thead>
                        <tr>
                            <th>Hour</th>
                            <th>Energy (kWh)</th>
                            <th>TOTAL (RM)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tableData as $row) : ?>
                            <tr>
                                <td><?= $row['hour'] ?></td>
                                <td><?= number_format($row['energy'], 5) ?></td>
                                <td><?= "RM " . number_format($row['totalCharge'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
