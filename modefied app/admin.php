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
  <?php require 'dbh.inc.php'; ?>
</head>

<body style="color: rgb(59, 73, 88); background-color: rgb(128, 134, 163);">
  <!-- Start: Header Dark -->
  <?php require 'header.php';
  $id = $_SESSION['accountID'];
  // take this out
  // $_SESSION['accountID'] = 1;
  // $_SESSION['username'] = "admin";
  if (!in_array($_SESSION['accountID'], $admin)) {
    header("Location:../account.php");
    die();
  }
  ?>
  <!-- End: Header Dark -->

  <form method="GET" style="
        padding: 25px;
        opacity: 0.82;
        background-color: rgba(62, 59, 59, 0.78);
      ">
    <div class="container hero">
      <h1 style="margin: -15px 0 10px 0; color: white; text-align: center;">
        Welcome admin, <?php echo ucfirst($_SESSION['username']) . '!'; ?>
      </h1>
    </div>
    <?php
    function getInsight($str)
    {
      require 'dbh.inc.php';
      $sql = 'SELECT COUNT(*) AS sum FROM ' . $str;
      if ($str == 'share') {
        $sql = 'SELECT COUNT(*) AS sum FROM ' . $str . ' WHERE shareStatus=1';
        $result = mysqli_query($conn, $sql);
        $row_users = mysqli_fetch_array($result);
        return (floor(intval($row_users['sum']) / 5) * 5) . '+';
      }
      $result = mysqli_query($conn, $sql);
      $row_users = mysqli_fetch_array($result);
      return (floor(intval($row_users['sum']) / 5) * 5) . '+';
    }
    ?>
    <section id="dashboard">
      <div class="row">
        <div class="column">
          <div class="card">
            <p><i style="font-size:50px" class="fa fa-users" aria-hidden="true"></i></p>
            <h3><?php echo getInsight('account') ?></h3>
            <p>Creators</p>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <p><i style="font-size:50px" class="fa fa-file-o" aria-hidden="true"></i></p>
            <h3><?php echo getInsight('portfolio') ?></h3>
            <p>Portfolios</p>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <p><i style="font-size:50px" class="fa fa-puzzle-piece" aria-hidden="true"></i></p>
            <h3><?php echo getInsight('section') ?></h3>
            <p>Sections</p>
          </div>
        </div>

        <div class="column">
          <div class="card">
            <p><i style="font-size:50px" class="fa fa-share-alt" aria-hidden="true"></i></p>
            <h3><?php echo getInsight('share') ?></h3>
            <p>Sharing</p>
          </div>
        </div>
      </div>
    </section>
    <div class="form-group" style="margin: 20px; padding: 0px; margin-bottom: 25px;">
      <input id="adminSearch" type="text" name="search" placeholder="Search..." />
    </div>
    <!-- phase 2 -->
    <ul class="list-group" id="lis" style="min-height: 70vh;">
      <!-- users HERE -->
      <?php
      if (empty($_GET))
        load("SELECT accountID,username,email FROM account;");
      if (isset($_GET['search'])) {
        require 'dbh.inc.php';
        $sql = 'SELECT accountID,username,email FROM account WHERE username LIKE"%' . $_GET['search'] . '%"';
        load($sql);
      }

      if (isset($_GET['remove'])) {
        echo '<script type="text/javascript">window.location.replace(\'admin.php\');</script>';
        $sql = 'DELETE FROM account WHERE accountID=' . $_GET['remove'];
        $result = mysqli_query($conn, $sql);
        $sql = 'SELECT accountID,username,email FROM account;';
        load($sql);
      }
      function load($sql)
      {
        require 'dbh.inc.php';

        echo '<script type="text/JavaScript">  
                          document.getElementById("lis").innerHTML="";
                          </script>';
        $count = 0;
        $result = mysqli_query($conn, $sql);
        while ($row_users = mysqli_fetch_array($result)) {
          echo
            '
             <li id=' . $row_users['accountID'] . ' class="list-group-item">
             <span class="portLabel">' . $row_users['username'] . '<br>' . $row_users['email'] . '</span>
             <div role="group" style="float: right;">
             <a class="btn btn-primary" role="button" onclick="" href="account.php?v=' . $row_users['accountID'] . '"; >View</a>
             <a onclick="deletePort(this)" href="admin.php?remove=' . $row_users['accountID'] . '"' . ' class="btn btn-primary">Remove</a>
             </div>
              </li>';
          $count++;
        }
        if ($count < 1) {
          echo '<li style="text-align:center;font-size:3vw;color:red;list-style-type:none;">User ' . $_GET['search'] . ' were not found!</li>';
        }
        mysqli_close($conn);
      }
      ?>

    </ul>
  </form>
  <!-- Start: Footer Dark -->
  <?php require 'footer.php'; ?>
  <!-- End: Footer Dark -->

  <script type="text/javascript" src="main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/smart-forms.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>