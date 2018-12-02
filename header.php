<style>
.bg-black {
  background-color: #24292e;
}
.bg-grey {
  background-color: #3f4448;
  border: none;
  height: 32px;
}
.nav-form {
  margin-top: 5px;
  border-radius: 4px;
}
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
<div class="container">
<a class="navbar-brand" href="/"><img src="/favicon.ico" height=30px;></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/about">About Us</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="" id="project" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Community
        </a>
        <div class="dropdown-menu" aria-labelledby="project">
          <a class="dropdown-item" href="/forum?question=ask">Ask a Question</a>
          <a class="dropdown-item" href="/forum?question=browse">Browse the forum</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/forum?question=answer">Answer a Question</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <!--
<form method="POST" class="bg-grey nav-form">
      <input class="form-control mr-sm-2 bg-grey" type="search" placeholder="Search Projects" aria-label="Search">
    </form>
        -->
      <?php
        if (!isset($_SESSION['user'])) {
          ?>
            <li class="nav-item active">
              <a class="nav-link" href="/user/login">Login</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/user/register">Register</a>
            </li>
          <?php
        } else {
          require_once 'dbconnect.php';
          $useid = $_SESSION['user'];
          $sql = $conn->query("SELECT * FROM users WHERE id = '".$useid."'");
          $userRow = mysqli_fetch_assoc($sql);
          if (isset($_GET['logout'])) {
              unset($_SESSION['user']);
              header('Location: '. $_SERVER['PHP_SELF']);
          }
          ?>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="" id="account" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="/profile.png" height=30px;>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item">Signed in as <strong><?php echo $userRow['username']?></strong></li>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/user/dashboard">Dashboard</a>
                <a class="dropdown-item" href="/user/profile">Profile</a>
                <a class="dropdown-item" href="/user/paste">Create Paste</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?logout">Logout</a>
              </ul>
            </li>
          <?php
        }
      ?>
    </ul>
    
  </div>
</div>
</nav>