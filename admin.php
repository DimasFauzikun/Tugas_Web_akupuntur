<?php

$conn = mysqli_connect('localhost', 'root', '', 'contact_db') or die('connection failed');

// Cek apakah ada kiriman form dari method post untuk update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = htmlspecialchars($_POST["id"]);
    $name = input($_POST["name"]);
    $email = input($_POST["email"]);
    $number = input($_POST["number"]);
    $perawatan = input($_POST["perawatan"]);
    $date = input($_POST["date"]);

    // Query update data pada tabel contact_form
    $sql = "UPDATE contact_form SET
            name='$name',
            email='$email',
            number='$number',
            perawatan='$perawatan',
            date='$date'
            WHERE id=$id";

    // Mengeksekusi query
    $hasil = mysqli_query($conn, $sql);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query
    if ($hasil) {
        header("Location: admin.php");
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
    <title>Admin</title>
</head>

<body>
    <header class="header">

        <a href="index.php" class="logo"> <i class="fas fa-heartbeat"></i> <strong>Admin</strong> page </a>
        <nav class="navbar">
            <a href="#pasien">Pasien</a>
            <a href="acount.php">Acount</a>
            <a href="login.php">Log Out</a>
        </nav>
    </header>



    <div class="container-admin" id="pasien">
        <br>
        <h4 style="font-size:35px">
            <center>Daftar Pasien</center>
        </h4>
        <table class="my-3 table table-bordered">
            <thead class="table-primary">
                <tr style="background-color:#16a085">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Nomor Handphone</th>
                    <th>Jenis Perawatan</th>
                    <th>Date</th>
                    <th colspan='2'>Pilihan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM contact_form ORDER BY id DESC";
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
                            <?php echo $data["name"]; ?>
                        </td>
                        <td>
                            <?php echo $data["email"]; ?>
                        </td>
                        <td>
                            <?php echo $data["number"]; ?>
                        </td>
                        <td>
                            <?php echo $data["perawatan"]; ?>
                        </td>
                        <td>
                            <?php echo $data["date"]; ?>
                        </td>
                        <td>
                            <a href="?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning">Update</a>
                            <a href="?delete_id=<?php echo $data['id']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php
                }

                // Cek apakah ada kiriman form untuk delete
                if (isset($_GET['delete_id'])) {
                    $id_to_delete = $_GET['delete_id'];
                    $sql_delete = "DELETE FROM contact_form WHERE id = $id_to_delete";
                    $result_delete = mysqli_query($conn, $sql_delete);
                    if ($result_delete) {
                        header("Location: admin.php");
                    } else {
                        echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                    }
                }
                ?>
            </tbody>
        </table>

        <?php
        // Cek apakah ada kiriman form dari method get untuk update
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET["id"]);

            $sql = "SELECT * FROM contact_form WHERE id=$id";
            $hasil = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($hasil);
            ?>
            <div class="update">
                <h2>Update Data</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $data['name']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Nomor Handphone:</label>
                        <input type="number" name="number" class="form-control" value="<?php echo $data['number']; ?>"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Jenis Perawatan:</label>
                        <select name="perawatan" id="perawatan" class="form-control"
                            value="<?php echo $data['perawatan']; ?>" required>
                            <option value="Theraphy Akupunktur">Theraphy Akupunktur</option>
                            <option value="Perawatan Wajah">Perawatan Wajah</option>
                            <option value="Perawatan Badan">Perawatan Badan</option>
                            <option value="Perawatan Khusus Wanita">Perawatan Khusus Wanita</option>
                            <option value="Perawatan Lainnya">Perawatan Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="date" class="form-control" value="<?php echo $data['date']; ?>" required />
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