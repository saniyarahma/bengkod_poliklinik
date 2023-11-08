<?php 
if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}


// Include file koneksi ke database
include_once("koneksi.php");

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1){
        
        //cek password
        $row = mysqli_fetch_array($result);
        if(password_verify($password, $row["password"])){

            //set session
            $_SESSION["login"] = true;
            header('Location: index.php');
            exit;
        }
    }
    $error = true;
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="border rounded p-3">
                    <h2 class="text-center">Login</h2>
                    <form method="post" action="#">
                    <?php if( isset($error) ) : ?>
                            <p style="color: blue; ">Username atau Password Salah</p>
                    <?php endif; ?>
                        <div class="form-group">
                            <label for="username" class="col-form-label">Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mt-3">
                            <div>
                                <button type="submit" class="btn btn-primary" name="login">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="text mt-3">
                        <p>Belum punya akun? <a href="index.php?page=registrasiUser">Registrasi</a></p>
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
