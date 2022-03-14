<!-- this is the home page also known as index page here the user -->
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

<body style="background-color:goldenrod">
  <!-- Start: Header Dark -->
  <?php require 'header.php'; ?>
  <!-- End: Header Dark -->
  <!-- Start: Parallax Background -->
  <form method="GET">
  <div class="form-group" style="margin: 20px; padding: 0px; margin-bottom: 25px;">
      <input id="adminSearch" type="text" name="search" placeholder="Search..." />
    </div>

    <ul class="list-group" id="lis" style="min-height: 70vh;">
    <?php
    
     //  load("SELECT accountID,username,email FROM account;");
     //    load("SELECT s.shareStatuse, s.portID, p.portTitle, p.portID, a.username, a.accountID from share as s join portfolio as p on share.portID = portfolio.portID join account as a on portfolio.accountID = account.account.ID;");
        if (empty($_GET)){
        load("SELECT s.*, p.*, a.* 
        from share as s 
        join portfolio as p 
        On s.portID = p.portID 
        join account as a 
        On p.accountID = a.accountID
        where shareStatus = 1;
         ;");
        }else if (isset($_GET['search'])) {
          require 'dbh.inc.php';
          $sql = 'SELECT a.*, p.*, s.* 
          from account as a 
          join portfolio as p 
          On p.accountID = a.accountID 
          join  share as s
          On s.portID = p.portID
          WHERE  s.shareStatus = 1 
          and a.username LIKE"%' . $_GET['search'] . '%"';
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
           $sh = "SELECT shareStatus, sharelink FROM share where shareStatus=1";
           $sh2 = mysqli_query($conn, $sh) ;
          while ($row_users = mysqli_fetch_array($result)) {
          //  $row_users = mysqli_fetch_array($result);
            $shareS = $row_users['shareStatus'];
            $shareL = $row_users['sharelink'];
     //       if($shareS==1){
             
            echo
              '
               <li id=' . $row_users['accountID'] . ' class="list-group-item">
               <span class="portLabel">' . $row_users['portTitle'] . '<br> By: ' . $row_users['username'] . '</span>
               <div role="group" style="float: right;">
               <a class="btn btn-primary" role="button" onclick="" href="view.php?p=' . $shareL . '"; >View</a>
               </div>
                </li>';
            $count++;
       //      } //else $count++;
          }
           if ($count < 1) {
             echo '<li style="text-align:center;font-size:3vw;color:red;list-style-type:none;">User ' . $_GET['search'] . ' were not found!</li>';
           }
          mysqli_close($conn);
        }
    ?>
    </form>
  <div class="container hero" style="height: 20vh;">
    <div class="row">
      <div class="col">
        <h1 data-aos="fade-up" data-aos-duration="700" style="
                  font-family: 'Cabin Condensed', sans-serif;
                  font-size: 14vh;
                  width: 200px;
                  margin: auto;
                ">
          Hello,
        </h1>
        <h1 data-aos="fade-down" data-aos-duration="700" style="
                  font-family: 'Cabin Condensed', sans-serif;
                  font-weight: 450;
                  font-size: 13vh;
                  color:white;
                  width: 150px;
                  margin: auto;
                ">
          You.
        </h1>
      </div>
      <div class="col-md-8 offset-md-2 text-center align-self-center">
        <h1 class="text-center" data-bs-hover-animate="bounce" style="font-size: 4vh;">
          <br />Portfolios Simplified.
        </h1>
      </div>
    </div>
  </div>
  <div data-bs-parallax-bg="true" style="
        height: 60vh;
        background-image: url(assets/img/stylish.jpg);
        background-position: center;
        background-size: cover;
        width: 100%;
      ">
    <!-- Start: home_lorem -->
    <h2 id="lorem" style="margin: auto; width: auto; height: auto; background-color: none;">
      <br />Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi
      non quis exercitationem culpa nesciunt nihil aut nostrum explicabo
      reprehenderit optio amet ab temporibus asperiores quasi cupiditate.
      Voluptatum ducimus voluptates voluptas?<br />
      <a class="btn btn-primary btn-lg text-left shadow-sm" role="button" data-aos="zoom-in-down" data-aos-once="true" style="
            background-color: rgb(0, 11, 23);
            margin-top: 5.4vmin;
            filter: contrast(107%) hue-rotate(0deg) saturate(91%) sepia(62%);
          " href="register.php">Get Started</a><a href="#"></a><br />
    </h2>

    <!-- End: home_lorem -->
  </div>
  <!-- End: Parallax Background -->
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