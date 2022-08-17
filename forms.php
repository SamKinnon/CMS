<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" >
  <title>Dashboard - Main</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1628755089081">

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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

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

<script src="tableExport/tableExport.js"></script>
<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
</head>

<body>

    <div id="app">

        <nav id="navbar-main" class="navbar is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item mobile-aside-button">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
                <div class="navbar-item">
                    <div class="control">
                        <h2><b class="font-black">Fill The Form Correctly</b> </h2>
                    </div>
                </div>
            </div>
            <div class="navbar-brand is-right">
                <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-menu" id="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item dropdown has-divider">
                        <a class="navbar-link">
                            <span class="icon"><i class="mdi mdi-menu"></i></span>
                            <span>Sample Menu</span>
                            <span class="icon">
                                <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="navbar-dropdown">
                            <a href="profile.php" class="navbar-item">
                                <span class="icon"><i class="mdi mdi-account"></i></span>
                                <span>My Profile</span>
                            </a>
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-settings"></i></span>
                                <span>Settings</span>
                            </a>
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-email"></i></span>
                                <span>Messages</span>
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-logout"></i></span>
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>
                    <div class="navbar-item dropdown has-divider has-user-avatar">
                        <a class="navbar-link">
                            <div class="user-avatar">
                            <img class="img-profile rounded-circle"  src="img/pic.jpg"/>
                            </div>
                            <div class="is-user-name"><span><strong>
                    <?php echo $_SESSION['username']; ?>
                </strong></span></div>
                            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="navbar-dropdown">
                            <a href="profile.php" class="navbar-item">
                                <span class="icon"><i class="mdi mdi-account"></i></span>
                                <span>My Profile</span>
                            </a>
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-settings"></i></span>
                                <span>Settings</span>
                            </a>
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-email"></i></span>
                                <span>Messages</span>
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item">
                                <span class="icon"><i class="mdi mdi-logout"></i></span>
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </nav>

        <aside class="aside is-placed-left is-expanded">
  <div class="aside-tools">
    <div>
      Admin <b class="font-black">One</b>
    </div>
  </div>
  <div class="menu is-menu-main">
    <p class="menu-label">General</p>
    <ul class="menu-list">
      <li class="active">
        <a href="dashboard.php">
          <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
          <span class="menu-item-label">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="menu-label">Activities</p>
    <ul class="menu-list">
      
      <li class="--set-active-profile-html">
        <a href="profile.php">
          <span class="icon"><i class="mdi mdi-account-circle"></i></span>
          <span class="menu-item-label">User Profile</span>
        </a>
      </li>
      <li>
        <a href="index.php">
          <span class="icon"><i class="mdi mdi-lock"></i></span>
          <span class="menu-item-label">Login</span>
        </a>
      </li>
      <li>
        <a class="dropdown">
          <span class="icon"><i class="mdi mdi-view-list"></i></span>
          <span class="menu-item-label">Contracts</span>
          <span class="icon"><i class="mdi mdi-plus"></i></span>
        </a>
        <ul>
          <li>
            <a href="forms.php">
              <span>Add Contract</span>
            </a>
          </li>
          <li>
            <a href="contractRenew.php">
              <span>Renew Contract</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <p class="menu-label">About</p>
    <ul class="menu-list">
      
      <li>
        <a href="https://justboil.me/tailwind-admin-templates" class="has-icon">
          <span class="icon"><i class="mdi mdi-help-circle"></i></span>
          <span class="menu-item-label">About</span>
        </a>
      </li>
      
    </ul>
  </div>
</aside>

        <section class="is-title-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <ul>
                    <li>Admin</li>
                    <li>Forms</li>
                </ul>
            </div>
        </section>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                    Fill The Forms
                </h1>
            </div>
        </section>

        <section class="section main-section">
            <div class="card mb-6">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-ballot"></i></span>
                        New Form
                    </p>
                </header>
                <div class="card-content">
                    <form method="POST" action="insertForm.php" enctype="multipart/form-data" class="form-control-lg">
                        <table>
                            <tr>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contract Number</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="number" placeholder="Contract_number" name="c_number" style="width: auto;" required>
                                                    <p class="help">
                                                    
      
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contract Title</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="text" placeholder="Contract_title" name="c_title" style="width: auto;" required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contracter(client)</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="text" placeholder="Contractor" name="c_client" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                               
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contracter(partner)</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="text" placeholder="Contract partner" name="c_partner" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contracter(ServiceProvider)</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="text" placeholder="Contract_Sp" name="c_sp" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contract Amount)</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="number" placeholder="Contract_Amount" name="c_amount" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                
                            <tr>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contracter End Date</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="date" placeholder="Contract_Duration" name="c_enddate" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contracter Manager</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="text" placeholder="Contract_Manager" name="c_manager" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="field">
                                        <label class="label"><span class="text-primary">Contract Signing_Date</span></label>
                                        <div class="field-body">
                                            <div class="field">
                                                
                                                    <input class="form-control" type="date" placeholder="" name="c_date" style="width: auto;"required>
                                                    
                                                    <p class="help">
                                                        This field is required
                                                    </p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                           
                                
                            </tr>
                        </table>

                        <hr>
                        
                        <div class="mb-3">
                <label for="attachment" class="col-form-label"><span class="text-primary">
                    Attachment:
                </span></label>
                <input type="file" class="form-control" name="c_attachment" required/>
            </div>
                        <hr>

                        <div class="field grouped">
                            <div class="control">
                                <button type="submit" class="button green" name="submit">
                                    Submit
                                </button>
                            </div>
                            <div class="control">
                                <button type="reset" class="button red">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </section>


        <footer class="footer">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                <div class="flex items-center justify-start space-x-3">
                    <div>
                        © 2021, Sam.me
                    </div>


                </div>
        </footer>

        <div id="sample-modal" class="modal">
            <div class="modal-background --jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Sample modal</p>
                </header>
                <section class="modal-card-body">
                    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
                    <p>This is sample modal</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button --jb-modal-close">Cancel</button>
                    <button class="button red --jb-modal-close">Confirm</button>
                </footer>
            </div>
        </div>

        <div id="sample-modal-2" class="modal">
            <div class="modal-background --jb-modal-close"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Sample modal</p>
                </header>
                <section class="modal-card-body">
                    <p>Lorem ipsum dolor sit amet <b>adipiscing elit</b></p>
                    <p>This is sample modal</p>
                </section>
                <footer class="modal-card-foot">
                    <button class="button --jb-modal-close">Cancel</button>
                    <button class="button blue --jb-modal-close">Confirm</button>
                </footer>
            </div>
        </div>

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