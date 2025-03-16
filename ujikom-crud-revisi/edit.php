<?php
// Memanggil file koneksi database
require_once 'service/connect.php'; 


if (isset($_GET['no'])) {
    $no = $_GET['no'];
    $sql = "SELECT * FROM mahasiswa WHERE no = $no";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row) {
        $nim = $row['nim'];
        $nama = $row['nama'];
        $gender = $row['gender'];
        $jurusan = $row['jurusan'];
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $no = $_POST['no'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $jurusan = $_POST['jurusan'];

    $sql = "UPDATE mahasiswa SET nim = '$nim', nama = '$nama', gender = '$gender', jurusan = '$jurusan' WHERE no = $no";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate!";
        header("Location: index.php");  // Arahkan kembali ke halaman utama setelah berhasil mengupdate
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Data Mahasiswa</h2>

        <form method="post" class="mt-4">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="no" value="<?= $row['no'] ?>">

            <div class="row mb-3">
                <div class="mt-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col">
                        <input type="text" class="form-control" id="nim" name="nim" value="<?= $nim ?>" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col">
                        <input type="text" class="form-control" id="gender" name="gender" value="<?= $gender ?>" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col">
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $jurusan ?>" required />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
