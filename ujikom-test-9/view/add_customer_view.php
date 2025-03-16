<!-- <?php
require_once '../service/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add_customer') {
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $fax = $_POST['fax'];
    $email = $_POST['email'];

    $sql = "INSERT INTO customer (nama_customer, alamat, telp, fax, email) VALUES ('$nama_customer', '$alamat', '$telp', '$fax', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Customer berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Customer</h2>
        <form method="POST" class="mt-4">
            <input type="hidden" name="action" value="add_customer">
            <div class="mb-3">
                <label for="nama_customer" class="form-label">Nama Customer</label>
                <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" required>
            </div>
            <div class="mb-3">
                <label for="fax" class="form-label">Fax</label>
                <input type="text" class="form-control" id="fax" name="fax" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Customer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html> -->
