<?php
// Function to validate email format
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password strength
function isValidPassword($password) {
    return preg_match('/^(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password);
}

// Function to check if email already exists in the text file
function emailExists($email, $file) {
    if (file_exists($file)) {
        $lines = file($file);
        foreach ($lines as $line) {
            // Trim the line and split it by the separator
            $data = explode('|', trim($line));
            // Check if the email is in the expected position (5th position)
            if (isset($data[4]) && trim($data[4]) === "Email:".$email) {
                return true;
            }
        }
    }
    return false;
}

$file = 'data/user.txt';

$errors = [];
$success = false;

// Ensure all fields are filled
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $hometown = $_POST['hometown'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate fields
    if (!preg_match("/^[a-zA-Z ]*$/", $first_name) || !preg_match("/^[a-zA-Z ]*$/", $last_name)) {
        $errors[] = "First and Last names should contain only alphabets and spaces.";
    }

    if (!isValidEmail($email)) {
        $errors[] = "Invalid email format.";
    }

    if (!isValidPassword($password)) {
        $errors[] = "Password must contain at least 8 characters, including 1 number and 1 symbol.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    if (emailExists($email, $file)) {
        $errors[] = "Email already exists.";
    }

    // If no errors, save to file
    if (empty($errors)) {
        // Create user data string in the required format
        $user_data = "First Name:".$first_name."|Last Name:".$last_name."|DOB:".$dob."|Gender:".$gender."|Email:".$email."|Hometown:".$hometown."|Password:".$password."|\n";

        // Save user data to the file
        file_put_contents($file, $user_data, FILE_APPEND);

        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Validation</title>
    <!-- SweetAlert CSS and JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php include 'header.php' ?>
<?php if (!empty($errors)): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Registration Failed',
        html: '<?php echo implode("<br>", $errors); ?>',
        confirmButtonText: 'Ok'
    }).then(() => {
        window.location.href = 'registration.php'; // Redirect to registration page
    });
</script>
<?php elseif ($success): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Registration Successful',
        text: 'Your account has been created. Redirecting to login page...',
        timer: 3000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = 'login.php'; // Redirect after success
    });
</script>
<?php endif; ?>

</body>
</html>
