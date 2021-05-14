<?php
session_start();
require "Database.php";
$Database = new Database();

// initializing variables
$name = "";
$surname = "";
$phone = "";
$email    = "";
$adress = "";
$city = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'registerpage');

// REGISTER USER
if (isset($_POST['sbmt'])) {

  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $surname = mysqli_real_escape_string($db, $_POST['surname']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $adress = mysqli_real_escape_string($db, $_POST['adress']);
  $city = mysqli_real_escape_string($db, $_POST['city']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($surname)) { array_push($errors, "Surname is required"); }
  if (empty($phone)) { array_push($errors, "Phone number is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($adress)) { array_push($errors, "Adress is required"); }
  if (empty($city)) { array_push($errors, "Adress is required"); }


  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];
    $city = $_POST['city'];

    $user = $Database->insertUser($name,$surname,$phone,$email,$adress,$city);
    if($user){
      header('location: register.php');
    }else{
      header('location: register.php');
    }
  }
}

// ...
