<?php
$conn = mysqli_connect('localhost', 'root', '', 'contact_db') or die('connection failed');

// Cek apakah ada kiriman form dari method post untuk update akun admin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST["id"]);
    $email = input($_POST["email"]);
    $password = input($_POST["password"]);

    // Query update data pada tabel akun_admin
    $sql = "UPDATE akun_admin SET
            email='$email',
            password='$password'
            WHERE id=$id";

    // Mengeksekusi query
    $hasil = mysqli_query($conn, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: acount.php");
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <header class="header">

        <a href="index.php" class="logo"> <i class="fas fa-heartbeat"></i> <strong>Admin</strong> page </a>
        <nav class="navbar">
            <a href="admin.php">Pasien</a>
            <a href="acount.php">Acount</a>
            <a href="login.php">Log Out</a>
        </nav>

    </header>
    <div class="container-admin" id="akun">
        <br>
        <h4 style="font-size:35px">
            <center>Daftar Acount</center>
        </h4>
        <table class="my-3 table table-bordered">
            <thead class="table-primary">
                <tr style="background-color:#16a085">
                    <th>No</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th colspan='2'>Pilihan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM akun_admin ORDER BY id DESC";
                $hasil = mysqli_query($conn, $sql);
                $no = 0;

                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                    ?>
                    <tr>
                        <td>
                            <?php echo $no; ?>
                        </td>
                        <td>
                            <?php echo $data["email"]; ?>
                        </td>
                        <td>
                            <?php echo $data["password"]; ?>
                        </td>
                        <td>
                            <a href="?id_akun=<?php echo htmlspecialchars($data['id']); ?>"
                                class="btn btn-warning">Update</a>
                            <a href="?delete_id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php
                }

                // Cek apakah ada kiriman form untuk delete
                if (isset($_GET['delete_id'])) {
                    $id_to_delete = $_GET['delete_id'];
                    $sql_delete = "DELETE FROM akun_admin WHERE id = $id_to_delete";
                    $result_delete = mysqli_query($conn, $sql_delete);
                    if ($result_delete) {
                        header("Location: acount.php");
                    } else {
                        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                    }
                }
                ?>
            </tbody>
        </table>

        <?php
        // Cek apakah ada kiriman form dari method get untuk update
        if (isset($_GET['id_akun'])) {
            $id = htmlspecialchars($_GET["id_akun"]);

            $sql = "SELECT * FROM akun_admin WHERE id=$id";
            $hasil = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($hasil);
            ?>
            <div class="update">
                <h2>Update Data</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>"
                            required />
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
                    <button type="submit" name="submit" class="btn-admin btn-primary">Update</button>
                </form>
            </div>

            <?php
        }
        ?>
    </div>
</body>

</html>