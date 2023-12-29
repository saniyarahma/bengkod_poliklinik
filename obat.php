<?php

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    // Jika belum login, arahkan kembali ke halaman login
    header('Location: index.php?page=loginUser');
    exit;
}

// Include your database connection file (koneksi.php) to establish the connection
include_once("koneksi.php");

if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                        kemasan = '" . $_POST['kemasan'] . "',
                                        harga = '" . $_POST['harga'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO obat (nama_obat, kemasan, harga) 
                                        VALUES (
                                            '" . $_POST['nama_obat'] . "',
                                            '" . $_POST['kemasan'] . "',
                                            '" . $_POST['harga'] . "'
                                        )");
    }

    echo "<script> 
            document.location='index.php?page=obat';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='index.php?page=obat';
            </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Poliklinik</title>
</head>

<body>
    <div class="container">
        <!-- <h1 class="my-5">Obat</h1> -->

        <form class="form-horizontal" method="POST" action="" name="myForm" onsubmit="return validateForm();">
            <!-- PHP code to retrieve data if ID is set -->
            <?php
            $nama_obat = '';
            $kemasan = '';
            $harga = '';
            if (isset($_GET['id'])) {
                $ambil = mysqli_query($mysqli, "SELECT * FROM obat WHERE id='" . $_GET['id'] . "'");
                while ($row = mysqli_fetch_array($ambil)) {
                    $nama_obat = $row['nama_obat'];
                    $kemasan = $row['kemasan'];
                    $harga = $row['harga'];
                }
            ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <?php
            }
            ?>
            <div class="form-group">
                <label for="inputNamaPbat" class="control-label mt-2 fw-bold">Nama Obat</label>
                <div>
                    <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputKemasan" class="control-label mt-2 fw-bold">Kemasan</label>
                <div>
                    <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputHarga" class="control-label mt-2 fw-bold">Harga</label>
                <div>
                    <input type="text" class="form-control" name="harga" id="inputHarga" placeholder="Harga" value="<?php echo $harga ?>">
                </div>
            </div>
            <div class="form-group mt-3">
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </div>
        </form>


        <!-- Table -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Obat</th>
                    <th scope="col">Kemasan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to fetch and display data -->
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM obat");
                $no = 1;
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data['nama_obat'] ?></td>
                        <td><?php echo $data['kemasan'] ?></td>
                        <td><?php echo $data['harga'] ?></td>
                        <td>
                            <a class="btn btn-success rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>">Ubah</a>
                            <a class="btn btn-danger rounded-pill px-3" href="index.php?page=obat&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>