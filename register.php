<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>Portfoliation</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin+Condensed" />
  <link rel="stylesheet" href="assets/fonts/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/fonts/ionicons.min.css" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css" />
</head>

<body>
  <!-- Start: Header Dark -->
  <?php require 'header.php'; ?>
  <!-- End: Header Dark -->
  <!-- Start: Login Form Dark -->
  <div class="text-left login-dark">
    <div class="cover"></div>
    <form method="post" action="signup.php">
      <h2 class="sr-only">Login Form</h2>
      <div class="illustration">
        <i class="icon ion-ios-locked-outline"></i>
        <?php
        if (isset($_GET['emailTaken']))
          echo '<div style="color:red;font-size:1.2vw;" >Please choose a different email</div></script>';
        ?>
      </div>
      <div class="form-group">
        <?php
        $value = "";
        if (isset($_GET['emailTaken']))
          $value = $_GET['emailTaken'];

        echo '<input class="form-control" type="text" id="uName" name="username" value="' . $value . '" placeholder="Username" required/>'

        ?>
      </div>
      <div class="form-group">
        <input class="form-control" id="mail" type="email" name="email" placeholder="Email" required />
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="password" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
      </div>
      <div class="form-group">
        <button name="signup-submit" class="btn btn-primary btn-block" role="button" href="login.php">
          Register
        </button>
      </div>
    </form>

  </div>
  <!-- End: Login Form Dark -->
  <!-- Start: Footer Dark -->
  <?php require 'footer.php'; ?>
  <!-- End: Footer Dark -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/smart-forms.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>