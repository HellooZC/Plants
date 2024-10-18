<?php include 'session_check.php'; ?>
<?php
$file = 'data/user_profile.txt';
$userData = [];

if (file_exists($file)) {
    $fileContents = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($fileContents as $line) {
        list($key, $value) = explode(': ', $line);
        $userData[trim($key)] = trim($value);
    }
}
$defaultImage = 'profile_images/male_default.png'; // Default to male image
if (isset($userData['Gender']) && strtolower($userData['Gender']) == 'female') {
    $defaultImage = 'images/girl.png';
}else{
    $defaultImage = 'images/boys.jpg'; 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $studentId = $_POST['student_id'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $profileImage = $defaultImage;

    $newData = [
        "Name: $name",
        "Student ID: $studentId",
        "Email: $email",
        "Gender: $gender",
        "Profile Image: $profileImage" 
    ];
    file_put_contents($file, implode("\n", $newData));

    $userData = ['Name' => $name, 'Student ID' => $studentId, 'Email' => $email, 'Gender' => $gender, 'Profile Image' => $profileImage];

    header("Location: update_profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        .update-profile-container {
            width: 100%;
            min-height: 460px;
            margin: auto;
            box-shadow: 0px 8px 60px -10px rgba(13, 28, 39, 0.6);
            background: #fff;
            border-radius: 12px;
            max-width: 700px;
            position: relative;
            margin-top:100px;
            margin-bottom: 100px;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            margin-left: auto;
            margin-right: auto;
            transform: translateY(-50%);
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            z-index: 4;
            box-shadow: 0px 5px 50px 0px #8AE28A, 0px 0px 0px 7px rgba(107, 74, 255, 0.5);  
        }
        .profile-card__img img {
            display: block;
            width: 30%;
            height: 30%;
            object-fit: cover;
            border-radius: 50%;
        }
        .profile-card__cnt {
            margin-top: -35px;
            text-align: center;
            padding: 0 20px;
            padding-bottom: 40px;
            transition: all 0.3s;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .profile-card__button {
            background: none;
            border: none;
            font-family: "Quicksand", sans-serif;
            font-weight: 700;
            font-size: 19px;
            margin: 15px 35px;
            padding: 15px 40px;
            min-width: 201px;
            border-radius: 50px;
            min-height: 55px;
            color: #fff;
            cursor: pointer;
            backface-visibility: hidden;
            transition: all 0.3s;
        }
        .profile-card__button:first-child {
        margin-left: 0;
        }
        .profile-card__button:last-child {
        margin-right: 0;
        }
        .profile-card__button.button--blue {
        background: linear-gradient(45deg, #1da1f2, #0e71c8);
        box-shadow: 0px 4px 30px rgba(19, 127, 212, 0.4);
        }
        .profile-card__button.button--blue:hover {
        box-shadow: 0px 7px 30px rgba(19, 127, 212, 0.75);
        }
        .profile-card__button.button--orange {
        background: linear-gradient(45deg, #d5135a, #f05924);
        box-shadow: 0px 4px 30px rgba(223, 45, 70, 0.35);
        }
        .profile-card__button.button--orange:hover {
        box-shadow: 0px 7px 30px rgba(223, 45, 70, 0.75);
        }
        .profile-card__button.button--gray {
        box-shadow: none;
        background: #dcdcdc;
        color: #142029;
        }
    </style>
</head>
<body>
<?php include 'header.php' ?>
<div class="update-profile-container">
    <div class="profile-card__img">
        <img src="<?php echo $defaultImage; ?>" alt="Profile Image" class="profile-img">
    </div>
    <form class="profile-card__cnt" action="update_profile.php" method="POST">
        <!-- Display current user information -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo isset($userData['Name']) ? $userData['Name'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" value="<?php echo isset($userData['Student ID']) ? $userData['Student ID'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($userData['Email']) ? $userData['Email'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?php echo (isset($userData['Gender']) && $userData['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (isset($userData['Gender']) && $userData['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>

        <!-- Buttons for Update and Cancel -->
        <div class="profile-card-ctr">
            <button type="submit" class="profile-card__button button--blue js-message-btn">Update</button>
            <button type="button" onclick="window.location.href='index.php'" class="profile-card__button button--orange">Cancel</button>
        </div>
    </form>
</div>

</body>
</html>
