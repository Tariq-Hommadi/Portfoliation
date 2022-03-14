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

<body style="color: rgb(59, 73, 88); background-color: rgb(128, 134, 163);">
  <!-- Start: Header Dark -->
  <?php require 'header.php';
  if (!isset($_SESSION['accountID'])) {
    header("Location:../login.php");
    die();
  }
  $GLOBALS['ID'] = $_SESSION['accountID'];
  $GLOBALS['user'] = $_SESSION['username'];
  $GLOBALS['admin'] = FALSE;
  $GLOBALS['rmv'] = "account.php?remove=";
  $GLOBALS['crt'] = "account.php?create=";
  $GLOBALS['shr'] = "account.php?share=";
  if (in_array($_SESSION['accountID'], array(1, 2, 3))) {
    if (!isset($_GET['v']) && (!$_GET['remove'] || !$_GET['create'])) {
      header("Location: ../admin.php");
      exit();
    }
    require 'dbh.inc.php';
    $sql = 'SELECT * FROM account WHERE accountID=' . $_GET['v'];
    $result = mysqli_query($conn, $sql);
    $row_users = mysqli_fetch_array($result);
    $GLOBALS['user'] = $row_users['username'];
    $GLOBALS['ID'] = $_GET['v'];
    $GLOBALS['admin'] = TRUE;
    $GLOBALS['rmv'] = "account.php?v=" . $GLOBALS['ID'] . "&remove=";
    $GLOBALS['crt'] = "account.php?v=" . $GLOBALS['ID'] . "&create=";
    $GLOBALS['shr'] = "account.php?v=" . $GLOBALS['ID'] . "&share=";
    mysqli_close($conn);
  }
  ?>
  <!-- End: Header Dark -->
  <form method="GET" style="
        padding: 25px;
        opacity: 0.82;
        background-color: rgba(62, 59, 59, 0.78);
      ">
    <div id="alert" class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Link Copied!
    </div>
    <div class="container hero">
      <h1 style="margin: -15px 0 10px 0; color: white; text-align: center;">
        <?php if (!$GLOBALS['admin']) echo '<p>' . ucfirst($GLOBALS['user']) . '\'s Collection </p>';
        else echo '<p> Viewing' . ucfirst($GLOBALS['user']) . '\'s Collection </p>' ?>
      </h1>
    </div>
    <div class="list-group-item">
      <?php echo ' <a class="btn btn-primary" href="' . $GLOBALS['crt'] . '" type="button" style="float: right;">
        Create
      </a>';
      ?>
      <p style="
            font-weight: initial;
            font-size: 30px;
            width: 60px;
            height: 25px;
            color: rgb(255, 255, 255);
          ">
        Portfolio#
      </p>
    </div>
    <ul class="list-group" id="lis" style="min-height: 70vh;">

      <?php
      $sql = 'SELECT * FROM portfolio AS p JOIN share AS s on s.portID=p.portID WHERE accountID=' . $GLOBALS['ID'];

      load($sql);
      function load($sql)
      {
        require 'dbh.inc.php';
        $result = mysqli_query($conn, $sql);
        while ($row_users = mysqli_fetch_array($result)) {
          $st = "";
          if ((intval($row_users['shareStatus']) != 1))
            $st = 'style="background-color:crimson;"';
          if ($row_users['portStatus']) {
            if (!$GLOBALS['admin']) echo
              ' <li class="list-group-item">
              <a title="Click to View" target="_blank" style="text-decoration:none" href="view.php?p=' . $row_users['sharelink'] . '" class="portLabel">' . $row_users['portTitle'] . '</a>
              <div role="group" style="float: right;">
              <a title="Copy link" onclick="copy(\'' . $row_users['sharelink'] . '\')" too href="' . $GLOBALS['shr'] . $row_users['sharelink'] . '"' . $st . ' class="btn btn-primary">Share</a>
              <a class="btn btn-primary" role="button" href="edit.php?p=' . $row_users['sharelink'] . '" >Edit</a>
              <a href="' . $GLOBALS['rmv'] . $row_users['sharelink'] . '"' . ' class="btn btn-primary">Delete</a>
              </div>
              </li>';
            else  echo
              ' <li class="list-group-item">
              <a title="Click to View" target="_blank" style="text-decoration:none" href="view.php?p=' . $row_users['sharelink'] . '" class="portLabel">' . $row_users['portTitle'] . '</a>
              <div role="group" style="float: right;">
              <a title="Copy link" onclick="copy(\'' . $row_users['sharelink'] . '\')" href="' . $GLOBALS['shr'] . $row_users['sharelink'] . '"' . $st . ' class="btn btn-primary">Share</a>
              <a href="' . $GLOBALS['rmv'] . $row_users['sharelink'] . '"' . ' class="btn btn-primary">Delete</a>
              </div>
              </li>';
          } else if ($GLOBALS['admin']) {
            echo
              ' <li class="list-group-item">
            <a title="Click to View" target="_blank" style="text-decoration:none" href="view.php?p=' . $row_users['sharelink'] . '" class="portLabel">' . $row_users['portTitle'] . '</a>
            <div role="group" style="float: right;">
            <a title="Copy link" onclick="copy(\'' . $row_users['sharelink'] . '\')" href="' . $GLOBALS['shr'] . $row_users['sharelink'] . '"' . $st . ' class="btn btn-primary">Share</a>
            <a href="javascript:void(0)" style="background-color:gray;cursor: default;" class="btn btn-primary">Delete</a>
            </div>
            </li>';
          }
        }
      }
      if (isset($_GET['remove'])) {
        if ($GLOBALS['admin'])
          echo '<script type="text/javascript">window.location.replace(\'account.php?v=' . $GLOBALS['ID'] . '\');</script>';
        else
          echo '<script type="text/javascript">window.location.replace(\'account.php\');</script>';
        //cleans url
        require 'dbh.inc.php';
        $sql = 'UPDATE portfolio SET portStatus=0 WHERE portfolio.portID IN (SELECT * FROM(SELECT s.portID FROM share AS s JOIN portfolio AS p ON s.portID=p.portID WHERE sharelink="' . $_GET['remove'] . '") AS X)';
        $result = mysqli_query($conn, $sql);
        unset($_GET['remove']);
      }
      if (isset($_GET['create'])) {
        if ($GLOBALS['admin'])
          echo '<script type="text/javascript">window.location.replace(\'account.php?v=' . $GLOBALS['ID'] . '\');</script>';
        else
          echo '<script type="text/javascript">window.location.replace(\'account.php\');</script>';
        //avoids creating new on refresh!

        require 'dbh.inc.php';
        require_once 'generate.php';
        $sql = 'SELECT COUNT(*) AS nex FROM portfolio WHERE accountID=' . $GLOBALS['ID'] . ' AND portStatus=1;';
        $result = mysqli_query($conn, $sql);
        $row_users = mysqli_fetch_array($result);
        $newPort = intval($row_users['nex']) + 1;
        $id = getToken();
        $sql = 'INSERT INTO portfolio(portTitle,portStatus,accountID) VALUES("Portfolio ' . $newPort . '","1",' . $GLOBALS['ID'] . ')';
        $result = mysqli_query($conn, $sql);
        $sql = 'SELECT COUNT(*) AS nex FROM account AS a JOIN portfolio AS p ON a.accountID=p.accountID WHERE portStatus=1 AND p.accountID=' . $GLOBALS['ID'];
        $result = mysqli_query($conn, $sql);
        $row_users = mysqli_fetch_array($result);
        $wrtUser = intval($row_users['nex']);
        $sql = 'SELECT COUNT(*) AS nex FROM portfolio;';
        $result = mysqli_query($conn, $sql);
        $row_users = mysqli_fetch_array($result);
        $nexID = $row_users['nex'];
        $sql = 'INSERT INTO share(sharelink,shareStatus,portID) VALUES("' . $id . '","0",' . $nexID . ')';
        $result = mysqli_query($conn, $sql);
        if (!$GLOBALS['admin']) echo '<li id="' . $wrtUser . '" class="list-group-item">
        <a title="Click to View" style="text-decoration:none" target="_blank" href="view.php?p=' . $id . '" class="portLabel">' . 'Portfolio ' . $newPort . '</a>
        <div role="group" style="float: right;">
        <a title="Copy link"  onclick="copy(\'' . $id . '\')" href="' . $GLOBALS['shr'] . $id . '"' . ' style="background-color:crimson;" class="btn btn-primary">Share</a>
        <a class="btn btn-primary" role="button" onclick=""href="edit.php?p=' . $id . '" >Edit</a>
        <a href="' . $GLOBALS['rmv'] . $id . '"' . ' class="btn btn-primary">Delete</a>
        </div>
        </li>';
        else echo '<li id="' . $wrtUser . '" class="list-group-item">
        <a title="Click to View" style="text-decoration:none"  target="_blank" href="view.php?p=' . $id . '" class="portLabel"> Portfolio ' . $newPort . '</a>
        <div role="group" style="float: right;">
        <a title="Copy link" onclick="copy(\'' . $id . '\')" href="' . $GLOBALS['shr'] . $id . '"' . ' style="background-color:crimson;" class="btn btn-primary">Share</a>
        <a href="' . $GLOBALS['rmv'] . $id . '"' . ' class="btn btn-primary">Delete</a>
        </div>
        </li>';
        echo '<script type"text/javascript"> location="#' . $wrtUser . '"</script>';
      }
      if (isset($_GET['share'])) {
        if ($GLOBALS['admin'])
          echo '<script type="text/javascript">window.location.replace(\'account.php?v=' . $GLOBALS['ID'] . '\');</script>';
        else
          echo '<script type="text/javascript">window.location.replace(\'account.php\');</script>';
        //avoids toggle on refresh.
        echo '<script type="text/javascript">alert("Linked copied!")</script>';

        require 'dbh.inc.php';
        $sql = 'SELECT p.accountID,s.shareStatus FROM (portfolio as p  join share as s on p.portID=s.portID) WHERE sharelink="' . $_GET['share'] . '"';
        $result = mysqli_query($conn, $sql);
        $row_users = mysqli_fetch_array($result);
        if (intval($row_users['shareStatus']) == 1) {
          $change = 0;
        } else {
          $change = 1;
        }
       // $sql = 'UPDATE portfolio,share SET share.shareStatus=' . $change . ' WHERE share.portID IN (SELECT * FROM(SELECT s.portID FROM share AS s JOIN portfolio AS P ON s.portID=p.portID WHERE share.sharelink="' . $_GET['share'] . '") AS X);';
        $sql = 'UPDATE portfolio,share SET share.shareStatus=' . $change . ' WHERE share.portID IN (SELECT * FROM(SELECT s.portID FROM share AS s JOIN portfolio AS p ON s.portID = p.portID WHERE sharelink="' . $_GET['share'] . '") AS X);';

        $result = mysqli_query($conn, $sql);
      }
      ?>
    </ul>
  </form>
  <!-- Start: Footer Dark -->
  <?php require 'footer.php'; ?>
  <!-- End: Footer Dark -->
  <script>
    function copy(text) {
      document.getElementById('alert').style.display = "block";
      var dummy = document.createElement("textarea");
      // to avoid breaking orgain page when copying more words
      // cant copy when adding below this code
      // dummy.style.display = 'none'
      document.body.appendChild(dummy);
      //Be careful if you use texarea. setAttribute('value', value), which works with "input" does not work with "textarea". – Eduard
      dummy.value = "http://localhost/view.php?p=" + text;
      dummy.select();
      document.execCommand("copy");
      document.body.removeChild(dummy);
    }
  </script>
  <script>
    // Get all elements with class="closebtn"
    var close = document.getElementsByClassName("closebtn");
    var i;

    // Loop through all close buttons
    for (i = 0; i < close.length; i++) {
      // When someone clicks on a close button
      close[i].onclick = function() {

        // Get the parent of <span class="closebtn"> (<div class="alert">)
        var div = this.parentElement;

        // Set the opacity of div to 0 (transparent)
        div.style.opacity = "0";

        // Hide the div after 600ms (the same amount of milliseconds it takes to fade out)
        setTimeout(function() {
          div.style.display = "none";
        }, 600);
      }
    }
  </script>

  <script type="text/javascript" src="main.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/smart-forms.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
  <script src="assets/js/script.min.js"></script>
</body>

</html>