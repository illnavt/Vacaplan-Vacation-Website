<?php
include "koneksi.php";
include "kode.php";

if (isset($_POST['submit-book'])) {
    $destination = $_POST['destination'];
    $departure_date = $_POST['date_start_dep'];
    $days = (int) $_POST['date_start_ret'];

    // Query data destinasi berdasarkan provinsi yang dipilih
    $query = "SELECT * FROM tempat_wisata WHERE provinsi = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("s", $destination);
    $stmt->execute();
    $result = $stmt->get_result();

    $query2 = "SELECT * FROM hotel WHERE provinsi = ?";
    $stmt2 = $koneksi->prepare($query2);
    $stmt2->bind_param("s", $destination);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $query3 = "SELECT * FROM penerbangan WHERE provinsi = ?";
    $stmt3 = $koneksi->prepare($query3);
    $stmt3->bind_param("s", $destination);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    $query4 = "SELECT * FROM jalur_darat WHERE provinsi = ?";
    $stmt4 = $koneksi->prepare($query4);
    $stmt4->bind_param("s", $destination);
    $stmt4->execute();
    $result4 = $stmt4->get_result();

    $query5 = "SELECT * FROM jalur_air WHERE provinsi = ?";
    $stmt5 = $koneksi->prepare($query5);
    $stmt5->bind_param("s", $destination);
    $stmt5->execute();
    $result5 = $stmt5->get_result();

    if (!$result || !$result2 || !$result3 || !$result4 || !$result5) {
        die("Query error: " . $koneksi->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unity of &mdash; Travel</title>
    <link href="images/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/respond.min.js"></script>
    <link rel="stylesheet" href="css/fontawesome.all.min.css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <link rel="shortcut icon" href="images/logo.png">

    <link rel="stylesheet" href="css/booking.css">
</head>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .kotak_tengah {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100px;
        /* width: 290px; */
        width: 80%;
        background-color: #D9D9D9;
        border-radius: 10px;
    }

    .selo {
        width: 300px;
        height: 30px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        /* color: black; */
        font-weight: bold;
        font-size: 20;
    }

    .min-h-screen {
        min-height: 100vh;
        width: 100%;
        background-color: #f5f5f5;
        /* Warna putih susu */
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        /* 5 units of gap */
        padding: 1.25rem;
        /* 5 units of padding */
        padding-top: 8rem;
        /* 32 units of top padding */
    }

    @media (min-width: 1024px) {

        /* untuk layar lg dan lebih besar */
        .lg\:gap-x-6 {
            gap: 1.5rem;
            /* 6 units of gap */
        }
    }

    @media (min-width: 1280px) {

        /* untuk layar xl dan lebih besar */
        .xl\:gap-x-28 {
            gap: 7rem;
            /* 28 units of   gap */
        }
    }
    .gtco-nav {
            background-image: url('images/pesawat.jpg');
            padding: 20px 0;
        }
        .gtco-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .menu-1 ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        .menu-1 li {
            margin-left: 20px;
        }
        .menu-1 a {
            text-decoration: none;
            color: #fff;
        }
        .has-dropdown ul {
            display: none;
            position: absolute;
            background: #fff;
            color: #000;
            list-style: none;
            padding: 10px;
        }
        .has-dropdown:hover ul {
            display: block;
        }
        .dropdown li {
            margin: 10px 0;
        }

        /* Styles for hamburger menu */
        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
        }
        .hamburger div {
            width: 25px;
            height: 3px;
            background-color: #fff;
            margin: 5px 0;
        }
        .menu-1 {
            display: flex;
        }
        @media (max-width: 768px) {
            .menu-1 {
                display: none;
                flex-direction: column;
                width: 100%;
                background: rgba(0, 0, 0, 0.8);
                position: absolute;
                top: 50px;
                left: 0;
            }
            .menu-1 ul {
                flex-direction: column;
                align-items: center;
            }
            .menu-1 li {
                margin: 10px 0;
            }
            .hamburger {
                display: flex;
            }
        }
</style>

<body>
    <div class="gtco-loader"></div>
    <div id="page">
        <div class="page-inner">
            <nav class="gtco-nav" role="navigation">
                <div class="gtco-container">
                    <div>
                        <?php
                        if (isset($_SESSION['session_username'])) {
                            echo '<div id="gtco-logo"><a href="booking.php">Vacaplan <em>.</em></a></div>';
                        } else {
                            echo '<div id="gtco-logo"><a href="index.php">Vacaplan <em>.</em></a></div>';
                        }
                        ?>
                    </div>
                    <div class="hamburger" onclick="toggleMenu()">
                        
                    </div>
                    <div class="menu-1">
                        <ul>
                            <?php
                            if (isset($_SESSION['session_username'])) {
                                $username = $_SESSION['session_username'];
                                echo '<li><a href="booking.php">Book Now</a></li>';
                            } else {
                                echo '<li><a href="login.php">Book Now</a></li>';
                            }
                            ?>
                            <li><a href="#about">About Us</a></li>
                            <?php
                            if (isset($_SESSION['session_username'])) {
                                echo '<li class="has-dropdown">
                                        <a href="#">Profile</a>
                                        <ul class="dropdown">
                                            <li align="center">' . $username . '</li>
                                            <li align="center"><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>';
                            } else {
                                echo '<li><a href="login.php">Login</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    <main class="font-roboto">
        <div class="min-h-screen bg-[#D9D9D9] lg:gap-x-6 xl:gap-x-28">
            <div class="container">
                <div class="kotak_tengah">
                    <p class="selo"><?php echo $destination ?></p>
                    <p style="color: black; font-weight: bold;"><?php echo $days . " Hari"?></p>
                </div>
            </div>

            <div class="w-full flex flex-col gap-y-6 gap-x-6 md:grid md:grid-cols-2 lg:grid-cols-3">

                <!-- Transport -->
                <div class="flex flex-col gap-y-5">
                    <div class="text-center text-white text-2xl font-bold flex flex-col items-center mb-2 md:text-5xl">
                        <h1 class="text-black">TRANSPORT</h1>
                        <hr class="w-28 border-gray-400 border-t-2">
                    </div>
                    <?php
                    $hasData = false;
                    if ($result3->num_rows > 0 || $result4->num_rows > 0 || $result5->num_rows > 0) {
                        $hasData = true;
                        while ($row = $result3->fetch_assoc()): 
                        ?>
                            <div>
                                <input type="radio" name="transport" id="id_transport_<?php echo $row['id']; ?>"
                                    class="hidden peer" data-harga="<?php echo $row['harga']; ?>">
                                <div
                                    class="w-full transition-all item min-h-60 bg-[#525e61] p-4 flex flex-col items-center rounded-t-md gap-y-4 lg:p-4 lg:gap-y-4 lg:min-h-28 peer-checked:bg-[#467580] peer-checked:text-white peer-checked:ring-white peer-checked:ring-2">
                                    <div class="card-image"
                                        style="background-image: url('<?php echo $row['gambar']; ?>'); background-size: cover; background-position: center; width: 100%; height: 180px;">
                                    </div>
                                    <div class="text-center w-full">
                                        <h1 style="margin-bottom: 10px;" class="text-white font-bold text-3xl">
                                            <?php echo $row['nama_maskapai']; ?>
                                        </h1>
                                        <p class="text-white">Tipe Jalur: Udara</p>
                                        <p class="text-white text-left">Harga:
                                            <?php echo $row['harga'] == 0 ? "Gratis" : "Rp. " . number_format($row['harga'], 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                    <label for="id_transport_<?php echo $row['id']; ?>"
                                        class="w-full text-black bg-white hover:bg-[#f3f3f3] focus:outline-none focus:ring-4 focus:ring-[#f3f3f3] peer-checked:bg-[#A3A3A3] font-medium rounded-md text-md px-5 py-1 text-center">PILIH</label>
                                </div>
                            </div>
                        <?php 
                        endwhile;

                        while ($row = $result4->fetch_assoc()): ?>
                            <div>
                                <input type="radio" name="transport" id="id_transport_<?php echo $row['id']; ?>"
                                    class="hidden peer" data-harga="<?php echo $row['harga']; ?>">
                                <div
                                    class="w-full transition-all item min-h-60 bg-[#525e61] p-4 flex flex-col items-center rounded-t-md gap-y-4 lg:p-4 lg:gap-y-4 lg:min-h-28 peer-checked:bg-[#467580] peer-checked:text-white peer-checked:ring-white peer-checked:ring-2">
                                    <div class="card-image"
                                        style="background-image: url('<?php echo $row['gambar']; ?>'); background-size: cover; background-position: center; width: 100%; height: 180px;">
                                    </div>
                                    <div class="text-center w-full">
                                        <h1 style="margin-bottom: 10px;" class="text-white font-bold text-3xl">
                                            <?php echo $row['nama_transportasi']; ?>
                                        </h1>
                                        <p class="text-white">Tipe Jalur: Darat</p>
                                        <p class="text-white text-left">Harga:
                                            <?php echo $row['harga'] == 0 ? "Gratis" : "Rp. " . number_format($row['harga'], 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                    <label for="id_transport_<?php echo $row['id']; ?>"
                                        class="w-full text-black bg-white hover:bg-[#f3f3f3] focus:outline-none focus:ring-4 focus:ring-[#f3f3f3] peer-checked:bg-[#A3A3A3] font-medium rounded-md text-md px-5 py-1 text-center">PILIH</label>
                                </div>
                            </div>
                        <?php endwhile;

                        while ($row = $result5->fetch_assoc()): ?>
                            <div>
                                <input type="radio" name="transport" id="id_transport_<?php echo $row['id']; ?>"
                                    class="hidden peer" data-harga="<?php echo $row['harga']; ?>">
                                <div
                                    class="w-full transition-all item min-h-60 bg-[#525e61] p-4 flex flex-col items-center rounded-t-md gap-y-4 lg:p-4 lg:gap-y-4 lg:min-h-28 peer-checked:bg-[#467580] peer-checked:text-white peer-checked:ring-white peer-checked:ring-2">
                                    <div class="card-image"
                                        style="background-image: url('<?php echo $row['gambar']; ?>'); background-size: cover; background-position: center; width: 100%; height: 180px;">
                                    </div>
                                    <div class="text-center w-full">
                                        <h1 style="margin-bottom: 10px;" class="text-white font-bold text-3xl">
                                            <?php echo $row['nama_transportasi']; ?>
                                        </h1>
                                        <p class="text-white">Tipe Jalur: Air</p>
                                        <p class="text-white text-left">Harga:
                                            <?php echo $row['harga'] == 0 ? "Gratis" : "Rp. " . number_format($row['harga'], 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                    <label for="id_transport_<?php echo $row['id']; ?>"
                                        class="w-full text-black bg-white hover:bg-[#f3f3f3] focus:outline-none focus:ring-4 focus:ring-[#f3f3f3] peer-checked:bg-[#A3A3A3] font-medium rounded-md text-md px-5 py-1 text-center">PILIH</label>
                                </div>
                            </div>
                        <?php endwhile;
                    }
                    if (!$hasData): ?>
                        <p class="text-black text-center">Tidak ada data transportasi yang ditemukan.</p>
                    <?php endif; ?>
                </div>


                <!-- Tempat Wisata -->
                <div class="flex flex-col gap-y-5">
                    <div class="text-center text-white text-2xl font-bold flex flex-col items-center mb-2 md:text-5xl">
                        <h1 class="text-black">TEMPAT WISATA</h1>
                        <hr class="w-28 border-gray-400 border-t-2">
                    </div>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div>
                                <input type="radio" name="wisata" id="id_wisata_<?php echo $row['id']; ?>" class="hidden peer"
                                    data-harga="<?php echo $row['harga']; ?>">
                                <div
                                    class="w-full transition-all item min-h-60 bg-[#525e61] p-4 flex flex-col items-center rounded-t-md gap-y-4 lg:p-4 lg:gap-y-4 lg:min-h-28 peer-checked:bg-[#467580] peer-checked:text-white peer-checked:ring-white peer-checked:ring-2">
                                    <div class="card-image"
                                        style="background-image: url('<?php echo $row['gambar']; ?>'); background-size: cover; background-position: center; width: 100%; height: 180px;">
                                    </div>
                                    <div class="text-center w-full">
                                        <h1 style="margin-bottom: 10px;" class="text-white font-bold text-3xl">
                                            <?php echo $row['nama_wisata']; ?>
                                        </h1>
                                        <!-- <p>
                                            k
                                        </p> -->
                                        <br>
                                        <p class="text-white text-left">
                                            <?php
                                            if ($row['harga'] == 0) {
                                                echo "Gratis";
                                            } else {
                                                echo "Harga: Rp. " . number_format($row['harga'], 0, ',', '.');
                                            }
                                            ?>
                                        </p>

                                    </div>
                                    <label for="id_wisata_<?php echo $row['id']; ?>"
                                        class="w-full text-black bg-white hover:bg-[#f3f3f3] focus:outline-none focus:ring-4 focus:ring-[#f3f3f3] peer-checked:bg-[#A3A3A3] font-medium rounded-md text-md px-5 py-1 text-center">PILIH</label>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-black text-center">Tidak ada data tempat wisata yang ditemukan.</p>
                    <?php endif; ?>
                </div>


                <!-- Hotel Section -->
                <div class="flex flex-col gap-y-5">
                    <div class="text-center text-white text-2xl font-bold flex flex-col items-center mb-2 md:text-5xl">
                        <h1 class="text-black">HOTEL</h1>
                        <hr class="w-28 border-gray-400 border-t-2">
                    </div>
                    <?php if ($result2->num_rows > 0): ?>
                        <?php while ($row = $result2->fetch_assoc()): ?>
                            <?php $total_harga_hotel = $row['harga'] * $days; ?>
                            <div>
                                <input type="radio" name="hotel" id="id_hotel_<?php echo $row['id']; ?>" class="hidden peer"
                                    data-harga="<?php echo $total_harga_hotel; ?>">
                                <div
                                    class="w-full transition-all item min-h-60 bg-[#525e61] p-4 flex flex-col items-center rounded-t-md gap-y-4 lg:p-4 lg:gap-y-4 lg:min-h-28 peer-checked:bg-[#467580] peer-checked:text-white group/hotel peer-checked:ring-white peer-checked:ring-2 peer">
                                    <div class="card-image"
                                        style="background-image: url('<?php echo $row['gambar']; ?>'); background-size: cover; background-position: center; width: 100%; height: 180px;">
                                    </div>
                                    <div class="text-center w-full">
                                        <h1 style="margin-bottom: 10px;" class="text-white font-bold text-3xl">
                                            <?php echo $row['nama_hotel']; ?>
                                        </h1>
                                        <p class="text-left">
                                            <?php
                                            $grade = $row['grade'];
                                            $starColor = "gold"; // Warna bintang
                                            $emptyStarColor = "gray"; // Warna bintang kosong
                                    
                                            // Tampilkan bintang sesuai dengan nilai grade
                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $grade) {
                                                    // Tampilkan bintang penuh
                                                    echo '<i class="fas fa-star" style="color: ' . $starColor . '"></i>';
                                                } else {
                                                    // Tampilkan bintang kosong
                                                    echo '<i class="far fa-star" style="color: ' . $emptyStarColor . '"></i>';
                                                }
                                            }
                                            ?>
                                        </p>
                                        <p class="text-white text-left">Harga: Rp.
                                            <?php echo number_format($total_harga_hotel, 0, ',', '.'); ?>
                                        </p>
                                    </div>
                                    <label for="id_hotel_<?php echo $row['id']; ?>"
                                        class="w-full text-black bg-white hover:bg-[#f3f3f3] peer-checked:bg-[#3a3a3a] focus:outline-none focus:ring-4 focus:ring-focus-color font-medium rounded-md text-md px-5 py-1 text-center">PILIH</label>
                                </div>

                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="text-black text-center">Tidak ada data hotel yang ditemukan.</p>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </main>
    </div>

    <!-- Fungsi Dalam -->
    <div class="fixed bottom-0 w-full bg-white min-h-32 border-t-2 border-t-blue-600 z-[999999999]"
        id="konfirm_container" hidden>
        <button type="button" id="button_close_confirm"
            class="absolute bg-red-500 w-10 h-10 rounded-full border-5 border-purple-500 right-10 top-2 text-white flex justify-center items-center">
            <i class="fa fa-xmark"></i>
        </button>
        <div class="flex w-full justify-between p-5 px-36">
            <div class="flex flex-col">
                <p class="text-md font-bold">Total :</p>
                <p class="text-4xl font-bold">Rp. <span id="total_harga"></span></p>
            </div>
            <!-- <div>
                <button class="bg-purple-600 px-10 py-5 rounded-md text-white">Konfirmasi</button>
            </div> -->
        </div>
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>

    <script src="js/jquery.3.7.1.min.js"></script>
    <script src="js/jquery-migrate-3.4.1.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/fontawesome.all.min.js"></script>
    <script src="js/script.js"></script>

    <script>
        $(document).ready(function () {
            $('input[name="wisata"], input[name="hotel"], input[name="transport"]').change(function () {
                let totalHarga = 0;
                let hargaWisata = $('input[name="wisata"]:checked').data('harga') || 0;
                let hargaHotel = $('input[name="hotel"]:checked').data('harga') || 0;
                let hargaTransport = $('input[name="transport"]:checked').data('harga') || 0;
                totalHarga = hargaWisata + hargaHotel + hargaTransport;

                $('#total_harga').text(totalHarga.toLocaleString('id-ID'));
                $('#konfirm_container').show();
            });

            $('#button_close_confirm').click(function () {
                $('#konfirm_container').hide();
            });
        });

        function toggleMenu() {
            const menu = document.querySelector('.menu-1');
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>
</body>

</html>

<?php
// Tutup koneksi ke database
$stmt->close();
$stmt2->close();
$koneksi->close();
?>