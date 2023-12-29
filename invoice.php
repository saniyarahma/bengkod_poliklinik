<?php
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header('Location: index.php?page=loginUser');
    exit;
}

include_once("koneksi.php");
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Nota Pembayaran</h2>
                    <table class="table table-bordered">
                        <?php
                        include('koneksi.php');
                        date_default_timezone_set("Asia/Jakarta");
                        $result = mysqli_query($mysqli, "SELECT pr.*, d.nama as 'nama_dokter', d.alamat as 'alamat_dokter', d.no_hp as 'no_hp_dokter', p.nama as 'nama_pasien', p.alamat as 'alamat_pasien', p.no_hp as 'no_hp_pasien'
                                FROM periksa pr 
                                LEFT JOIN dokter d ON (pr.id_dokter = d.id) 
                                LEFT JOIN pasien p ON (pr.id_pasien = p.id) 
                                WHERE pr.id='" . $_GET['id'] . "'");
                        $no = 1;
                        $total_invoice = 0;
                        $total_obat = 0;
                        while ($data = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td colspan="2"><strong>Nomor Periksa:</strong> <?php echo $data['id'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Tanggal Periksa:</strong> <?php echo date('d-M-Y H:i:s', strtotime($data['tgl_periksa'])) ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Nama Pasien:</strong> <?php echo $data['nama_pasien'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Alamat Pasien:</strong> <?php echo $data['alamat_pasien'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>No. HP Pasien:</strong> <?php echo $data['no_hp_pasien'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Nama Dokter:</strong> <?php echo $data['nama_dokter'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Alamat Dokter:</strong> <?php echo $data['alamat_dokter'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>No. HP Dokter:</strong> <?php echo $data['no_hp_dokter'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Jasa Dokter:</strong> Rp 150.000,00</td>
                            </tr>
                            <tr>
                                <td class="bg-info text-black"><strong>Deskripsi</strong></td>
                                <td class="bg-info text-black"><strong>Harga</strong></td>
                            </tr>
                            <?php
                            $result_obat = mysqli_query($mysqli, "SELECT dp.*, o.nama_obat as 'nama_obat', o.harga as 'harga'
                                FROM detail_periksa dp
                                LEFT JOIN obat o ON (dp.id_obat = o.id)
                                WHERE dp.id_periksa = '" . $_GET['id'] . "'");
                            while ($data_obat = mysqli_fetch_array($result_obat)) {
                                ?>
                                <tr>
                                    <td><strong><?php echo $data_obat['nama_obat']; ?></strong></td>
                                    <td>Rp <?php echo number_format($data_obat['harga'], 2, ',', '.'); ?></td>
                                </tr>
                                <?php
                                $total_obat += $data_obat['harga'];
                            }
                            ?>
                            <tr>
                                <td class="bg-info text-black"><strong>Subtotal Obat:</strong></td>
                                <td class="bg-info text-black">Rp <?= number_format($total_obat, 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td class="bg-info text-black"><strong>Biaya Dokter:</strong></td>
                                <td class="bg-info text-black">Rp 150.000,00</td>
                            </tr>
                            <tr>
                                <td class="bg-info text-black"><strong>Total:</strong></td>
                                <td class="bg-info text-black">Rp <?= number_format($total_obat + 150000, 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">Terima Kasih Atas Kunjungan Anda dan Semoga Lekas Sembuh</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
            <a class="btn btn-primary mt-2" href="index.php?page=periksa">Kembali</a>
        </div>
    </div>
</div>
