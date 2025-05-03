<!-- sidemenu.php -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
  .sidemenu {
    width: 220px;
    height: 100vh;
    position: fixed;
    background-color: #c4587c; /* pink tua */
    color: white;
    top: 0;
    left: 0;
    padding: 30px 20px;
    font-family: 'Poppins', sans-serif;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
  }

  .sidemenu h4 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 600;
    letter-spacing: 1px;
    font-size: 20px;
  }

  .sidemenu a {
    color: white;
    display: block;
    margin: 12px 0;
    text-decoration: none;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 6px;
    transition: all 0.3s ease;
  }

  .sidemenu a:hover {
    background-color: rgba(255,255,255,0.2);
    padding-left: 20px;
  }
</style>

<div class="sidemenu">
  <h4>EVENT MANEGEMENT</h4>
  <a href="dashboard.php">Dashboard</a>
  <a href="posts.php">Event</a>
  <a href="partisipan.php">Partisipan</a>
  <a href="pendaftaran_event.php">Pendaftaran</a>
  <a href="auth/logout.php" onclick="return confirm('Apakah Anda yakin ingin keluar?');" style="color:white; display:block; margin:10px 0;">Logout</a>
</div>