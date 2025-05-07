<?php include(".layouts/header.php"); ?>

<!-- Styling tambahan khusus halaman login -->
<style>
  body {
    background: linear-gradient(to right, #f8c8dc, #f4a4be);
    font-family: 'Poppins', sans-serif;
  }

  .card {
    max-width: 450px;
    margin: 60px auto;
    border: none;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
  }

  .card-body {
    padding: 2rem;
  }

  .btn-primary {
    background-color: #d63384;
    border-color: #d63384;
  }

  .btn-primary:hover {
    background-color: #c2186a;
    border-color: #c2186a;
  }

  .app-brand-text {
    color: #d63384;
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
    display: block;
    text-align: center;
  }

  a {
    color: #d63384;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  .form-label {
    font-weight: 500;
  }

  .input-group-text {
    background-color: #fce4ec;
    border-color: #f8bbd0;
    cursor: pointer;
  }
</style>

<!-- Tambah link boxicons buat icon mata -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<!-- Login Card -->
<div class="card">
  <div class="card-body">
    <div class="mb-4">
      <span class="app-brand-text">EVENT MANAGEMENT</span>
    </div>

    <h4 class="mb-3 text-center">Selamat Datang Di Event Management 👋</h4>
    <form class="mb-3" action="login_auth.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" autofocus required />
      </div>
      <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
          <input type="password" class="form-control" name="password" id="password" placeholder="••••••••••••" required />
          <span class="input-group-text" onclick="togglePassword()">
            <i id="toggleIcon" class="bx bx-hide"></i>
          </span>
        </div>
      </div>
      <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
    </form>

    <p class="text-center mt-3">
      <span>Belum punya akun?</span> <a href="register.php"><strong>Daftar</strong></a>
    </p>
  </div>
</div>
<!-- /Login Card -->

<!-- Script buat toggle password -->
<script>
  function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (password.type === "password") {
      password.type = "text";
      icon.classList.replace("bx-hide", "bx-show");
    } else {
      password.type = "password";
      icon.classList.replace("bx-show", "bx-hide");
    }
  }
</script>

<?php include(".layouts/footer.php"); ?>