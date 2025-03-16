<?php

function hitungDiskon($totalBelanja) {
    if ($totalBelanja >= 100000) {
        return $totalBelanja * 0.10; 
    } elseif ($totalBelanja >= 50000) {
        return $totalBelanja * 0.05; 
    } else {
        return 0; 
    }
}


function hitungTotalBayar($totalBelanja, $diskon) {
    return $totalBelanja - $diskon;
}


$nama = '';
$totalBelanja = 0;
$diskon = 0;
$totalBayar = 0;
$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $totalBelanja = $_POST['total_belanja'];

    $diskon = hitungDiskon($totalBelanja);
    $totalBayar = hitungTotalBayar($totalBelanja, $diskon);

    $message = "Data berhasil dihitung!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Hitung Diskon Belanja</h2>

      
        <form method="post" class="mt-4">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pembeli</label>
                <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $nama; ?>">
            </div>
            <div class="mb-3">
                <label for="total_belanja" class="form-label">Total Belanja</label>
                <input type="number" class="form-control" id="total_belanja" name="total_belanja" required value="<?php echo $totalBelanja; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Hitung</button>
        </form>

        <?php if ($message): ?>
            <div class="mt-4 alert alert-info">
                <strong>Nama:</strong> <?php echo htmlspecialchars($nama); ?><br>
                <strong>Total Belanja:</strong> Rp <?php echo number_format($totalBelanja, 2, ',', '.'); ?><br>
                <strong>Diskon:</strong> Rp <?php echo number_format($diskon, 2, ',', '.'); ?><br>
                <strong>Total yang harus dibayar:</strong> Rp <?php echo number_format($totalBayar, 2, ',', '.'); ?><br>
            </div>
        <?php endif; ?>

        <div class="mt-5">
            <h3>Riwayat Transaksi (sementara)</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pembeli</th>
                        <th>Total Belanja</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                 
                    <?php if ($nama && $totalBelanja > 0): ?>
                        <tr>
                            <td>1</td>
                            <td><?php echo htmlspecialchars($nama); ?></td>
                            <td>Rp <?php echo number_format($totalBelanja, 2, ',', '.'); ?></td>
                            <td>Rp <?php echo number_format($diskon, 2, ',', '.'); ?></td>
                            <td>Rp <?php echo number_format($totalBayar, 2, ',', '.'); ?></td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada transaksi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
