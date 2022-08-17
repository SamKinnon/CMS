<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $level = "";
$username_err = $password_err = $confirm_password_err = $level_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }
     if (empty(trim($_POST["level"]))) {
        $level_err = "Please select your level.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["level"]))) {
        $level_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM user WHERE role = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_level);

            // Set parameters
            $param_level = trim($_POST["level"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $level_err = "This level is already taken.";
                } else {
                    $level = trim($_POST["level"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($level_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$param_level);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
             $param_level = $level;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
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

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'UA-130795909-1');
</script>

</head>

<body>
    <div class="section main-section">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-lock"></i></span>
                    Please fill this form to create an account.
                </p>
            </header>
            <div class="card-content">

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="field spaced">
                        <label>Username</label>
                        <div class="control icons-left">
                            <input type="text" name="username" placeholder="Enter usernamer" class="input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required>
                            <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <p class="help">
                            Please enter your login
                        </p>
                    </div>
                    <div class="field spaced">

                        <label>Password</label>
                        <div class="control icons-left">
                            <input type="password" name="password" placeholder="Create Password" class="input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" required>
                            <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <p class="help">
                            Please enter your login
                        </p>
                    </div>
                    <div class="field spaced">

                        <label>Confirm Password</label>
                        <div class="control icons-left">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="input <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" required>
                            <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <p class="help">
                            Please confirm your Password
                        </p>
                    </div>
                    <div class="field spaced">

                        <label>Level</label>
                        <div class="control icons-left">
                            <select class="form-select" aria-label="Default select example" name="level" class="input <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" required>
                              
                              <option value="GeneralManager" >GeneralManager</option>
                              <option value="MarketingManager" >MarketingManager</option>
                              <option value="HumanResource" >HumanResource</option>
                              <option value="RegionManager" >RegionManager</option>

                          </select>
                          <span class="invalid-feedback"><?php echo $level_err; ?></span>
                      </div>
                      <p class="help">
                        Please confirm your Password
                    </p>
                </div>

                <div class="field spaced">
                    <button type="submit" name="submit" class="button blue">
                      Create Account
                  </button>
                  <button type="reset" class="button red">
                      Reset
                  </button>

              </div>
              <div class="control">
                <p class="alert alert-primary">Already have an account?  <b><a href="index.php" class="link-info">Login here</a></b>.</p>
            </div>
        </form>
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