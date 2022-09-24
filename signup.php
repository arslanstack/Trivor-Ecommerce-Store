<?php
session_start();

if (isset($_POST['username'])) {
  require 'config.php';

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $pswd = mysqli_real_escape_string($conn, md5($_POST['pswd']));
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
  // $_SESSION['timezone'] = date_default_timezone_get();
  $token = bin2hex(random_bytes(15));
  $status = "Inactive";
  $_SESSION['vpin'] = mt_rand(1000, 9999);
  $vpin = md5($_SESSION['vpin']);

  $sql = "SELECT email FROM userdata WHERE email = '{$email}'";
  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      $_SESSION['signuperror'] = "Email Already Exists";
      header("Location: signupagain.php");
    } else {
      $sql = "SELECT username FROM userdata WHERE username = '{$username}'";
      if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          $_SESSION['signuperror'] = "Username Already Exists";
          header("Location: signupagain.php");
        } else {

          $sql = "INSERT INTO userdata (username, pswd, name, email,  phone, token, status, vpin)
            VALUES ('{$username}', '{$pswd}', '{$name}', '{$email}', '{$phone}', '{$token}', '{$status}', '{$vpin}')";

          if (mysqli_query($conn, $sql)) {
            $sql = "INSERT INTO attempt (email, attempt, state) VALUES ('{$email}','0','normal')";
            if (mysqli_query($conn, $sql)) {
              // echo "New record created successfully";
              //Import PHPMailer classes into the global namespace
              //These must be at the top of your script, not inside a function
              require 'activationmail.php';
              mailed($email, $username, $name, $token);
            } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        }
      } else {
        echo "Email fetching error";
      }
    }
  } else {
    echo "Oops! Something went wrong. Please try again later.";
  }

  // mysqli_close($conn);
  // header("Location: index.php");

}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <title>Rakaposhi</title>
  <!-- Custom CSS -->
  <link rel="stylesheet" href="signup.css">
</head>

<body>
  <section class="container-fluid topsection">
    <nav class="navbar navbar-expand-lg navbar-light" id="topnav">
      <a class="navbar-brand pt-0" id="brand" href="#"><img src="assets/imgs/logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" style="font-weight: 700;" href="index.php">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" style="font-weight: 700;" href="shop.php">SHOP<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" style="font-weight: 700;" href="#">ABOUT US <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" style="font-weight: 700;" href="#">CONTACT <span class="sr-only">(current)</span></a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
              <a class="nav-link" style="font-weight: 700;" href="login.php">LOGIN<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link btn btn-outline-light" id="topbtn" href="cart.php"><svg width="29" height="29" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.586 17.586a2 2 0 1 1 2.828 2.828 2 2 0 0 1-2.828-2.828Z"></path>
                  <path d="M8.414 20.414a2 2 0 1 0-2.828-2.828 2 2 0 0 0 2.828 2.828Z"></path>
                  <path d="m7 13-2.293 2.293c-.63.63-.184 1.707.707 1.707H17"></path>
                  <path d="M5.4 5H21l-4 8H7L5.4 5Z"></path>
                  <path d="M3 3h2l.4 2"></path>
                </svg><span class="sr-only">(current)</span></a>
            </li>

          </ul>
        </form>
      </div>
    </nav>
  </section>
  <br><br>
  <div class="container">
    <div class="row">
      <section class="vh-100">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
              <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                  <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                      <form class="mx-1 mx-md-4" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example1c" class="form-control" placeholder="Username" name="username" required>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <input type="password" id="form3Example1c" class="form-control" placeholder="Password" name="pswd" required>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <input type="text" id="form3Example1c" class="form-control" placeholder="Full Name" name="name" required>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <input type="email" id="form3Example1c" class="form-control" placeholder="Email" name="email" required>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                            <input type="phone" id="form3Example1c" class="form-control" placeholder="Phone" name="phone" required>
                          </div>
                        </div>


                        <div class="form-check d-flex  mb-3">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                          <label class="form-check-label" for="flexCheckChecked">
                            I agree to <a href="#">Terms and Conditions</a>
                          </label>
                        </div>

                        <div class="">
                          <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                        <br>
                        <div>
                          <p class="mb-1 pb-lg-2" style="color: #393f81;">Already have an account? <a href="login.php" style="color: #393f81;">Sign In</a></p>
                        </div>
                      </form>


                    </div>
                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                      <img src="assets/imgs/cover2.webp" class="img-fluid" alt="Sample image">


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <br><br><br><br>
    </div>
  </div>
  <footer class="page-footer pt-4" style="background-color: #E3E6F3;
        margin-top: 48px;
    ">
    <section class="container" id="footing">

      <!-- Footer Links -->
      <div class="container-fluid text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-md-6 mt-md-0 mt-3" id="paragraph1">

            <!-- Content -->
            <div class="row">
              <a class="navbar-brand pt-0" id="brand" href="#"><img src="assets/imgs/logo.png" alt=""></a>
            </div>

            <div class="row">
              <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur laborum quasi alias
                totam
                provident quidem distinctio possimus, autem itaque odit qui deserunt dolor facilis! Odit
                dolorem assumenda eius magnam accusantium!</p>
            </div>
            <div class="row">
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M22.5 12.063c0-5.799-4.702-10.5-10.5-10.5s-10.5 4.7-10.5 10.5c0 5.24 3.84 9.584 8.86 10.373v-7.337H7.692v-3.037h2.666V9.75c0-2.63 1.568-4.085 3.966-4.085 1.15 0 2.351.205 2.351.205v2.584h-1.324c-1.304 0-1.712.81-1.712 1.64v1.97h2.912l-.465 3.036H13.64v7.337c5.02-.788 8.859-5.131 8.859-10.373Z" clip-rule="evenodd"></path>
              </svg>
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.25 5.133a9.46 9.46 0 0 1-2.65.717 4.57 4.57 0 0 0 2.03-2.512c-.908.53-1.9.903-2.932 1.101A4.647 4.647 0 0 0 16.327 3c-2.55 0-4.615 2.034-4.615 4.542a4.37 4.37 0 0 0 .119 1.036A13.158 13.158 0 0 1 2.315 3.83a4.485 4.485 0 0 0-.627 2.283c0 1.574.821 2.967 2.062 3.782a4.57 4.57 0 0 1-2.1-.567v.056c0 2.204 1.595 4.036 3.704 4.454a4.752 4.752 0 0 1-1.216.159c-.291 0-.582-.028-.868-.085.587 1.805 2.294 3.118 4.315 3.155a9.356 9.356 0 0 1-6.835 1.88A13.063 13.063 0 0 0 7.816 21c8.501 0 13.146-6.923 13.146-12.928 0-.197-.006-.394-.015-.586a9.304 9.304 0 0 0 2.303-2.353Z">
                </path>
              </svg>
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.375 3.25a4.388 4.388 0 0 1 4.375 4.375v8.75a4.388 4.388 0 0 1-4.375 4.375h-8.75a4.389 4.389 0 0 1-4.375-4.375v-8.75A4.388 4.388 0 0 1 7.625 3.25h8.75Zm0-1.75h-8.75C4.256 1.5 1.5 4.256 1.5 7.625v8.75c0 3.369 2.756 6.125 6.125 6.125h8.75c3.369 0 6.125-2.756 6.125-6.125v-8.75c0-3.369-2.756-6.125-6.125-6.125Z">
                </path>
                <path d="M17.688 7.625a1.313 1.313 0 1 1 0-2.625 1.313 1.313 0 0 1 0 2.625Z"></path>
                <path d="M12 8.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Zm0-1.75a5.25 5.25 0 1 0 0 10.5 5.25 5.25 0 0 0 0-10.5Z">
                </path>
              </svg>
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M23.843 6.975c0-2.11-1.552-3.807-3.469-3.807A170.465 170.465 0 0 0 12.422 3h-.844c-2.7 0-5.353.047-7.95.169-1.912 0-3.464 1.706-3.464 3.815A69.732 69.732 0 0 0 0 11.99a72.582 72.582 0 0 0 .16 5.011c0 2.11 1.551 3.82 3.464 3.82 2.728.127 5.526.183 8.372.178 2.85.01 5.64-.05 8.371-.178 1.918 0 3.47-1.71 3.47-3.82a72.41 72.41 0 0 0 .159-5.016 68.19 68.19 0 0 0-.153-5.01Zm-14.14 9.614V7.378L16.5 11.98l-6.797 4.608Z">
                </path>
              </svg>
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.82 1.5H3.294c-.957 0-1.794.69-1.794 1.635v17.566c0 .951.837 1.799 1.794 1.799h17.521c.963 0 1.685-.854 1.685-1.8V3.136c.006-.946-.722-1.635-1.68-1.635ZM8.01 19.005H5V9.65h3.01v9.354ZM6.61 8.228h-.022c-.963 0-1.586-.716-1.586-1.613C5.002 5.7 5.642 5 6.626 5c.984 0 1.587.695 1.608 1.614 0 .897-.624 1.613-1.625 1.613Zm12.395 10.777h-3.009V13.89c0-1.225-.438-2.063-1.526-2.063-.832 0-1.324.563-1.543 1.111-.082.197-.104.465-.104.739v5.328H9.815V9.65h3.008v1.301c.438-.623 1.122-1.52 2.713-1.52 1.975 0 3.469 1.301 3.469 4.108v5.465Z">
                </path>
              </svg>
              <svg width="25" height="25" fill="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="m22.18 10.382-.107-.45h-9.77v4.136h5.838c-.606 2.878-3.419 4.393-5.716 4.393-1.672 0-3.434-.703-4.6-1.833a6.566 6.566 0 0 1-1.96-4.636c0-1.741.783-3.484 1.922-4.63 1.14-1.146 2.86-1.787 4.57-1.787 1.96 0 3.363 1.04 3.888 1.514l2.939-2.923c-.862-.757-3.23-2.666-6.922-2.666-2.847 0-5.578 1.09-7.574 3.08C2.718 6.54 1.7 9.372 1.7 12s.965 5.32 2.874 7.294C6.613 21.399 9.5 22.5 12.475 22.5c2.706 0 5.27-1.06 7.1-2.984 1.796-1.894 2.726-4.514 2.726-7.261 0-1.156-.116-1.843-.122-1.873Z">
                </path>
              </svg>
              <svg width="25" height="25" stroke="black" style="margin-right: 8px;" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.424 4.58a10.5 10.5 0 1 0-14.85 14.85 10.5 10.5 0 1 0 14.85-14.85ZM2.999 12.006c0-.796.106-1.59.314-2.358.345.74.844 1.38 1.184 2.14.44.977 1.619.706 2.14 1.562.462.76-.032 1.721.314 2.516.251.577.844.703 1.253 1.125.417.426.408 1.009.472 1.564a14.316 14.316 0 0 0 .353 1.949c-3.508-1.232-6.03-4.576-6.03-8.498Zm9 9a9.062 9.062 0 0 1-1.5-.125c.006-.127.008-.246.02-.328.114-.746.488-1.475.991-2.032.497-.55 1.179-.923 1.599-1.547.412-.61.535-1.43.365-2.142-.25-1.052-1.679-1.403-2.45-1.973-.442-.329-.837-.836-1.418-.877-.269-.019-.493.039-.759-.03-.244-.063-.435-.194-.695-.16-.485.064-.79.582-1.312.512-.495-.066-1.004-.645-1.117-1.116-.144-.606.335-.802.848-.856.215-.023.455-.047.66.032.272.1.4.365.643.5.456.25.548-.15.479-.555-.105-.607-.227-.854.314-1.271.375-.288.696-.496.636-1.013-.036-.304-.202-.441-.047-.744.118-.23.44-.438.65-.575.544-.354 2.328-.328 1.6-1.32-.215-.29-.61-.811-.985-.883-.469-.088-.677.435-1.004.666-.337.238-.994.51-1.332.14-.455-.496.301-.659.468-1.006.078-.161 0-.386-.13-.597.17-.072.341-.138.516-.199.11.081.24.13.375.141.313.02.61-.149.883.065.304.234.523.53.926.603.39.071.803-.156.9-.555.058-.243 0-.5-.057-.75a8.945 8.945 0 0 1 4.922 1.51c-.094-.036-.206-.032-.344.032-.285.132-.688.469-.721.803-.038.378.52.432.786.432.398 0 .802-.178.674-.639-.056-.2-.132-.407-.255-.533.295.205.576.426.844.663l-.012.013c-.27.281-.584.504-.769.846a.741.741 0 0 1-.54.418c-.146.034-.312.047-.434.144-.34.267-.146.91.176 1.102.406.243 1.009.129 1.315-.218.24-.272.381-.744.812-.744.19 0 .372.074.507.207.178.185.143.357.18.588.068.41.43.187.65-.02.16.286.304.58.432.88-.242.349-.434.728-1.016.322-.348-.243-.562-.596-1-.706-.381-.093-.773.004-1.15.07-.429.074-.938.107-1.263.432-.314.313-.48.732-.816 1.046-.647.61-.92 1.275-.501 2.136.403.829 1.246 1.278 2.156 1.22.894-.06 1.823-.579 1.797.72-.01.46.087.778.228 1.205.13.394.122.775.151 1.182.03.476.104.948.223 1.41a8.989 8.989 0 0 1-7.099 3.474Z">
                </path>
              </svg>
              <svg width="25" height="25" fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" stroke-width="6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.25 2.25H3.75A2.25 2.25 0 0 0 1.5 4.5v15a2.25 2.25 0 0 0 2.25 2.25h16.5a2.25 2.25 0 0 0 2.25-2.25v-15a2.25 2.25 0 0 0-2.25-2.25Z">
                </path>
                <path d="m4.5 5.25 3.75 3-3.75 3"></path>
                <path d="M9 11.25h3"></path>
              </svg>

            </div>


          </div>
          <!-- Grid column -->

          <hr class="clearfix w-100 d-md-none pb-3">

          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">

            <!-- Links -->
            <h5 class="text-uppercase">Our Products</h5>

            <ul class="list-unstyled">
              <li>
                <a style="color: black;" href="shop.php">Clothes</a>
              </li>
              <li>
                <a style="color: black;" href="shop.php">Shoes</a>
              </li>
              <li>
                <a style="color: black;" href="shop.php">Glasses</a>
              </li>
              <li>
                <a style="color: black;" href="shop.php">Accessories</a>
              </li>
            </ul>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">

            <!-- Links -->
            <h5 class="text-uppercase">Useful Links</h5>

            <ul class="list-unstyled">
              <li>
                <a style="color: black;" href="#!">Careers</a>
              </li>
              <li>
                <a style="color: black;" href="#!">Social</a>
              </li>
              <li>
                <a style="color: black;" href="./../trivor/moderator/">Moderator</a>
              </li>
              <li>
                <a style="color: black;" href="./../trivor/admin/">Admin</a>
              </li>
            </ul>

          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </div>
      <!-- Footer Links -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2022 Copyright:
        <a style="color: black;" href="http://github.com/arslanstack">Muhammad Arslan</a>
      </div>
      <!-- Copyright -->

  </footer>

  <!-- JS Popper Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>