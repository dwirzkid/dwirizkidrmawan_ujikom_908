<?php

require_once '../service/connect.php';

// Menangani aksi untuk tambah data petugas
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_user') {
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $id_user = $_POST['id_user']; // Menyertakan id_user untuk foreign key

    // Menambahkan data ke tabel petugas
    $sql = "INSERT INTO petugas (nama_user, username, password, level, id_user) 
            VALUES ('$nama_user', '$username', '$password', '$level', '$id_user')";

    if ($conn->query($sql) === TRUE) {
        // Redirect setelah data berhasil ditambahkan
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menampilkan data petugas
$sql = "SELECT * FROM petugas";
$result = $conn->query($sql);

// Menampilkan data sales untuk dropdown id_user
$sql_sales = "SELECT id_sales, do_number FROM sales"; // Mengambil id_sales dan DO number
$sales_result = $conn->query($sql_sales);

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
        <h2 class="text-center">Input Data Petugas</h2>

        <!-- Form input data user -->
        <form method="POST" class="mt-4">
            <input type="hidden" name="action" value="add_user">

            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="nama_user" class="col-form-label">Nama user</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="username" class="col-form-label">Username</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="password" class="col-form-label">Password</label>
                </div>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="level" class="col-form-label">Level</label>
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="level" name="level" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-2">
                    <label for="id_user" class="col-form-label">ID User (Sales)</label>
                </div>
                <div class="col-sm-10">
                    <select class="form-control" id="id_user" name="id_user" required>
                        <option value="">Pilih ID Sales</option>
                        <?php
                        if ($sales_result->num_rows > 0) {
                            while ($sales = $sales_result->fetch_assoc()) {
                                echo "<option value='" . $sales['id_sales'] . "'>" . $sales['do_number'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan user</button>
        </form>

        <!-- Tabel menampilkan data petugas -->
        <h3 class="mt-5">List Petugas</h3>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>ID User (Sales)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row['nama_user'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['password'] . "</td>
                                <td>" . $row['level'] . "</td>
                                <td>" . $row['id_user'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Data petugas kosong.</td></tr>";
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
