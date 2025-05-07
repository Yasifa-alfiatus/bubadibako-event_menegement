<?php include(".layouts/header.php"); ?>

<!-- Tambahkan style khusus -->
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
  }
</style>

<!-- Register Card -->
<div class="card">
  <div class="card-body">
    <!-- Logo -->
    <div class="app-brand justify-content-center mb-4 text-center">
      <span class="app-brand-text text-uppercase">Event Management</span>
    </div>

    <form action="register_process.php" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required />
      </div>
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" required />
      </div>
      <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
          <input type="password" class="form-control" name="password" placeholder="" required />
          <span class="input-group-text"><i class="bx bx-hide"></i></span>
        </div>
      </div>
      <button type="submit" class="btn btn-primary d-grid w-100">Daftar</button>
    </form>

    <p class="text-center mt-3">
      Sudah memiliki akun? <a href="login.php"><strong>Masuk</strong></a>
    </p>
  </div>
</div>
<?php include(".layouts/footer.php"); ?>