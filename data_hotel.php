<?php
include ("kode.php");

$success_message = "";

if (isset($_POST['data'])) {
    // Ambil data dari form
    $nama_hotel = $_POST['nama_hotel'];
    $link = $_POST['link'];
    $grade = $_POST['bintang'];
    $provinsi = $_POST['provinsi'];
    $kota = $_POST['kota'];
    $harga = $_POST['harga'];

    // Hapus karakter non-numeric dari harga
    $harga = preg_replace("/[^0-9]/", "", $harga);

    // Using prepared statements to prevent SQL injection
    $stmt = $koneksi->prepare("INSERT INTO hotel (nama_hotel, gambar, grade, provinsi, kota, harga) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama_hotel, $link, $grade, $provinsi, $kota, $harga);

    if ($stmt->execute()) {
        $success_message = "Data berhasil disimpan";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $koneksi->close();
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

    function showAlertAndRedirect(message, redirectUrl) {
        if (message) {
            alert(message);
            window.location.href = redirectUrl;
        }
    }
</script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:200');

    html,
    body {
        height: 70%;
        background-color: #F9F6FD;
    }

    table {
        width: 80%;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        background: transparent;
    }

    #box {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 700px;
        height: 350px;
        color: black;
        font-family: 'Raleway';
        font-size: 2.5rem;
    }

    .gradient-border {
        --borderWidth: 5px;
        background: #F9F6FD;
        position: relative;
        border-radius: var(--borderWidth);
    }

    .gradient-border:after {
        content: '';
        position: absolute;
        height: calc(100% + var(--borderWidth) * 2);
        width: calc(100% + var(--borderWidth) * 2);
        /* background: linear-gradient(60deg, #f79533, #f37055, #ef4e7b, #a166ab, #5073b8, #1098ad, #07b39b, #6fba82); */
        background: linear-gradient(60deg, #ffffff, #dcdcdc, #a9a9a9, #808080, #696969);
        border-radius: calc(2 * var(--borderWidth));
        z-index: -1;
        animation: animatedgradient 3s ease alternate infinite;
        background-size: 300% 300%;
    }


    @keyframes animatedgradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    input[type=text],
    input[type=url],
    input[type=number],
    select {
        width: 100%;
        height: 30px;
        background: transparent;
        border: 2px solid #58555E;
        border-radius: 10px;
        color: #black;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
    }

    .tombol {
        margin-top: 20px;
        background-color: #f0f0f0;
        border: 2px solid #58555E;
        border-radius: 5px;
        color: #58555E;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease, border-radius 0.3s ease, color 0.3s ease, width 0.3s ease, height 0.3s ease;
        height: 50px;
        border-radius: 15px;
        width: 100%;
    }

    .tombol:hover {
        background-color: #e0e0e0;
        color: #404040;
        border-radius: 5px;
    }
</style>

<body onload="showAlertAndRedirect('<?php echo $success_message; ?>', 'data.php')">
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
                            <i class='bx bx-data nav__icon'></i>
                            <span class="nav__name">Data</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="" class="nav__link">
                                <i class='bx bx-box nav__icon active'></i>
                                <span class="nav__name">Insert Data</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="data_transport.php" class="nav__dropdown-item">Transport</a>
                                    <a href="data_wisata.php" class="nav__dropdown-item">Wisata</a>
                                    <a href="" class="nav__dropdown-item active">Hotel</a>
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
    <main>
        <section>
            <div>
                <form action="" method="POST">
                    <div class="gradient-border" id="box">
                        <table style="width:100%; font-size: 18px;">
                            <tr>
                                <th style="width: 28%;">Nama Hotel</th>
                                <td><input type="text" name="nama_hotel" required autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Link Foto</th>
                                <td><input type="url" id="linkInput" name="link" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>
                                    <select name="provinsi" required>
                                        <option align="center" selected disabled>--- PROVINSI ---</option>
                                        <?php
                                        $sql = "SELECT DISTINCT provinsi FROM `kota`";
                                        $result = $koneksi->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["provinsi"] . '">' . $row["provinsi"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value="">Data Destinasi Tidak Tersedia</option>';
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Bintang Hotel</th>
                                <td><input type="number" name="bintang" required autocomplete="off" min="0" max="5">
                                </td>
                            </tr>
                            <tr>
                                <th>Kota</th>
                                <td><input type="text" name="kota" required autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td><input type="text" id="budget" name="harga" required autocomplete="off"></td>
                            </tr>
                        </table>
                        <br>
                    </div>
                    <input class="tombol" type="submit" value="Submit" name="data">
                    <?php
                    // echo "<div align='center'>$success_message</div>";
                    ?>
                </form>
            </div>
        </section>
    </main>

    <!--========== MAIN JS ==========-->

    <script src="assets/js/main.js"></script>
</body>

</html>