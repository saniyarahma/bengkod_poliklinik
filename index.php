<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">

    <!-- Bootstrap offline -->

    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css">  -->

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Poliklinik</title> <!--Judul Halaman-->
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Sistem Informasi Poliklinik
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Data Master
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="index.php?page=dokter">
                                    Dokter
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="index.php?page=pasien">
                                    Pasien
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=periksa">
                            Periksa
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Periksa apakah pengguna sudah login, jika iya, tampilkan "Logout" -->
            <?php
            if (isset($_SESSION['login'])) {
            ?>
            <form action="">
                <div class="collapse navbar-collapse" id="navbarNavRegis">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </form>
            <?php
            } else {
            ?>

            <form action="">
            <div class="collapse navbar-collapse" id="navbarNavRegis">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=registrasiUser">
                    Registrasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=loginUser">
                    Login
                    </a>
                </li>
                </ul>
            </form>
            <?php
            }
            ?>
            <!-- <ul class="navbar-nav mr-3"> <!-- Menempatkan item di sebelah kanan -->
                <!-- <li class="nav-item">
                    <a class="nav-link mr-3" aria-current="page" href="index.php?page=registrasiUser">
                        Registrasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mr-3" aria-current="page" href="index.php?page=loginUser">
                        Login
                    </a>
                </li> -->
            <!-- </ul> --> -->
        </div>
    </nav>
</body>

</html>

<main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
    ?>
        <h2><?php echo ucwords($_GET['page']) ?></h2>
    <?php
        include($_GET['page'] . ".php");
    } else {
        echo "Selamat Datang di Sistem Informasi Poliklinik";
    }
    ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>