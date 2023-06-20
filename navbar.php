<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">JoDer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if (isset($_SESSION['email'])) : ?>
          <li class="nav-item">
            <a class="nav-link" href="job-listing.php">Job Listing</a>
          </li>
          <?php if (isset($_SESSION['type']) && $_SESSION['type'] == 2) : ?>
            <li class="nav-item">
              <a class="nav-link" href="job-offer-form.php">Looking For Employee</a>
            </li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?= isset($_SESSION['email']) ? "logout.php" : "login-form.php" ?>"><?= isset($_SESSION['email']) ? "Logout" : "Login" ?></a>
        </li>
        <?php
        if (!isset($_SESSION['email'])) {
          echo "<li class=\"nav-item\">";
          echo "  <a class=\"nav-link\" href=\"register-form.php\">Register</a>";
          echo "</li>";
        }
        ?>
      </ul>
      <?php if ($_SERVER['SCRIPT_NAME'] == "/job-listing.php") : ?>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-danger" type="submit">Search</button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</nav>