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
$defaultImage = isset($userData['Profile Image']) ? $userData['Profile Image'] : 'images/boys.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
   
</head>
<body>
<?php include 'header.php'; ?>
<div class="wrapper">
  <div class="profile-card">
    <div class="profile-card__img">
      <img src="<?php echo $defaultImage; ?>" alt="profile image">
    </div>

    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name">
        <?php echo isset($userData['Name']) ? $userData['Name'] : 'N/A'; ?>
      </div>
      <div class="profile-card__txt">
        Student ID: <strong><?php echo isset($userData['Student ID']) ? $userData['Student ID'] : 'N/A'; ?></strong>
      </div>
      <div class="profile-card__txt">
        Email: <strong><?php echo isset($userData['Email']) ? $userData['Email'] : 'N/A'; ?></strong>
      </div>
      <div class="profile-card__txt">I declare that this assignment is my individual work. I have not work
                                    collaboratively nor have I copied from any other student's work or from any
                                    other source. I have not engaged another party to complete this assignment. I
                                    am aware of the University’s policy with regards to plagiarism. I have not
                                    allowed, and will not allow, anyone to copy my work with the intention of
                                    passing it off as his or her own work.”
                                    </div> 

      <div class="profile-card-ctr">
        <button class="profile-card__button button--blue js-message-btn" onclick="window.location.href='index.php'">Home Page</button>
        <button class="profile-card__button button--orange" onclick="window.location.href='about.php'">About This Assignment</button>
      </div>
      <div class="profile-card__edit-button">
        <button class="profile-card__button button--gray" onclick="window.location.href='update_profile.php'">Edit Profile</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<style>
        .profile-card {
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
        .profile-card.active .profile-card__cnt {
        filter: blur(6px);
        }
        
        .profile-card.active .profile-card-form {
        transform: none;
        transition-delay: 0.1s;
        }
        .profile-card__img {
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
        @media screen and (max-width: 576px) {
        .profile-card__img {
            width: 120px;
            height: 120px;
        }
        }
        .profile-card__img img {
            display: block;
            width: 100%;
            height: 100%;
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
        .profile-card__name {
        font-weight: 700;
        font-size: 24px;
        color: #6944ff;
        margin-bottom: 15px;
        }
        .profile-card__txt {
        font-size: 18px;
        font-weight: 500;
        color: #324e63;
        margin-bottom: 15px;
        }
        .profile-card__txt strong {
        font-weight: 700;
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
        @media screen and (max-width: 768px) {
        .profile-card__button {
            min-width: 170px;
            margin: 15px 25px;
        }
        }
        @media screen and (max-width: 576px) {
        .profile-card__button {
            min-width: inherit;
            margin: 0;
            margin-bottom: 16px;
            width: 100%;
            max-width: 300px;
        }
        .profile-card__button:last-child {
            margin-bottom: 0;
        }
        }
        .profile-card__button:focus {
        outline: none !important;
        }
        @media screen and (min-width: 768px) {
        .profile-card__button:hover {
            transform: translateY(-5px);
        }
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
        
        @media screen and (max-width: 768px) {
        .profile-card-form {
            max-width: 90%;
            height: auto;
        }
        }
        @media screen and (max-width: 576px) {
        .profile-card-form {
            padding: 20px;
        }
        }
        .profile-card-form__bottom {
        justify-content: space-between;
        display: flex;
        }
        @media screen and (max-width: 576px) {
        .profile-card-form__bottom {
            flex-wrap: wrap;
        }
        }
        .profile-card__edit-button {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .profile-card__edit-button .profile-card__button {
            width: 60%;
        }
    </style>