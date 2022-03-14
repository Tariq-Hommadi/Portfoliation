<?php if (!(isset($_SESSION)))
    session_start();
$admin = array(1, 2, 3); ?>
<div>
    <div class="header-dark" style="background-image: url('assets/img/blue.jpeg');">
        <nav class="navbar navbar-dark navbar-expand-lg navigation-clean-search" style="background-color: rgba(33, 74, 128, 0.38);">
            <div class="container">
                <a class="navbar-brand" href="index.php"> <i class="fa fa-pencil" aria-hidden="true"></i>Portfoliation</a> <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <?php
                        if (isset($_SESSION['accountID']) && in_array($_SESSION['accountID'], $admin)) {
                            echo '<li class="nav-item" role="presentation">
                                  <a class="nav-link" href="admin.php">Admin</a> </li>';
                        } else if (isset($_SESSION['accountID'])) {
                            echo '<li class="nav-item" role="presentation">
                            <a class="nav-link" href="account.php">Account</a>
                        </li>';
                        }
                        ?>
                    </ul>
                    <form class="form-inline mr-auto" target="_self">
                        <div class="form-group"><label for="search-field"></label></div>
                    </form>
                    <?php
                    if (!isset($_SESSION['accountID']))
                        echo '<span class="navbar-text"><a class="login" href="login.php">Log In</a></span><a class="btn btn-light action-button" role="button" href="register.php">Sign Up</a>';
                    else echo ' <span class="navbar-text"><a class="btn btn-light action-button" href="logout.php">Logout</a></span>';

                    ?>
                </div>
            </div>
        </nav>
    </div>
</div>