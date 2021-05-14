<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Registration Form</h2>
  </div>

  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div>
    <div class="input-group">
  	  <label>Surname</label>
  	  <input type="text" name="surname" value="<?php echo $surname; ?>">
  	</div>
    <div class="input-group">
  	  <label>Phone</label>
  	  <input type="text" name="phone" value="<?php echo $phone; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
    <div class="input-group">
  	  <label>Adress</label>
  	  <input type="text" name="adress" value="<?php echo $adress; ?>">
  	</div>
    <div class="input-group">
  	  <label>City</label>
      <select name="city">
        <option value="" disabled selected>Choose your City</option>
        <option value="Tbilisi">Tbilisi</option>
        <option value="Baku">Baku</option>
        <option value="Instanbul">Instanbul</option>
        <option value="London">London</option>
        <option value="Paris">Paris</option>
        <option value="Madrid">Madrid</option>
        <option value="Roma">Roma</option>
        <option value="Berlin">Berlin</option>
        <option value="Moscow">Moscow</option>
    </select>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="sbmt">Submit</button>
  	</div>
  </form>

  <div class="container">
   <div class="row">
   <div class="col-md-8 col-md-offset-2" style="margin-top: 5%;">
   <div class="row">

  <?php

     $conn = new mysqli('localhost', 'root', '', 'registerpage');
     if(isset($_GET['search'])){
        $searchKey = $_GET['search'];
        $sql = "SELECT * FROM users WHERE name LIKE '%$searchKey%'";

     }else
     $sql = "SELECT * FROM users";
     $result = $conn->query($sql);
   ?>

   <form action="" method="GET">
     <div class="col-md-6">
        <input type="text" name="search" class='form-control' placeholder="Search..." value=<?php echo @$_GET['search']; ?> >
     </div>
     <div class="col-md-6 text-left">
      <button class="btn">Search</button>
     </div>
   </form>
   <br>
<br>
</div>

<table class="table table-bordered">
<tr>
   <th>Name</th>
   <th>Surname</th>
   <th>Phone</th>
   <th>Email</th>
   <th>Adress</th>
   <th>City</th>
</tr>
<?php while( $row = $result->fetch_object() ): ?>
<tr>
   <td><?php echo $row->name ?></td>
   <td><?php echo $row->surname ?></td>
   <td><?php echo $row->phone ?></td>
   <td><?php echo $row->email ?></td>
   <td><?php echo $row->adress ?></td>
   <td><?php echo $row->city ?></td>
</tr>
<?php endwhile; ?>
</table>

</body>
</html>
