<?php

$conn = mysqli_connect('localhost', 'root', '', 'contact_db') or die('connection failed');

$message = []; // Inisialisasi pesan

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $perawatan = mysqli_real_escape_string($conn, $_POST['perawatan']);
    $date = $_POST['date'];

    // Memeriksa apakah tanggal sudah terpakai
    $checkDate = mysqli_query($conn, "SELECT * FROM contact_form WHERE date = '$date'");

    $dayOfWeek = date('w', strtotime($date));


    if (mysqli_num_rows($checkDate) > 0 || $dayOfWeek == 0) {
        // Jika tanggal sudah terpakai, tambahkan pesan error
        $message[] = '<span style="color: red;">Tanggal sudah terpakai atau hari Minggu. Pilih tanggal lain.</span>';
    } else {
        // Jika tanggal belum terpakai, lakukan penyisipan data
        $insert = mysqli_query($conn, "INSERT INTO contact_form(name, email, number, perawatan, date) VALUES('$name','$email','$number','$perawatan','$date')") or die('query failed');

        if ($insert) {
            $message[] = '<span style="color: green;">Appointment berhasil dibuat!';
        } else {
            $message[] = '<span style="color: red;">Appointment gagal.';
        }
    }
}

// Mengirim pesan sebagai JSON response
echo json_encode(['message' => $message]);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Klinik Akupuntur</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>Klinik</strong>Akupuntur Dewi </a>

        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#services">Services</a>
            <a href="#doctors">Promo</a>
            <a href="#appointment">pendaftaran</a>
            <a href="#review">review</a>
            <a href="login.php">Login</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="image">
            <img src="image/home-img.svg" alt="">
        </div>

        <div class="content">
            <h3>Klinik Akupuntur Dewi</h3>
            <p> Klinik Akupuntur Dewi. Akupunktur & Estetika berlokasi di Bogor sejak tahun 2004. Menjadi salah satu
                penyedia Akupunktur dan Kecantikan dengan berbagai perawatan yang terus berkembang hingga saat ini.
                Mengedepankan terapi Akupunktur yang dijalankan oleh Ahli Profesional demi memberikan terapi Berkualitas
                serta mengutamakan Kepuasan Pelanggan. Semua pelayanan dilakukan oleh Profesional serta produk yang
                tersedia terjamin aman dan efektif demi menunjang Kecantikan dan Kesehatan Anda. </p>
            <a href="#appointment" class="btn"> Daftar Sekarang <span class="fas fa-chevron-right"></span> </a>
        </div>

    </section>

    <!-- home section ends -->

    <!-- icons section starts  -->

    <section class="jadwal">
        <h1 class="heading">Jadwal <span>Praktek</span></h1>
        <div class="icons-container">
            <div class="icons">
                <i class="far fa-calendar-alt"></i>
                <h3>Senin-Jumat</h3>
                <p>Jam 8.00 - 18.00</p>
            </div>

            <div class="icons">
                <i class="far fa-calendar-alt"></i>
                <h3>Sabtu</h3>
                <p>jam 8.00 - 15.00</p>
            </div>

            <div class="icons">
                <i class="far fa-calendar-alt" style="color:red;"></i>
                <h3>Minggu</h3>
                <p>Libur</p>
            </div>
        </div>
    </section>

    <!-- icons section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">

        <h1 class="heading"> <span>Tentang</span> Kami </h1>

        <div class="row">
            <div class="video-akupuntur">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/XKBlQqvaAD4?autoplay=1&mute=1"
                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>


            <!-- <div class="image">
                <img src="image/about-img.svg" alt="">
            </div> -->

            <div class="content">
                <h3>Visi dan misi Klinik Akupuntur Dewi</h3>
                <p>Visi klinik Akupuntur Dewi yaitu menjadi unggul dalam bidang layanan Akupunktur dan Kecantikan dengan
                    Misi melayani dan memenuhi kebutuhan pelanggan dengan memberikan terapi berkualitas. Demi
                    tercapainya Visi dan Misi Klinik Akupuntur Dewi kami selalu mengedepankan 3S yaitu Senyum, Salam,
                    Sapa dan melayani dengan sepenuh hati demi tercapainya kepuasan pelanggan.</p>
                <p>Kelompok 13 <br>Dimas Fauzikun - 50421388 <br>Muhammad Iqbal Syaputra - 50421999<br>Sabrina Nurhaliza <br>Rahmi Riezkita
                </p>
                <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
            </div>

        </div>

    </section>

    <!-- about section ends -->

    <!-- services section starts  -->

    <section class="services" id="services">

        <h1 class="heading"> our <span>services</span> </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-notes-medical"></i>
                <h3>Theraphy Akupunktur</h3>
                <p>
                    Akupunktur Kesehatan,
                    Akupunktur Kecantikan dan
                    Akupunktur Khusus Wanita</p>
            </div>

            <div class="box">
                <i class="far fa-grin-beam"></i>
                <h3>Perawatan Wajah</h3>
                <p>
                    Facial Treatment,
                    Ozone Treatment,
                    Detox Wajah,
                    Totok Wajah,
                    Intense Pulsed Light,
                    Radio Frequency V-Shape,
                    Peeling Acne,
                    Auto Needle Scar,
                    Auto Needle Flek,
                    Microdermabrasi,
                    Masker LED dan
                    Ultrasound</p>
            </div>

            <div class="box">
                <i class="fas fa-pills"></i>
                <h3>Perawatan Badan</h3>
                <p>Cavitation Body Slim,
                    RF Body Slim,
                    Bekam dan
                    Akupresur</p>
            </div>

            <div class="box">
                <i class="fas fa-venus"></i>
                <h3>Perawatan Khusus Wanita</h3>
                <p>Massage Payudara, Kop, Mask
                    Gurah V dan
                    Medical V Spa Ozon</p>
            </div>

            <div class="box">
                <i class="fas fa-heartbeat"></i>
                <h3>Perawatan Lainnya</h3>
                <p>Hair Removal IPL,
                    Auto Needle Rambut,
                    Gurah Pernafasan,
                    Totok Aura dan
                    Hipnotherapy</p>
            </div>

        </div>

    </section>

    <!-- services section ends -->



    <!-- doctors section starts  -->

    <section class="doctors" id="doctors">

        <h1 class="heading"> Promo </h1>

        <div class="box-container">

            <div class="box">
                <img src="image/wajah.jpeg" alt="">
                <h3>Perawatan Wajah</h3>
                <span>Diskon 10%</span>
                <h3><del style="color:red">Rp.200.000</del> <br>Rp.180.000</h3>
            </div>

            <div class="box">
                <img src="image/akupuntur.jpeg" alt="">
                <h3>Therapy Akupuntur</h3>
                <span>Diskon 15%</span>
                <h3><del style="color:red">Rp.250.000</del> <br>Rp.212.500</h3>
            </div>

            <div class="box">
                <img src="image/bekam.jpeg" alt="">
                <h3>Perawatan Badan</h3>
                <span>Diskon 10%</span>
                <h3><del style="color:red">Rp.180.000</del> <br>Rp.162.000</h3>
            </div>

            <div class="box">
                <img src="image/doc-4.jpg" alt="">
                <h3>Perawatan Khusus Wanita</h3>
                <span>Diskon 20%</span>
                <h3><del style="color:red">Rp.220.000</del> <br>Rp.176.000</h3>
            </div>

            <div class="box">
                <img src="image/totok.jpeg" alt="">
                <h3>Perawatan Lainnya</h3>
                <span>Diskon 10%</span>
                <h3><del style="color:red">Rp.150.000</del> <br>Rp.135.000</h3>
            </div>


        </div>

        </div>

    </section>

    <!-- doctors section ends -->

    <!-- appointmenting section starts   -->

    <section class="appointment" id="appointment">

        <h1 class="heading"> <span>Daftar</span> Sekarang </h1>

        <div class="row">

            <div class="image">
                <img src="image/appointment-img.svg" alt="">
            </div>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <?php
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<p class ="message">' . $message . '</p>';
                    }
                }
                ?>
                <h3>Buat Pendaftaran</h3>
                <input type="text" name="name" placeholder="Nama" class="box">
                <input type="number" name="number" placeholder="Nomor Handphone" class="box">
                <input type="email" name="email" placeholder="email" class="box">
                <select name="perawatan" id="perawatan" class="box">
                    <option value="Theraphy Akupunktur">Theraphy Akupunktur</option>
                    <option value="Perawatan Wajah">Perawatan Wajah</option>
                    <option value="Perawatan Badan">Perawatan Badan</option>
                    <option value="Perawatan Khusus Wanita">Perawatan Khusus Wanita</option>
                    <option value="Perawatan Lainnya">Perawatan Lainnya</option>
                </select>
                <input type="date" name="date" id="tanggal" class="box">
                <input type="submit" name="submit" value="Daftar Sekarang" class="btn">
            </form>

        </div>

    </section>

    <!-- appointmenting section ends -->

    <!-- review section starts  -->

    <section class="review" id="review">

        <h1 class="heading"> Review </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-user-circle" style="font-size:90px;color:white"></i>
                <h3>@Kletapaskalia</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Saat kunjungan ke klinik Bu Dewi, saya berumur 29 tahun dengan keluhan sakit
                    pinggang dan sedang dalam kondisi hamil. <br>
                    Sakit pinggang saya alami dikarenakan salah gerakan dan jarang melakukan stretching tiap hari.
                    Keluhan sudah saya alami selama hampir satu bulan. Akhirnya saya coba mencari terapis akupuntur di
                    google dan saya menemukan Klinik ini dengan review yang bagus.<br>
                    Ternyata betul review2 tersebut. Hanya dengan 2 kali kunjungan saya sudah bisa beraktivitas secara
                    normal. Tindakan akupuntur yang diberikan Bu Dewi sangat aman dan tidak menyakitkan, hanya
                    ditusuk2 sebentar menyesuaikan dengan kondisi hamil saya yang membutuhkan perhatian khusus dibanding
                    kondisi normal.Terimakasih Bu Dewi. Penjelasan dan treatment yang diberikan sangat baik dan
                    beliau tidak pelit2 ilmu. Enak diajak diskusi dan menjawab setiap keluhan yang saya alami. Next time
                    saya mau bawa ortu saya kembali berobat di klinik Bu Dewi.</p>
            </div>

            <div class="box">
                <i class="fas fa-user-circle" style="font-size:90px;color:white"></i>
                <h3>@nila_nandini</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Saya pertama kali ke Klinik Praktik Mandiri Akupunktur Terapis Dokter Dewi,
                    pada bulan Juni 2022, atas rekomendasi teman saya untuk mengecek kondisi kesehatan saya.
                    Saya merasa mengalami kondisi hormonal yang kurang stabil. Hasil diagnosa dari pengecekan awal, saya
                    ada gangguan di liver dan jantung.<br>
                    Sejak saat itu saya mulai rutin melakukan treatment akupunktur setiap minggu dengan Dokter Dewi
                    dan gangguan kesehatan yang saya rasakan berkurang dan menjadi lebih sehat serta bugar.<br>
                    Pada awal Oktober 2022, saya terpapar virus Covid 19. Alhamdulillah karena saya rutin akupuntur,
                    pada hari kelima saya sudah negatif. Akupunktur membantu stamina tubuh saya.<br>
                    Sukses selalu untuk Klinik Klinik Praktik Mandiri Akupunktur Terapis Dokter Dewi,
                    dan kepada Bu Dewi semoga selalu menjadi berkat bagi kesehatan banyak orang
                    yang membutuhkan.</p>
            </div>

            <div class="box">
                <i class="fas fa-user-circle" style="font-size:90px;color:white"></i>
                <h3>@jenipatty</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Saya pertama hanya menemani mama, penasaran dgn hasil yg di bangga2kan mama. Kebetulan
                    masalah saya adalah hormonal imbalance krn over work dan kurang tidur.<br>
                    Pertama tentu saja seram melihat jarum yg banyak ditusukkan ke berbagai spot yg bermasalah. Tp
                    ternyata rasa nya tdk sesakit yg dibayangkan, justru malah benar bikin ketagihan. Yg paling cepat
                    terlihat adalah kualitas tidur dan immunity yg jauh meningkat. Menstrual cycle saya jadi jauh lebih
                    reguler dan tanpa disertai keram yg mengganggu.<br>
                    Saya sudah menjadi pasien selama hampir 1 tahun dan terus merekomendasikan Klinik Vikrist kpd semua
                    teman saya yg punya keluhan kesehatan dan kecantikan
                </p>
            </div>

        </div>

    </section>

    <!-- review section ends -->

    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="#home"> <i class="fas fa-chevron-right"></i> home </a>
                <a href="#about"> <i class="fas fa-chevron-right"></i> about </a>
                <a href="#services"> <i class="fas fa-chevron-right"></i> services </a>
                <a href="#doctors"> <i class="fas fa-chevron-right"></i> promo </a>
                <a href="#appointment"> <i class="fas fa-chevron-right"></i> appointment </a>
                <a href="#review"> <i class="fas fa-chevron-right"></i> review </a>
            </div>

            <div class="box">
                <h3>our services</h3>
                <a href="#"> <i class="fas fa-chevron-right"></i> Theraphy Akupunktur </a>
                <a href="#"> <i class="fas fa-chevron-right"></i> Perawatan Wajah </a>
                <a href="#"> <i class="fas fa-chevron-right"></i> Perawatan Badan </a>
                <a href="#"> <i class="fas fa-chevron-right"></i> Perawatan Khusus Wanita </a>
                <a href="#"> <i class="fas fa-chevron-right"></i> Perawatan Lainnya </a>
            </div>

            <div class="box">
                <h3>appointment info</h3>
                <a href="#"> <i class="fas fa-phone"></i> +8801688238801 </a>
                <a href="#"> <i class="fas fa-phone"></i> +8801782546978 </a>
                <a href="#"> <i class="fas fa-envelope"></i> akupunturdewi@gmail.com </a>
                <a href="#"> <i class="fas fa-envelope"></i> akupunturdewi@gmail.com </a>
                <a href="#"> <i class="fas fa-map-marker-alt"></i> Bogor, Jawa Barat </a>
            </div>

            <div class="box">
                <h3>follow us</h3>
                <a href="#"> <i class="fab fa-faceappointment-f"></i> faceappointment </a>
                <a href="https://twitter.com/?lang=en-id"> <i class="fab fa-twitter"></i> twitter </a>
                <a href="https://www.instagram.com/accounts/login/"> <i class="fab fa-instagram"></i> instagram </a>
                <a href="https://www.linkedin.com/"> <i class="fab fa-linkedin"></i> linkedin </a>
                <a href="https://id.pinterest.com/"> <i class="fab fa-pinterest"></i> pinterest </a>
            </div>

        </div>

        <div class="credit"> created by <span>Kelompok 13</span> | all rights reserved </div>

    </section>

    <!-- footer section ends -->


    <!-- js file link  -->
    <script src="js/script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tanggal = document.getElementById('tanggal');
            tanggal.addEventListener('input', function () {
                var tanggalPilihan = new Date(this.value);
                var hari = tanggalPilihan.toISOString().split('T')[0]; // Mengambil format tanggal (YYYY-MM-DD)

                var dataDariDatabase = <?php echo json_encode(dataDariDatabase); ?>;

                // Memeriksa apakah tanggal yang dipilih ada dalam database
                if (dataDariDatabase.includes(hari)) {
                    alert('Tanggal sudah ada dalam database, silakan pilih tanggal lain.');
                    this.value = ''; // Hapus nilai jika tidak valid
                }
            });
        });
    </script>
</body>

</html>