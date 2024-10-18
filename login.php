<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
<?php session_start(); include 'header.php' ?>

<?php


$file = 'data/user.txt';
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username']; 
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $errors[] = "Email and Password are required.";
    } else {
        if (file_exists($file)) {
            $lines = file($file);
            foreach ($lines as $line) {
                $data = explode('|', trim($line));
                $storedEmail = isset($data[4]) ? trim(str_replace("Email:", "", $data[4])) : null;
                $storedPassword = isset($data[6]) ? trim(str_replace("Password:", "", $data[6])) : null;

                if ($storedEmail === $email && $storedPassword === $password) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $success = true;
                    break;
                }
            }
        }
        
        if (!$success) {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<div class="login-container-fluid">
  <div class="row">
    <div class="authfy-container col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
      <div class="col-sm-5 authfy-panel-left">
        <div class="brand-col">
          <div class="welcome-message">
            <h1>Welcome Back!</h1>
            <p>We're glad to see you again. Please log in to your account.</p>
          </div>
        </div>
      </div>
      <div class="col-sm-7 authfy-panel-right">
        <div class="authfy-login">
          <div class="authfy-panel panel-login text-center active">
            <div class="authfy-heading">
              <h3 class="auth-title">Login to your account</h3>
              <p>Don’t have an account? <a class="lnk-toggler" data-panel=".panel-signup" href="#">Sign Up Free!</a></p>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12">
                <form name="loginForm" class="loginForm" action="#" method="POST">
                  <div class="form-group">
                    <input type="email" class="form-control email" name="username" placeholder="Email address" required>
                  </div>
                  <div class="form-group">
                    <div class="pwdMask">
                      <input type="password" class="form-control password" name="password" placeholder="Password" required>
                      <span class="fa fa-eye-slash pwd-toggle"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                  </div>
                </form>
                <?php if (!empty($errors)): ?>
                  <div class="alert alert-danger">
                    <?php echo implode("<br>", $errors); ?>
                  </div>
                <?php elseif ($success): ?>
                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                  <script>
                    Swal.fire({
                      title: 'Login Successful!',
                      text: 'You will be redirected shortly.',
                      icon: 'success',
                      confirmButtonText: 'OK'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = 'main_menu.php'; 
                      }
                    });
                  </script>
                <?php endif; ?>
              </div>
            </div>
          </div> 
        </div> 
      </div>
    </div>
  </div> 
</div>

<div id="snell">
    <?php include 'snell.php' ?>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.0/anime.min.js'></script>

<script>
    var design = anime({
        targets: 'svg #XMLID5',
        keyframes: [
            {translateX: -500},
            {rotateY: 180},
            {translateX: 920},
            {rotateY: 0},
            {translateX: -500},
            {rotateY: 180},
            {translateX: -500},
        ],
        easing: 'easeInOutSine',
        duration: 60000,
    });

    document.querySelectorAll('.pwd-toggle').forEach(item => {
        item.addEventListener('click', function() {
            let input = this.previousElementSibling;
            if (input.type === "password") {
                input.type = "text";
                this.classList.remove("fa-eye-slash");
                this.classList.add("fa-eye");
            } else {
                input.type = "password";
                this.classList.remove("fa-eye");
                this.classList.add("fa-eye-slash");
            }
        });
    });
</script>

</body>
</html>
