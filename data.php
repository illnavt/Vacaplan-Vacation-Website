<?php
include ("kode.php");

$tblhotel = "SELECT * FROM hotel";
$result_hotel = $koneksi->query($tblhotel);
$tblwisata = "SELECT * FROM tempat_wisata";
$result_wisata = $koneksi->query($tblwisata);
$tbludara = "SELECT * FROM penerbangan";
$result_udara = $koneksi->query($tbludara);
$tbldarat = "SELECT * FROM jalur_darat";
$result_darat = $koneksi->query($tbldarat);
$tblair = "SELECT * FROM jalur_air"; // Perbaiki nama tabel disini
$result_air = $koneksi->query($tblair);

// Check apakah query berhasil dijalankan
if (!$result_hotel || !$result_wisata || !$result_udara || !$result_darat || !$result_air) {
    die("Query Error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="images/logo.png">
    <title>Admin Dashboard</title>
</head>
<style>
    table,
    tr,
    td {
        border: 1px solid black;
    }


</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const budgetInput = document.getElementById('budget');

        budgetInput.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '');

            this.value = formatCurrency(this.value);
        });

        function formatCurrency(value) {
            let formattedValue = '';

            while (value.length > 3) {
                formattedValue = '.' + value.slice(-3) + formattedValue;
                value = value.slice(0, -3);
            }

            if (value) {
                formattedValue = value + formattedValue;
            }

            formattedValue = 'Rp. ' + formattedValue;

            return formattedValue;
        }
    });
    function toggleTables() {
        var selectBox = document.getElementById("selectData");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("hotelTable").style.display = "none";
        document.getElementById("wisataTable").style.display = "none";
        document.getElementById("transportTable").style.display = "none";

        if (selectedValue === "hotel") {
            document.getElementById("hotelTable").style.display = "block";
        } else if (selectedValue === "wisata") {
            document.getElementById("wisataTable").style.display = "block";
        } else if (selectedValue === "transport") {
            document.getElementById("transportTable").style.display = "block";
        }
    }

    function toggleTransport() {
        var selectBox = document.getElementById("selectTransport");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;

        document.getElementById("udaraTable").style.display = "none";
        document.getElementById("daratTable").style.display = "none";
        document.getElementById("airTable").style.display = "none";

        if (selectedValue === "udara") {
            document.getElementById("udaraTable").style.display = "block";
        } else if (selectedValue === "darat") {
            document.getElementById("daratTable").style.display = "block";
        } else if (selectedValue === "air") {
            document.getElementById("airTable").style.display = "block";
        }
    }

</script>
<style>
    :root {
        --arrow-bg: black;
        --arrow-icon: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg);
        --option-bg: black;
        --select-bg: rgba(255, 255, 255, 0.2);
    }

    * {
        box-sizing: border-box;
    }

    /* <select> styles */
    select {
        /* Reset */
        appearance: none;
        border: 0;
        outline: 0;
        font: inherit;
        /* Personalize */
        width: 20rem;
        padding: 1rem 4rem 1rem 1rem;
        background: var(--arrow-icon) no-repeat right 0.8em center / 1.4em,
            linear-gradient(to left, var(--arrow-bg) 3em, var(--select-bg) 3em);
        color: black;
        text-align: center;
        border-radius: 0.25em;
        box-shadow: 0 0 1em 0 rgba(0, 0, 0, 0.2);
        cursor: pointer;

        /* Remove IE arrow */
        &::-ms-expand {
            display: none;
        }

        /* Remove focus outline */
        &:focus {
            outline: none;
        }

        /* <option> colors */
        option {
            color: inherit;
            background-color: var(--option-bg);
        }
    }
</style>
<body>
    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <img src="assets/img/img_bg_1.jpg" alt="" class="header__img">

            <a href="#" class="header__logo">VacaPlan</a>

            <div class="header__search">
                <input type="search" placeholder="<?php
                echo $fullname;
                ?>" class="header__input" disabled>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="#" class="nav__link nav__logo">
                    <img src="assets/img/logo.png" alt="Logo" class="small-logo">
                    <span class="nav__logo-name">VacaPlan</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">menu</h3>

                        <a href="dashboard.php" class="nav__link">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <!-- <a href="account.php" class="nav__link">
                            <i class='bx bx-user nav__icon'></i>
                            <span class="nav__name">Account</span>
                        </a> -->

                        <a href="data.php" class="nav__link">
                            <i class='bx bx-data nav__icon active'></i>
                            <span class="nav__name">Data</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="" class="nav__link">
                                <i class='bx bx-box nav__icon'></i>
                                <span class="nav__name">Insert Data</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="data_transport.php" class="nav__dropdown-item">Transport</a>
                                    <a href="data_wisata.php" class="nav__dropdown-item">Wisata</a>
                                    <a href="data_hotel.php" class="nav__dropdown-item">Hotel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="logout.php" class="nav__link nav__logout">
                <i class='bx bx-log-out nav__icon'></i>
                <span class="nav__name">Log Out</span>
            </a>
        </nav>
    </div>

    <!--========== CONTENTS ==========-->

    <section>
        <div align="center">
            <h1>Data</h1>
            <form id="myForm" method="POST">
                <select id="selectData" onchange="toggleTables()">
                    <option value="" selected disabled>-- Select --</option>
                    <option value="hotel">Hotel</option>
                    <option value="wisata">Tempat Wisata</option>
                    <option value="transport">Transport</option>
                </select>
            </form>

            <!-- Hotel -->
            <div id="hotelTable" style="display:none;">
                <h1>Hotel Data</h1>
                <table>
                    <tr align="center">
                        <td>No</td>
                        <td>Nama Hotel</td>
                        <td>Grade</td>
                        <td>Provinsi</td>
                        <td>Kota</td>
                        <td>Harga</td>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = $result_hotel->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td align='center'>" . $no . "</td>";
                        echo "<td>" . $row['nama_hotel'] . "</td>";
                        echo "<td align='center'>" . $row['grade'] . "</td>";
                        echo "<td>" . $row['provinsi'] . "</td>";
                        echo "<td>" . $row['kota'] . "</td>";
                        echo "<td>" . "Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>

            <!-- Wisata -->
            <div id="wisataTable" style="display:none;">
                <h2>Wisata Data</h2>
                <table>
                    <tr align="center">
                        <td>No</td>
                        <td>Nama Wisata</td>
                        <td>Provinsi</td>
                        <td>Kota</td>
                        <td>Harga</td>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = $result_wisata->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td align='center'>" . $no . "</td>";
                        echo "<td>" . $row['nama_wisata'] . "</td>";
                        echo "<td>" . $row['provinsi'] . "</td>";
                        echo "<td>" . $row['kota'] . "</td>";
                        echo "<td>" . "Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
                </table>
            </div>

            <!-- Transport -->
            <div id="transportTable" style="display:none;">
                <h1>Transport Data</h1>
                <form id="transportForm" method="POST">
                    <select id="selectTransport" onchange="toggleTransport()">
                        <option value="" selected disabled>-- Select --</option>
                        <option value="udara">Udara</option>
                        <option value="darat">Darat</option>
                        <option value="air">Air</option>
                    </select>
                </form>
                <!-- Transport Tables -->
                <div id="udaraTable" style="display:none;">
                    <h2>Transportasi Udara</h2>
                    <table>
                        <tr align="center">
                            <td>No</td>
                            <td>Nama Maskapai</td>
                            <td>Provinsi</td>
                            <td>Kota</td>
                            <td>Harga</td>
                        </tr>
                        <?php
                        $no = 1;
                        while ($row = $result_udara->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'>" . $no . "</td>";
                            echo "<td>" . $row['nama_maskapai'] . "</td>";
                            echo "<td>" . $row['provinsi'] . "</td>";
                            echo "<td>" . $row['kota_tujuan'] . "</td>";
                            echo "<td>" . "Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </table>
                </div>
                <div id="daratTable" style="display:none;">
                    <h2>Transportasi Darat</h2>
                    <table>
                        <tr align="center">
                            <td>No</td>
                            <td>Nama Transportasi</td>
                            <td>Provinsi</td>
                            <td>Kota</td>
                            <td>Harga</td>
                        </tr>
                        <?php
                        $no = 1;
                        while ($row = $result_darat->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'>" . $no . "</td>";
                            echo "<td>" . $row['nama_transportasi'] . "</td>";
                            echo "<td>" . $row['provinsi'] . "</td>";
                            echo "<td>" . $row['kota_tujuan'] . "</td>";
                            echo "<td>" . "Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </table>
                </div>
                <div id="airTable" style="display:none;">
                    <h2>Transportasi Air</h2>
                    <table>
                        <tr align="center">
                            <td>No</td>
                            <td>Nama Transportasi</td>
                            <td>Provinsi</td>
                            <td>Kota</td>
                            <td>Harga</td>
                        </tr>
                        <?php
                        $no = 1;
                        while ($row = $result_air->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'>" . $no . "</td>";
                            echo "<td>" . $row['nama_transportasi'] . "</td>";
                            echo "<td>" . $row['provinsi'] . "</td>";
                            echo "<td>" . $row['kota_tujuan'] . "</td>";
                            echo "<td>" . "Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </main>

    <!--========== MAIN JS ==========-->

    <script src="assets/js/main.js"></script>
</body>

</html>