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
  <title>Dashboard - Main Page</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1628755089081">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6" />

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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tableExport/tableExport.js"></script>
<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
<script src="js/export.js"></script>
</head>

<body>

  <div id="app">

    <nav id="navbar-main" class="navbar is-fixed-top">
      <div class="navbar-brand">
        <a class="navbar-item mobile-aside-button">
          <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
        </a>
        <div class="navbar-item">
          <div class="control"><input placeholder="Search everywhere..." class="input"></div>
        </div>
      </div>
      <div class="navbar-brand is-right">
        <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
          <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
        </a>
      </div>
      <div class="navbar-menu" id="navbar-menu">
        <div class="navbar-end">
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
              <a class="navbar-item" href="logout.php">
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
            <a href="logout.php">
              <span class="icon"><i class="mdi mdi-lock"></i></span>
              <span class="menu-item-label">Logout</span>
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
                <a href="renewed.php">
                  <span>Renewed Contract</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <p class="menu-label">About</p>
        <ul class="menu-list">

          <li>
            <a href="logout.php">
              <span class="icon"><i class="mdi mdi-lock"></i></span>
              <span class="menu-item-label">Logout</span>
            </a>
          </li>

        </ul>
      </div>
    </aside>


    <section class="is-title-bar">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
        <ul>
          <li>Admin</li>
          <li>Dashboard</li>
        </ul>

      </div>
    </section>

    <section class="is-hero-bar">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
        <h1 class="title">
          Dashboard
        </h1>
        
      </div>
    </section>
    <div class="notification blue">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div>
            <span class="icon"><i class="mdi mdi-buffer"></i></span>
            <b>Renewed Contracts</b>
          </div>
          <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
        </div>
      </div>
      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Renewed Contracts
          </p>
          <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
        <div class="card-content">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Contract Number</th>
                <th>Contract Title</th>
                <th>Contracter (client)</th>
                <th>Contracter (Partner)</th>
                <th>Contracter (ServiceProvider)</th>
                <th>Contract Amount</th>
                <th>Contract End Date</th>
                <th>Contract Manager</th>
                <th>Contracter Signing Date</th>
                <th>Attachment</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php

              include "db.php"; // Using database connection file here


              $records = mysqli_query($conn, "SELECT contractor.c_number,contractor.c_title,contractor.c_client,
              contractor.c_partner,contractor.c_sp,contractor.c_amount,
              contracts.c_enddate,contractor.c_manager,contracts.c_date,contractor.status,contracts.c_attachments   
        FROM contractor  
        JOIN contracts  
        ON contractor.c_number = contracts.c_number order by c_date desc");
              while ($data = mysqli_fetch_array($records)) {
              ?>
                <tr>

                  <td data-label="Number"><?php echo $data['c_number']; ?></td>
                  <td data-label="Title"><?php echo $data['c_title']; ?></td>
                  <td data-label="Client"><?php echo $data['c_client']; ?></td>
                  <td data-label="Partner"><?php echo $data['c_partner']; ?></td>
                  <td data-label="Number"><?php echo $data['c_sp']; ?></td>
                  <td data-label="Number"><?php echo $data['c_amount']; ?></td>
                  <td data-label="Number"><?php echo $data['c_enddate']; ?></td>
                  <td data-label="Number"><?php echo $data['c_manager']; ?></td>
                  <td data-label="Number"><?php echo $data['c_date']; ?></td>
                  <td data-label="Number"><a target='_blank' href='myfile/<?php echo $data['c_attachments'];?>'>view</a></td>
                  <td data-label="Number"><?php echo $data['status']; ?></td>
                  <td class="actions-cell">
                    <div class="buttons right nowrap">
                      </button><a href="view.php?c_number=<?php echo $data['c_number']; ?>">
                        <button class="button medium red --jb-modal" type="button">
                          <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    </div>
                  </td>
                </tr>
            </tbody>
          <?php
              }
          ?>
          </table>
          <div class="table-pagination">
            <div class="flex items-center justify-between">
              <div class="buttons">
                <button type="button" class="button active">1</button>
                <button type="button" class="button">2</button>
                <button type="button" class="button">3</button>
              </div>
              <small>Page 1 of 3</small>
            </div>
          </div>
        </div>
      </div>
    </section>
 </body>


    <footer class="footer">
      <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div class="flex items-center justify-start space-x-3">
          <div>
            © 2021, Sam.me
          </div>

          <div>
            <p>Distributed By: <a href="#" target="_blank">SamKinnon</a></p>
          </div>

        </div>
      </div>
    </footer>
</html>