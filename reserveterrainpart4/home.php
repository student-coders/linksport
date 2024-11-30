<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Link Sport</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style/style1.css">
  </head>
  <body>
    <div class="grid-container">

      <!-- Header -->
      <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
          <span class="material-icons-outlined">menu</span>
        </div>
        <div class="header-left">
          <span class="material-icons-outlined"></span>
        </div>
        <div class="header-right">
          <span class="material-icons-outlined">notifications</span>
          <span class="material-icons-outlined">email</span>
          <span class="material-icons-outlined">account_circle</span>
        </div>
      </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">sports_soccer</span> link sport
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="terrainsreserves.php" target="_blank">
              <span class="material-icons-outlined">calendar_today</span> reservation
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">attach_money</span> TARIFS
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="#" target="_blank">
              <span class="material-icons-outlined">location_on</span> TERRAINS
            </a>
          </li>
        
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>reservation</h2>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <a href="terrainsreserves.php">
              <h3>reservation</h3>
              <span class="material-icons-outlined">calendar_today</span>
            </div>
            <h1></h1>
          </div>

          <div class="card">
            <div class="card-inner">
              <h3>TARIFS</h3>
              <span class="material-icons-outlined">attach_money</span>
            </div>
            <h1></h1>
          </div>
          <div class="card">
            <div class="card-inner">
              <h3>TERRAINS</h3>
              <span class="material-icons-outlined">location_on</span>
            </div>
            <h1></h1>
          </div>

         
      </main>
      <!-- End Main -->

    </div>

    
  </body>
</html>