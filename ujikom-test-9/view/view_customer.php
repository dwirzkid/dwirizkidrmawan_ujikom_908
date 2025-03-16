<?php
// Memanggil file koneksi database
require_once '../service/connect.php';

// Menangani aksi untuk tambah data customer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_customer') {
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customer (nama_customer, alamat, telp, fax, email) VALUES ('$nama_customer', '$alamat', '$telp', '$fax', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah data berhasil ditambahkan
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan data customer
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
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
                    <li><a class="dropdown-item" href="../index.php">Home</a></li>
                </ul>
            </div>
        </div>
    </div>

<content>
    <div class="container mt-5">
        <h2 class="text-center">Input Data Customer</h2>

        <!-- Form input data customer -->
        <form method="POST" class="mt-4">
            <input type="hidden" name="action" value="add_customer">
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="nama_customer" class="col-form-label">Nama Customer</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="alamat" class="col-form-label">Alamat</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="telp" class="col-form-label">Telp</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telp" name="telp" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="fax" class="col-form-label">Fax</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fax" name="fax" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="email" class="col-form-label">Email</label>
                </div>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Customer</button>
        </form>

        <!-- Tabel menampilkan data customer -->
        <h3 class="mt-5">List Customer</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Fax</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['nama_customer'] . "</td>
                                <td>" . $row['alamat'] . "</td>
                                <td>" . $row['telp'] . "</td>
                                <td>" . $row['fax'] . "</td>
                                <td>" . $row['email'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data customer kosong.</td></tr>";
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
