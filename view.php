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
  <?php require 'header.php';
  if (!isset($_GET['p'])) {
    header("Location: ../index.php");
    die();
  } else {
    require 'dbh.inc.php';
    $sql = 'SELECT account.accountID,shareStatus,username FROM account JOIN (SELECT portTitle,accountID,shareStatus FROM (portfolio as p  join share as s on p.portID=s.portID) WHERE sharelink="' . $_GET['p'] . '") AS X ON account.accountID=X.accountID';
    $result = mysqli_query($conn, $sql);
    $row_users = mysqli_fetch_array($result);
    // Display error msg
    if (empty($row_users) || ($row_users['shareStatus'] == 0)) {
      if (!isset($_SESSION['accountID'])) {
        require 'portErr.php';
        require 'footer.php';
        die();
      } else if (empty($row_users) || $_SESSION['accountID'] != $row_users['accountID']) {
        require 'portErr.php';
        require 'footer.php';
        die();
      }
    }
  }
  // Share settings
  $GLOBALS['username'] = $row_users['username'];
  ?>
  <!-- Sections index -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <?php
    require 'dbh.inc.php';
    $sql = 'SELECT secID, secTitle FROM (section as sec  join share as s on sec.portID=s.portID) WHERE sharelink="' . $_GET['p'] . '" AND secStatus=True;';
    $result = mysqli_query($conn, $sql);
    $count = 0;
    while ($row_users = mysqli_fetch_array($result)) {
      echo '<a href="#sec' . $count++ . '"><p style="font-weight:100;">' . $row_users['secTitle'] . '</p></a>';
    }
    ?>
  </div>
  <span ide="menuX" style="position: fixed;margin: 10% 5%;font-size: 25px;writing-mode: tb;color: white;cursor: pointer;" onclick="openNav()">&#9776;<strong>Index</strong></span>
  <!-- End: Header Dark -->
  <div id="change" class="table-responsive text-left" style="background-color: rgb(40, 45, 50); color: white;padding-bottom:60vh">
    <!--Table handling-->

    <div class="container-sm">
      <table id="sections_table" class="table">
        <?php
        function getPortTitle()
        {
          require 'dbh.inc.php';
          $sql = 'SELECT portTitle,sharelink FROM (portfolio as p  join share as s on p.portID=s.portID) WHERE sharelink="' . $_GET['p'] . '"';
          $result = mysqli_query($conn, $sql);
          $row_users = mysqli_fetch_array($result);
          mysqli_close($conn);
          return '<header style="border-radius:10px;box-shadow: -2px 2px 0px dimgrey;background-color:rgba(0,0,0,0.1);color: white; font-size: 5vmin;text-align:center;" >' . '<p style="font-weight:100;">' . $GLOBALS['username'] . '</p>' . $row_users['portTitle'] . '</header>';
        } ?>
        <thead>
          <tr>
            <th>
              <?php echo getPortTitle()  ?>
            </th>
          </tr>
        </thead>
        <tbody style="color: white; font-size: vmin;">
          <?php
          require 'dbh.inc.php';
          $sql = 'SELECT secID,secTitle,secContent FROM (section as sec  join share as s on sec.portID=s.portID) WHERE sharelink="' . $_GET['p'] . '" AND secStatus=True;';
          $result = mysqli_query($conn, $sql);
          $count = 0;
          while ($row_users = mysqli_fetch_array($result)) {
            echo ' <tr >
              <td id="sec' . $count++ . '">
                <strong> <p style="font-size:35px;font-weight:500;">' . $row_users['secTitle'] . '</p></strong>
                  ' . $row_users['secContent'] . '
              </td>
            </tr>';
          }
          ?>
        </tbody>

      </table>
    </div>
  </div>
  </div>
  <!-- Start: Footer Dark -->
  <?php require 'footer.php'; ?>
  <!-- End: Footer Dark -->
  <script type="text/javascript" src="main.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/smart-forms.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <script src="assets/js/script.min.js"></script>
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }
    /* Set the width of the side navigation to 0 */
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }

    function theme(color) {
      $("#change").css("background-color", color);
      if (color == "whitesmoke") {
        $("p, th, strong").css("color", "black");
      }
      if (color == "black") {
        $("p, th, strong").css("color", "white");
      }
    }
  </script>
</body>

</html>