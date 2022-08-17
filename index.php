<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
  exit();
}

// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$username = $password = $role = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if username is empty
  if (empty(trim($_POST["username"]))) {
    $username_err = "Please enter username.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = "SELECT username, password,role FROM user WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result($stmt, $username, $hashed_password, $role);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["role"] = $role;
              $_SESSION["username"] = $username;
              if ($stmt) {
        while($row = mysqli_fetch_array($stmt)){
            echo'<script type = "text/javascript">alert("You are login successfully and you are logined as '.$row['role'].'")</script>';
        }
        if ($role == "GeneralManager") {
            ?>
            <script type="text/javascript">window.location.href="dashboard.php"</script>
            <?php
        }elseif ($role == "MarketingManager") {
            ?>
            <script type="text/javascript">window.location.href="dashboardMM.php"</script>
            <?php
        }elseif ($role == "HumanResource") {
            ?>
            <script type="text/javascript">window.location.href="dashboardHR.php"</script>
            <?php
        }elseif ($role == "RegionManager") {
            ?>
            <script type="text/javascript">window.location.href="dashboardRM.php"</script>
            <?php
        }else
         ?>
            <script type="text/javascript">alert("no such user")</script>
            <?php

    }
              
            } else {
              // Password is not valid, display a generic error message
              $login_err = "Invalid username or password.";
            }
          }

        } else {
          // Username doesn't exist, display a generic error message
          $login_err = "Invalid username or password.";
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($conn);
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
          <?php
          if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
          }
          ?>

          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="field spaced">
              <label class="label">Login</label>
              <div class="control icons-left">
                <input class="input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" type="text" name="username" value="<?php echo $username; ?>" placeholder="username" autocomplete="username">
                <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
              </div>
              <p class="help">
                Please enter your login
              </p>
            </div>

            <div class="field spaced">
              <label class="label">Password</label>
              <p class="control icons-left">
                <input class="input<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?> " type="password" name="password" placeholder="Password" autocomplete="current-password">
                <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
              </p>
              <p class="help">
                Please enter your password
              </p>
            </div>
            <div class="field spaced">
        <label class="label">Select Type</label>
        <div class="col-sm-6">
            <select class="input" name="role">
                <option value="" selected="selected"> - select role - </option>
                <option value="GeneralManager" >GeneralManager</option>
                <option value="MarketingManager" >MarketingManager</option>
                <option value="HumanResource" >HumanResource</option>
                <option value="RegionManager" >RegionManager</option>
            </select>
        </div>
    </div>

            <div class="field spaced">
              <div class="control">
                <p>Don't have an account? <b><a href="createAccount.php">Sign up now</a>.</b></p>
              </div>
            </div>

            <hr>

            <div class="field grouped">
              <div class="control">
                <button type="submit" name="submit" class="button blue">
                  Login
                </button>
              </div>
            </div>

          </form>
          <?php
          if (isset($_SESSION['error'])) {
          ?>
            <div class="alert alert-danger text-center" style="margin-top:20px;">
              <?php echo $_SESSION['error']; ?>
            </div>
          <?php

            unset($_SESSION['error']);
          }
          ?>
        </div>
      </div>
  </div>

  </section>


  </div>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


  <script>
    ! function(f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function() {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '658339141622648');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1" /></noscript>

  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>