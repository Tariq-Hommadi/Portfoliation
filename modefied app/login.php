<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Portfoliation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />

</head>

<body>

  <!-- Start: Header Dark -->
  <?php
  require 'header.php';
  ?>
  <!-- End: Header Dark -->
  <!-- Start: Login Form Dark -->
  <div class="login-dark">
    <div class="cover"></div>
    <form method="POST" action="signin.php">
      <h2 class="sr-only">Login Form</h2>
      <div class="illustration">
        <i class="icon ion-ios-locked-outline"></i>
      </div>
      <?php if (isset($_GET['mismatch'])) echo '<p style="color:red;text-align:center;">Email or password doesn\'t match</p>'; ?>
      <div class="form-group">
        <?php
        if (isset($_SESSION['email']))
          echo '<input class="form-control" type="email" value="' . $_SESSION['email'] . '" name="email" placeholder="Email" required />';
        else echo '<input class="form-control" type="email" name="email" placeholder="Email" required />';

        ?>
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Password" required />
      </div>
      <div class="form-group">
        <button name="signin-submit" class="btn btn-primary btn-block" role="button" href="account.php">Login in</button>
      </div>
    </form>
  </div>
  <!-- End: Login Form Dark -->
  <!-- Start: Footer Dark -->

  <?php
  require 'footer.php';
  ?>
  <!-- End: Footer Dark -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>