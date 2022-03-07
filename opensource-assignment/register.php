<?php
include "dbconnection.php";
if (isset($_SESSION['login_user'])) {
    header("Location: index.php");
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassowrd = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "$email is not a valid email address");

    }
    if (empty($username)) {array_push($errors, "Username is required");}
    if (empty($email)) {array_push($errors, "Email is required");}

    if (empty($mypassword)) {array_push($errors, "Password is required");}
    if ($mypassword != $confirmpassowrd) {
        array_push($errors, "The two passwords do not match");

    }
    $user_check_query = "SELECT * FROM users WHERE username='$myusername' OR email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $pass = password_hash($mypassword, PASSWORD_DEFAULT);
    if ($user) { // if user exists
        if ($user['username'] === $myusername) {
            array_push($errors, "Username already exists");

        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");

        }
    }
    if (count($errors) == 0) {
        $query = "INSERT INTO users (username, email, password)
            VALUES('$myusername', '$email', '$pass' )";
        mysqli_query($conn, $query);

        header('location: index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="favicon.ico" />

    <title>Register | Apache CouchDB</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/logo.png" alt="couchdb" width="250" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php"
                >Introduction</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          </ul>

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container py-5">

      <!-- <div class="row"> -->
      <!-- <div class="col-md-4"> -->
      <h2 class="display-5 fw-bold text-center">User Registration</h2>
      <form action="" method="post" class="my-3">
      <?php if (count($errors) > 0): ?>
      <div class="error">
        <?php foreach ($errors as $error): ?>
          <p style="color:red;"><?php echo $error ?></p>
        <?php endforeach?>
      </div>
    <?php endif?>
        <div class="form-group mb-3">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Username"
          />
        </div>
        <div class="form-group mb-3">
          <label for="username" class="form-label">Email</label>
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="email"
          />
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Password"
          />
        </div>
        <div class="form-group mb-3">
          <label for="password" class="form-label">Confirm Password</label>
          <input
            type="password"
            class="form-control"
            id="confirm_password"
            name="confirm_password"
            placeholder="Password"
          />
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <!-- </div> -->
      <!-- </div> -->

      <hr />
    </div>
    <!-- /container -->

    <footer
      class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top"
    >
      <div class="col-md-4 d-flex align-items-center">
        <a
          href="/"
          class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1"
        >
          <svg class="bi" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>
        <span class="text-muted">© 2022 Open Source Technology</span>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3">
          <a class="text-muted" href="#"
            ><svg class="bi" width="24" height="24">
              <use xlink:href="#twitter"></use></svg
          ></a>
        </li>
        <li class="ms-3">
          <a class="text-muted" href="#"
            ><svg class="bi" width="24" height="24">
              <use xlink:href="#instagram"></use></svg
          ></a>
        </li>
        <li class="ms-3">
          <a class="text-muted" href="#"
            ><svg class="bi" width="24" height="24">
              <use xlink:href="#facebook"></use></svg
          ></a>
        </li>
      </ul>
    </footer>
    <!-- /footer -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
