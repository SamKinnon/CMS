<!DOCTYPE html>
<?php

require_once 'db.php';
if (isset($_POST['btn_login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    $query = "SELECT * FROM `user` WHERE username = '".$user."' and password = '".$pass."' and role = '".$role."' ";
    $result = mysqli_query($conn,$query);
    if ($result) {
        while($row = mysqli_fetch_array($result)){
            echo'<script type = "text/javascript">alert("You are login successfully and you are logined as '.$row['role'].'")</script>';
        }
        if ($role == "GeneralManager") {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            ?>
            <script type="text/javascript">window.location.href="dashboard.php"</script>
            <?php
        }elseif ($role == "MarketingManager") {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            ?>
            <script type="text/javascript">window.location.href="dashboardMM.php"</script>
            <?php
        }elseif ($role == "HumanResource") {
             $_SESSION["loggedin"] = true;
             $_SESSION["username"] = $username;
            ?>
            <script type="text/javascript">window.location.href="dashboardHR.php"</script>
            <?php
        }elseif ($role == "RegionManager") {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            ?>
            <script type="text/javascript">window.location.href="dashboardRM.php"</script>
            <?php
        }else
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
         ?>
            <script type="text/javascript">alert("no such user")</script>
            <?php

    }
}

?>

<!DOCTYPE html>
<html lang="en" class="form-screen">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" >
  <title>Dashboard - Main</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1628755089081">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6" />

  <meta name="description">

  <meta property="og:url">
  <meta property="og:site_name">
  <meta property="og:title" >
  <meta property="og:description" >
  <meta property="og:image">
  <meta property="og:image:type">
  <meta property="og:image:width">
  <meta property="og:image:height">

  <meta property="twitter:card">
  <meta property="twitter:title" >
  <meta property="twitter:description">
  <meta property="twitter:image:src">
  <meta property="twitter:image:width">
  <meta property="twitter:image:height">

</head>

<body>

  <div id="app">

    <section class="section main-section">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-lock"></i></span>
            Login
        </p>
    </header>
    <div class="card-content">

    <form method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-sm-6">
                <input type="text" name="username" class="form-control" placeholder="enter Username">
            </div>
        </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label">Password</label>
        <div class="col-sm-6">
            <input type="password" name="password" class="form-control" placeholder="enter Password">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Select Type</label>
        <div class="col-sm-6">
            <select class="form-control" name="role">
                <option value="" selected="selected"> - select role - </option>
                <option value="GeneralManager" >GeneralManager</option>
                <option value="MarketingManager" >MarketingManager</option>
                <option value="HumanResource" >HumanResource</option>
                <option value="RegionManager" >RegionManager</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
            <input type="submit" name="btn_login" class="btn btn-success" value="Login">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
            You don't have a account register here? <a href="createAccount.php"><p class="text-info">Register Account</p></a>
            </div>
        </div>
    </form>
</div>
</div>
</div>

</section>


</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1" /></noscript>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>
