<?php
// Sisipkan koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'contact_db') or die('connection failed');

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hindari SQL Injection dengan menggunakan prepared statement
    $query = "SELECT * FROM akun_admin WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika data ditemukan, redirect ke daftar-pasien.php
        header("Location: admin.php");
        exit();
    } else {
        // Jika tidak ditemukan, tampilkan pesan error atau lakukan tindakan lain
        echo "Login Gagal. Silakan coba lagi.";
    }
}
if (isset($_POST['daftarSubmit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $insert = mysqli_query($conn, "INSERT INTO akun_admin(email, password) VALUES('$email','$password')") or die('query failed');

    if ($insert) {
        $message[] = '<span style="color: green;">Appointment berhasil dibuat!';
    } else {
        $message[] = '<span style="color: red;">Appointment gagal.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <!-- Sertakan link Bootstrap CSS di sini -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">

        <a href="index.php" class="logo"> <i class="fas fa-heartbeat"></i> <strong>Klinik</strong>Akupuntur Dewi </a>
    </header>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Login Form</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Input email" title="Email salah" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Input password" title="Password salah" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block">
                            </div>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <?php
                                if (isset($message)) {
                                    foreach ($message as $message) {
                                        echo '<p class ="message">' . $message . '</p>';
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <input type="submit" name="daftarSubmit" value="Daftar"
                                        class="btn btn-success btn-block">
                                </div>

                            </form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertakan script Bootstrap dan jQuery jika diperlukan -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>