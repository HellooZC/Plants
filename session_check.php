<?php
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
      // If not logged in, redirect to index.php (login page)
      header("Location: index.php");
      exit; // Stop the script from executing further
  }
?>