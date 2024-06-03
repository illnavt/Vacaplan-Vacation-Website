<?php
include ("kode.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/slider.css">
    <link rel="shortcut icon" href="images/logo.png">
    <title>Admin Dashboard</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --index: calc(1vw + 1vh);
        --transition: cubic-bezier(.1, .7, 0, 1);
    }

    h1 {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 10vh;
        margin-bottom: -20vh;
        margin-top: 12px;
    }

    .wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .items {
        display: flex;
        gap: 0.4rem;
        perspective: calc(var(--index) * 35);
    }

    .item {
        width: calc(var(--index) * 3);
        height: calc(var(--index) * 12);
        background-color: #222;
        background-size: cover;
        background-position: center;
        cursor: pointer;
        filter: grayscale(1) brightness(.5);
        transition: transform 1.25s var(--transition), filter 3s var(--transition), width 1.25s var(--transition);
        will-change: transform, filter, rotateY, width;
    }

    .item::before,
    .item::after {
        content: '';
        position: absolute;
        height: 100%;
        width: 20px;
        right: calc(var(--index) * -1);
    }

    .item::after {
        left: calc(var(--index) * -1);
    }

    .items .item:hover {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 10));
    }

    /*Right*/

    .items .item:hover+* {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 8.5)) rotateY(35deg);
        z-index: -1;
    }

    .items .item:hover+*+* {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 5.6)) rotateY(40deg);
        z-index: -2;
    }

    .items .item:hover+*+*+* {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 2.5)) rotateY(30deg);
        z-index: -3;
    }

    .items .item:hover+*+*+*+* {
        filter: inherit;
        transform: translateZ(calc(var(--index) * .6)) rotateY(15deg);
        z-index: -4;
    }


    /*Left*/

    .items .item:has(+ :hover) {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 8.5)) rotateY(-35deg);
    }

    .items .item:has(+ * + :hover) {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 5.6)) rotateY(-40deg);
    }

    .items .item:has(+ * + * + :hover) {
        filter: inherit;
        transform: translateZ(calc(var(--index) * 2.5)) rotateY(-30deg);
    }

    .items .item:has(+ * + * + * + :hover) {
        filter: inherit;
        transform: translateZ(calc(var(--index) * .6)) rotateY(-15deg);
    }

    .items .item:active,
    .items .item:focus {
        width: 28vw;
        filter: inherit;
        z-index: 100;
        transform: translateZ(calc(var(--index) * 10));
        margin: 0 .45vw;
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
                            <i class='bx bx-home nav__icon active'></i>
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
    <main>
        <section>
            <h1>Welcome!!</h1>
            <div class="wrapper">
                <div class="items">
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic13.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic12.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic11.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic10.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic9.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic8.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic7.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic6.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic5.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic4.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic3.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic2.jpg)"></div>
                    <div class="item" tabindex="0" style="background-image: url(assets/img/tropic1.jpg)"></div>
                </div>
            </div>
        </section>
    </main>

    <!--========== MAIN JS ==========-->
    <script src="assets/js/main.js"></script>
</body>

</html>