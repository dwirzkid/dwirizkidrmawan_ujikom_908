<?php

require_once 'service/connect.php';



$sql_count_customer = "SELECT COUNT(*) as count_customer FROM customer";
$result_count_customer = $conn->query($sql_count_customer);
$count_customer = $result_count_customer->fetch_assoc()['count_customer'];


$sql_count_petugas = "SELECT COUNT(*) as count_petugas FROM petugas";
$result_count_petugas = $conn->query($sql_count_petugas);
$count_petugas = $result_count_petugas->fetch_assoc()['count_petugas'];


$sql_count_item = "SELECT COUNT(*) as count_item FROM item";
$result_count_item = $conn->query($sql_count_item);
$count_item = $result_count_item->fetch_assoc()['count_item'];


$sql_count_sales = "SELECT COUNT(*) as count_sales FROM sales";
$result_count_sales = $conn->query($sql_count_sales);
$count_sales = $result_count_sales->fetch_assoc()['count_sales'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Test 9</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="bg-primary w-100 py-5">
        <div class="container">
            <div class="row g-0 text-center">
                <div class="col-sm-6 col-md-8">
                    <h1 class="text-white">Crud Test 9</h1>
                </div>
                <div class="col-6 col-md-4">
                    <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        Menu
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body">
            <div>
                List Feature
            </div>
            <div class="dropdown mt-3">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Dropdown button
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="view/view_customer.php">Customer</a></li>
                    <li><a class="dropdown-item" href="view/view_sales.php">Sales</a></li>
                    <li><a class="dropdown-item" href="view/view_item.php">Item</a></li>
                    <li><a class="dropdown-item" href="view/view_petugas.php">Petugas</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="px-5">
        <h3 class="mt-5">Total Data</h3>
        <ul>
            <li>Total Customer: <?php echo $count_customer; ?></li>
            <li>Total Petugas: <?php echo $count_petugas; ?></li>
            <li>Total Item: <?php echo $count_item; ?></li>
            <li>Total Data Sales: <?php echo $count_sales; ?></li>
        </ul>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>