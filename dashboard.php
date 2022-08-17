



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

         <?php

              include "db.php"; // Using database connection file here


              $records = mysqli_query($conn, "select c_enddate,c_title,status from contractor"); // fetch data from database

              while ($data = mysqli_fetch_array($records)) {
                $now = date('y-m-d');
              $future = strtotime($now); //Future date.
              $timefromdb = $data['c_enddate'];
              $timefromdb1 = strtotime($timefromdb);
              $timeleft = $timefromdb1-$future;
              $daysleft = round((($timeleft/24)/60)/60); 
              $c_title = $data['c_title'];
              $status = $data['status'];
              if ($daysleft<=10 && $status == 'Going') {



               ?>
               <div class="notification red">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                  <div>
                    <span class="icon"><i class="mdi mdi-credit-card-outline"></i></span>
                    <b><?php echo $c_title." Contract Remaining days are: ".$daysleft." Days" ?></b>
                  </div>
                  &nbsp &nbsp&nbsp&nbsp&nbsp 
                  <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                </div>
              </div>
              <?php
            }}

            ?>


          </div>
        </section>

        <section class="is-hero-bar">
          <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
              Dashboard
            </h1>

          </div>
        </section>

        <section class="section main-section">
          <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
            <div class="card">
              <div class="card-content">
                <div class="flex items-center justify-between">
                  <div class="widget-label">
                    <h3>
                      Total Active Contracts
                    </h3>
                    <h1>
                      <?php
                      $con = mysqli_connect("localhost", "root", "", "contract"); 

// Check connection 
                      if (mysqli_connect_errno()) { 
                        echo "Database connection failed."; 
                      } 
// Fetch Query
                      $query = "SELECT c_manager FROM contractor"; 

// Execute the query and store the result set 
                      $result = mysqli_query($con, $query); 

                      if ($result) { 
  // it return number of rows in the table. 
                        $row = mysqli_num_rows($result); 
                        if ($row) { 
                         printf($row); 
                       } 
                       else
                       {
                        printf(0);
                      }
  // close the result. 
                      mysqli_free_result($result); 
                    }
                    ?>
                  </h1>
                </div>
                <span class="icon widget-icon text-green-500"><i class="mdi mdi-account-multiple mdi-48px"></i></span>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-content">
              <div class="flex items-center justify-between">
                <div class="widget-label">
                  <h3>
                    Total number of Inactive Contracts
                  </h3>
                  <h1>
                    <?php
                    $con = mysqli_connect("localhost", "root", "", "contract"); 

// Check connection 
                    if (mysqli_connect_errno()) { 
                      echo "Database connection failed."; 
                    } 
// Fetch Query
                    $query = "SELECT c_attachment FROM contracts"; 

// Execute the query and store the result set 
                    $result = mysqli_query($con, $query); 

                    if ($result) { 
  // it return number of rows in the table. 
                      $row = mysqli_num_rows($result); 
                      if ($row) { 
                       printf($row); 
                     } 
                     else
                     {
                      printf(0);
                    }
  // close the result. 
                    mysqli_free_result($result); 
                  }
                  ?>
                </h1>
              </div>
              <span class="icon widget-icon text-blue-500"><i class="mdi mdi-finance mdi-48px"></i></span>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <h3>
                  Welcome
                </h3>
                <h1>
                  <?php echo $_SESSION['username']; ?>
                </h1>
              </div>
              <span class="icon widget-icon text-red-500"><i class="mdi mdi-finance mdi-48px"></i></span>
            </div>
          </div>
        </div>
      </div>


      <div class="notification blue">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div>
            <span class="icon"><i class="mdi mdi-buffer"></i></span>
            <b>All running contracts</b>
          </div>
          <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
        </div>
      </div>

      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            All running contracts
          </p>
          <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a>
        </header>
        <div class="card-content">
          <table id="dataTable" class="table table-bordered">
            <thead>
              <tr>
                <th>Contract Number</th>
                <th>Contract Title</th>
                <th>Contracter (client)</th>
                <th>Contracter (Partner)</th>
                <th>Contracter (SP)</th>
                <th>Contract Amount</th>
                <th>Contracter Signing Date</th>
                <th>Contract Manager</th>
                <th>Contract End Date</th>
                <th>Attachment</th>
                <th>Status</th>
                <th>Days remains</th>
                <th><div class="btn-group pull-right">
                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export <span class="caret"></span></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a class="dataExport" data-type="csv">CSV</a></li>
                    <li><a class="dataExport" data-type="excel">XLS</a></li>          
                    <li><a class="dataExport" data-type="txt">TXT</a></li>              
                  </ul>
                </div></th>
                
              </tr>
            </thead>
            <tbody>

              <?php

              include "db.php"; // Using database connection file here


              $records = mysqli_query($conn,  "SELECT *   
                FROM contractor order by c_date desc"); // fetch data from database

              while ($data = mysqli_fetch_array($records)) {
                ?>
                <tr>

                  <td data-label="Number"><?php echo $data['c_number']; ?></td>
                  <td data-label="Title"><?php echo $data['c_title']; ?></td>
                  <td data-label="Client"><?php echo $data['c_client']; ?></td>
                  <td data-label="Partner"><?php echo $data['c_partner']; ?></td>
                  <td data-label="Number"><?php echo $data['c_sp']; ?></td>
                  <td data-label="Number"><?php echo $data['c_amount']; ?></td>
                 <td data-label="Number"><?php echo $data['c_date']; ?></td>
                  <td data-label="Number"><?php echo $data['c_manager']; ?></td>
                   <td data-label="Number"><?php echo $data['c_enddate']; ?></td>
                  <td data-label="Number"><a target='_blank' href='myfile/<?php echo $data['c_attachment'];?>'><u>View</u></a></td>
                  <td data-label="Number"><span class="badge progress-bar-success"><?php echo $data['status']; ?></span></td>
                  <td data-label="Number"><?php



              $now = date('y-m-d');
              $c_number = $data['c_number'];
              $future = strtotime($now); //Future date.
              $timefromdb = $data['c_enddate'];
              $timefromdb1 = strtotime($timefromdb);
              $timeleft = $timefromdb1-$future;
              $dayscount = round((($timeleft/24)/60)/60); 
              $c_title = $data['c_title'];
              if ($dayscount<0) {
                $sql =   "INSERT INTO contracts SELECT * FROM contractor WHERE c_number='$c_number';";
                $sql .=  "DELETE FROM contractor WHERE c_number='$c_number'; ";
                $sql .=  "UPDATE contracts SET status ='Ended' WHERE c_number='$c_number'; "; 
                if (!$conn->multi_query($sql)) {
                    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
                }
                else{
                    header("Location:dashboard.php");
                }
              }
              elseif ($dayscount<=10) {
               ?>
               
                    <b><span class="badge progress-bar-danger"><?php echo $dayscount." Days" ?></b></span>
                  
                   
                  
                </div>
              </div>
              <?php
            }
            else
            {?>
              <b><span class="badge progress-bar-info"><?php echo $dayscount." Days" ?></b></span>

            <?php }

            ?>
                    








                  </td>
                  <td class="actions-cell">
                    <div class="buttons right nowrap"><a href="view.php?c_number=<?php echo $data['c_number']; ?>">
                      <button class="button medium green --jb-modal"  type="button">
                        <span class="icon"><i class="mdi mdi-eye"></i></span></a>
                      </button><a href="delete.php?c_number=<?php echo $data['c_number']; ?>">
                        <button class="button medium red --jb-modal" type="button">
                          <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                        <div class="buttons right nowrap"><a href="contractRenew.php?c_number=<?php echo $data['c_number']; ?>">
                          <button class="button medium btn-info" type="button">
                            <span class="icon"><i class="mdi mdi-plus"></i></span></a> 
                          </button>

                        </div>
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
        <div class="notification blue">
          <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <div>
              <span class="icon"><i class="mdi mdi-buffer"></i></span>
              <b>Ended Contracts</b>
            </div>
            <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
          </div>
        </div>
        <div class="card has-table">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              Ended Contracts
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


              $records = mysqli_query($conn,  "SELECT *   
                FROM contracts 
               order by c_date desc");
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
                  <td data-label="Number"><a target='_blank' href='myfile/<?php echo $data['c_attachment'];?>'>view</a></td>
                  
                    <td data-label="Number"><span class="badge progress-bar-danger"><?php echo $data['status']; ?></span></td>
                  <td class="actions-cell">
                    <a href="deleteEnded.php?c_number=<?php echo $data['c_number']; ?>">
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
      <footer class="footer">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
          <div class="flex items-center justify-start space-x-3">
            <div>
              © 2021, Sam.me
            </div>

            <div>
              <p>Distributed By: <a href="www.samdomain.com" target="_blank">SamKinnon</a></p>
            </div>

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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script type="text/javascript" src="js/chart.sample.min.js"></script>

    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1" /></noscript>

    <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

  </body>
  </html>