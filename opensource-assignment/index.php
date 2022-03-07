<?php
include 'dbconnection.php';
session_start();
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if ($name !== $_SESSION['login_user']) {
        array_push($errors, 'name doesnot match our records');
    } else {
        $query = "INSERT INTO comments (username, email, message)
                    VALUES('$name', '$email', '$message' )";

        if (mysqli_query($conn, $query)) {
            header("location: index.php");
        } else {
            array_push($errors, "error while inserting data");
        }

    }

    // If result matched $myusername and $mypassword, table row must be 1 row

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

    <title>Apache CouchDB</title>

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
              <a class="nav-link active" aria-current="page" href="#"
                >Introduction</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          </ul>
          </form>
          <?php
if (!isset($_SESSION['login_user'])) {
    ?>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
          <?php
} else {?>
    <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link"><?php echo $_SESSION['login_user']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
<?php
}?>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="starter-template my-3">
        <h1>Apache CouchDB</h1>
        <p class="lead">
          Apache CouchDB is a document-oriented database and within each
          document fields are stored as key-value maps. Fields can be either a
          simple key/value pair, list, or map.
        </p>
        <ul>
          <li>
            Easy replication of a database across multiple server instances
          </li>
          <li>Fast indexing and retrieval</li>
          <li>
            REST-like interface for document insertion, updates, retrieval and
            deletion JSON-based document format (easily translatable across
            different languages)
          </li>
          <li>
            Multiple libraries for your language of choice (show some of the
            popular language choices)
          </li>
          <li>Subscribable data updates on the _changes feed</li>
        </ul>
      </div>
      <?php
if (isset($_SESSION['login_user'])) {

    ?>

      <div class="row">
      <?php if (count($errors) > 0): ?>
        <div class="error">
          <?php foreach ($errors as $error): ?>
            <p style="color:red;"><?php echo $error ?></p>
          <?php endforeach?>
        </div>
      <?php endif?>
        <!-- <div class="col-md-4"> -->
        <h4>Comment</h4>
        <form action="" method="POST" class="my-3">
          <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              placeholder="Name"
            />
          </div>
          <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="Email"
            />
          </div>
          <div class="form-group mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea
              class="form-control"
              id="message"
              name="message"
              placeholder="Message"
            ></textarea>
          </div>
          <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
      </div>
      <!-- </div> -->
    <?php }?>
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
              <use xlink:href="#twitter"></use></svg></a>
        </li>
        <li class="ms-3">
          <a class="text-muted" href="#"
            ><svg class="bi" width="24" height="24">
              <use xlink:href="#instagram"></use></svg></a>
        </li>
        <li class="ms-3">
          <a class="text-muted" href="#"
            ><svg class="bi" width="24" height="24">
              <use xlink:href="#facebook"></use></svg></a>
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
