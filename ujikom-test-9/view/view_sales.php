<?php

require_once '../service/connect.php';

// Menangani aksi untuk tambah data sales
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_sales') {
    $tgl_sales = $_POST['tgl_sales'];
    $id_customer = $_POST['id_customer'];
    $do_number = $_POST['do_number'];
    $status = $_POST['status'];

    $sql = "INSERT INTO sales (tgl_sales, id_customer, do_number, status) 
            VALUES ('$tgl_sales', '$id_customer', '$do_number', '$status')";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah data berhasil ditambahkan
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan data sales
$sql = "SELECT * FROM sales";
$result = $conn->query($sql);

// Menampilkan data customer untuk dropdown
$sql_customers = "SELECT id_customer, nama_customer FROM customer";
$customers_result = $conn->query($sql_customers);

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
                <li><a class="dropdown-item" href="view_user.php">user</a></li>
                <li><a class="dropdown-item" href="view_sales.php">Sales</a></li>
                <li><a class="dropdown-item" href="view_item.php">Item</a></li>
                <li><a class="dropdown-item" href="view_petugas.php">Petugas</a></li>
                <li><a class="dropdown-item" href="../index.php">Home</a></li>
            </ul>
        </div>
    </div>
</div>

<content>
    <div class="container mt-5">
        <h2 class="text-center">Input Data Sales</h2>

        <!-- Form input data sales -->
        <form method="POST" class="mt-4">
            <input type="hidden" name="action" value="add_sales">
            
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="tgl_sales" class="col-form-label">Tanggal</label>
                </div>
                <div class="col-sm-10">
                    <!-- Tanggal otomatis terisi -->
                    <input type="text" class="form-control" id="tgl_sales" name="tgl_sales" value="<?php echo date('Y-m-d'); ?>" readonly required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="id_customer" class="col-form-label">Customer</label>
                </div>
                <div class="col-sm-10">
                    <!-- Dropdown untuk memilih customer -->
                    <select class="form-control" id="id_customer" name="id_customer" required>
                        <option value="">Pilih Customer</option>
                        <?php
                        if ($customers_result->num_rows > 0) {
                            while ($customer = $customers_result->fetch_assoc()) {
                                echo "<option value='" . $customer['id_customer'] . "'>" . $customer['nama_customer'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="do_number" class="col-form-label">DO Number</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="do_number" name="do_number" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="status" class="col-form-label">Status</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Sales</button>
        </form>

        <!-- Tabel menampilkan data sales -->
        <h3 class="mt-5">List Sales</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Id Sales</th>
                    <th>Tgl Sales</th>
                    <th>Customer</th>
                    <th>DO Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['tgl_sales'] . "</td>
                                <td>" . $row['id_customer'] . "</td>
                                <td>" . $row['do_number'] . "</td>
                                <td>" . $row['status'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Data sales kosong.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</content>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
