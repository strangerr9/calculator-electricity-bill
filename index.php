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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voltage = $_POST["voltage"];
    $current = $_POST["current"];
    $rate = $_POST["rate"];
    $hours = $_POST["hours"]; //  passed from the form for per hour/day calculation

    $result = calculateElectricityBill($voltage, $current, $rate, $hours);
    // Assign results for display
    $power = $result['power'] . " W";
    $energy = $result['energy'] . " kWh";
    $totalCharge = "RM " . number_format($result['totalCharge'], 2);
} else {
    // if there is no calculation yet will display '0'
    $power = $energy = $totalCharge = '0';
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

                    <h2>Calculate Electricity Bill</h2>
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
                            <label for="rate">Current Rate (currency/100kWh)</label>
                            <input type="number" class="form-control" id="rate" name="rate" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="hours">Hours</label>
                            <input type="number" class="form-control" id="hours" name="hours" required>
                        </div>
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
                            <p>Power: <?php echo htmlspecialchars($power); ?></p>
                            <p>Energy: <?php echo htmlspecialchars($energy); ?></p>
                            <p>Total : <?php echo htmlspecialchars($totalCharge); ?></p>
                        </div>
                    </div>
                    <div class="blob"></div>
                </div>
            </div>

        </div>





    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>