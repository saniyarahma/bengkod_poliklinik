<?php
// Include file koneksi ke database
include_once("koneksi.php");

// Fungsi untuk memeriksa kesamaan username di database
function isUsernameTaken($mysqli, $username) {
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);
    return (mysqli_num_rows($result) > 0);
}

if (isset($_POST['register'])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Cek apakah username sudah ada di database
    if (isUsernameTaken($mysqli, $username)) {
        echo "<script>alert('Username sudah terpakai. Silakan pilih username lain.')</script>";
    } elseif ($password !== $confirm) {
        echo "<script>alert('Password dan konfirmasi password tidak cocok.')</script>";
    } else {
        // Hash password sebelum menyimpannya ke database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data user baru ke database
        $insert_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
        $insert_result = mysqli_query($mysqli, $insert_query);

        if ($insert_result) {
            echo "<script>
            alert('User Berhasil Ditambahkan. Silakan login.')
            window.location = 'index.php?page=loginUser';
            </script>";
        } else {
            echo "<script>
            alert('Terjadi kesalahan saat mendaftar. Silakan coba lagi.')
            </script>";
        }
    }
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
        <!-- <h1 class="my-5">Pasien</h1> -->

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h2 class="text-center">Registrasi</h2>
                    <form method="post" action="index.php?page=registrasiUser">
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="form-group mt-3">
                            <div>
                                <button type="submit" class="btn btn-primary" name="register">Register</button>
                            </div>
                        </div>
                    </form>
                    <div class="text mt-3">
                        <p>Sudah punya akun, <a href="index.php?page=loginUser">Login</a></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>