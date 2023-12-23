<?php ob_start();
?>

<div class="desktop-navbar">

    <div class="navbar">
        <div class="nav-name">
            <a class="home-link" href="../index.php">
                <h4>RunwayReverie</h4>
            </a>
        </div>
        <nav>
            <ul>
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    // User is logged in, show their name without a link
                    echo '<li class="nav-item">
                        <i class="fa-regular fa-user fa-lg" style="color: #919191;"></i>
                        <span class="nav-item-link"> Hi ' . $_SESSION['user_name'] . '</span>
                    </li>';
                } else {
                    // User is not logged in, show "Sign in" with a link
                    echo '<li class="nav-item">
                        <i class="fa-regular fa-user fa-lg" style="color: #919191;"></i>
                        <a class="nav-item-link" href="../login/login.php">Sign in</a>
                    </li>';
                }
                ?>
                <li class="nav-item">
                    <i class="fa-regular fa-heart fa-lg" style="color: #919191;"></i>
                    <a class="nav-item-link">Favourites</a>
                </li>
                <li class="nav-item">
                    <i class="fa-solid fa-bag-shopping fa-lg" style="color: #919191;"></i>
                    <a class="nav-item-link" href="../pages/cart.php">Shopping bag</a>
                </li>

                <?php
                if (isset($_SESSION['user_id'])) {
                    echo '
                    <li class="nav-item">
                    <i class="fa-solid fa-power-off fa-lg" style="color: #919191;"></i>
                    <a class="nav-item-link" href="../login/logout.php">Log out</a>
                </li>
                    ';
                }
                ?>

            </ul>
        </nav>
    </div>



    <div class="category-div">
        <nav class="categories">
            <ul>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/ladies.php">Ladies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/men.php">Men</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/teens.php">Teens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/kids.php">Kids</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/baby.php">Baby</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/sport.php">Sport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/sale.php">Sale</a>
                </li>
            </ul>
        </nav>
    </div>

</div>

<div class="mobile-navbar">

    <div class="navbar">
        <div class="nav-name">
            <a class="home-link" href="../index.php">
                <h4>RunwayReverie</h4>
            </a>
        </div>
        <div class="nav-items">
            <nav>
                <ul>
                    <?php

                    if (isset($_SESSION['user_id'])) {
                        // User is logged in, show their name without a link

                    } else {
                        // User is not logged in, show "Sign in" with a link
                        echo '<li class="nav-item">
                        <i class="fa-regular fa-user fa-lg" style="color: #919191;"></i>
                        <a class="nav-item-link" href="../login/login.php">Sign in</a>
                    </li>';
                    }
                    ?>
                    <li class="nav-item">
                        <i class="fa-regular fa-heart fa-lg" style="color: #919191;"></i>
                        <a class="nav-item-link">Fav</a>
                    </li>
                    <li class="nav-item">
                        <i class="fa-solid fa-bag-shopping fa-lg" style="color: #919191;"></i>
                        <a class="nav-item-link" href="../pages/cart.php">Bag</a>
                    </li>

                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '
                    <li class="nav-item">
                    <i class="fa-solid fa-power-off fa-lg" style="color: #919191;"></i>
                    <a class="nav-item-link" href="../login/logout.php">Log out</a>
                </li>
                    ';
                    }
                    ?>

                </ul>
            </nav>
        </div>

    </div>



    <div class="category-div">
        <nav class="categories">
            <ul>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/ladies.php">Ladies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/men.php">Men</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/teens.php">Teens</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/kids.php">Kids</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/baby.php">Baby</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/sport.php">Sport</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item-link" href="/pages/sale.php">Sale</a>
                </li>
            </ul>
        </nav>
    </div>

</div>