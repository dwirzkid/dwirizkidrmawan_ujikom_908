<?php

require_once 'service/connect.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $jurusan = $_POST['jurusan'];

  
    $sql = "INSERT INTO mahasiswa (nim, nama, gender, jurusan) VALUES ('$nim', '$nama', '$gender', '$jurusan')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$sql = "SELECT * FROM mahasiswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Input Data Mahasiswa</h2>

       
        <form method="post" class="mt-4">
            <div class="row mb-3">
                <div class="mt-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                    <div class="col">
                        <input type="text" class="form-control" id="nim" name="nim" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col">
                        <input type="text" class="form-control" id="nama" name="nama" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col">
                        <input type="text" class="form-control" id="gender" name="gender" required />
                    </div>
                </div>
                <div class="mt-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                    <div class="col">
                        <input type="text" class="form-control" id="jurusan" name="jurusan" required />
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Input</button>
        </form>

        
        <div class="mt-5">
            <h3>List Mahasiswa</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $no++ . "</td>
                                    <td>" . $row['nim'] . "</td>
                                    <td>" . $row['nama'] . "</td>
                                    <td>" . $row['gender'] . "</td>
                                    <td>" . $row['jurusan'] . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>Data mahasiswa kosong.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
