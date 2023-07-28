<?php
$conn = new MySqli("localhost","root","","hotel");
if(isset($_POST['signupbtn']))
{
  $insert = "INSERT INTO `users` (`name`,`uname`,`password`,`email`,`contact`,`gender`,`status`) VALUES ('".$_POST['name']."','".$_POST['uname']."','".$_POST['psw']."','".$_POST['email']."','".$_POST['contact']."','".$_POST['gender']."',1)";
  $res = $conn->query($insert);
  header("location:SgnUpForm.php");
}
if(isset($_GET['del']))
{
  $delete = "DELETE from `users` WHERE `id` = ".$_GET['del'];
  $res = $conn->query($delete);
  header("location:SgnUpForm.php");
}
if(isset($_GET['status']))
{
  $get_status = "SELECT `status` FROM `users` WHERE `id` = ".$_GET['status'];
  $res = $conn->query($get_status);
  $row = $res->fetch_assoc();
  $status = (isset($row['status']) && $row['status'] == 1)?0:1;
  $statusUpdate = "UPDATE `users` SET `status` = ".$status." WHERE `id` = ".$_GET['status'];
  $conn->query($statusUpdate);
  header("location:SgnUpForm.php");
}
if(isset($_GET['edit']))
{
  $get_info = "SELECT `status` FROM `users` WHERE `id` = ".$_GET['edit'];
  $res = $conn->query($get_info);
  $row = $res->fetch_assoc();
  $status = (isset($row['status']) && $row['status'] == 1)?0:1;
  $statusUpdate = "UPDATE `users` SET `status` = ".$status." WHERE `id` = ".$_GET['status'];
  $conn->query($statusUpdate);
  header("location:SgnUpForm.php");
}
$query = "SELECT * FROM `users`";
$res = $conn->query($query);



?>
<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;
display:flex}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password],input[type=number] {
  width: 60%;
  padding: 5px;
  /* margin: 3px 0 3px 0; */
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus ,input[type=number]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  /* border: 1px solid #f1f1f1; */
  margin-bottom: 25px;
}
label{
  display:inline-block;
  width:120px
}
/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
  width:30vw;
  margin:20px;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
table{
  border:1px solid gray;
  margin:20px;
  width: 60vw;
  background: #f1f1f1;
  box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}


th, td{
  border:1px solid gray;
  text-align:left;
}
h2{
  font-size:2rem;
  margin-left:20px;
}
a{
  text-decoration:none;
}


/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
<body>

<form action="" method="post">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <p>
    <label class="lable" for="name"><b>Full name</b></label>
    <input type="text" placeholder="Enter Name" name="name" required>
    </p>
    <p>
    <label for="uname"><b>User name</b></label>
    <input type="text" placeholder="Enter User Name" name="uname" required>
    </p>
    <p>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
    </p>
    <p>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>
    </p>
    <p>
    <label for="contact"><b>Contact</b></label>
    <input type="number" placeholder="Enter contact" name="contact" required>
    </p>
    <p>
    <label for="gender"><b>Gender</b></label>
      <input type="radio" checked="checked" name="gender" value="Male" style="margin-bottom:15px"> Male
      <input type="radio" name="gender" value="Female" style="margin-bottom:15px"> Female
    </p>
    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="reset" class="cancelbtn">Cancel</button>
      <button type="submit" name="signupbtn" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php if(!empty($res)) { ?>
<div class="data-container">
  <h2>User List</h2>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>User Name</th>
        <th>E-Mail</th>
        <th>Contact</th>
        <th>Gender</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach($res as $index => $val){
      ?>
      <tr>
        <td><?php echo $index+1; ?></td>
        <td><?php echo $val['name']; ?></td>
        <td><?php echo $val['uname']; ?></td>
        <td><?php echo $val['email']; ?></td>
        <td><?php echo $val['contact']; ?></td>
        <td><?php echo $val['gender'] == 1?"Male":"Female"; ?></td>
        <td style="display:flex;justify-content:space-around;">
        <a href="SgnUpForm.php?edit=<?php echo $val['id']; ?>">Edit</a>
        <a href="SgnUpForm.php?del=<?php echo $val['id']; ?>">Delete</a>
        <a href="SgnUpForm.php?status=<?php echo $val['id']; ?>"><?php echo $val['status'] == 1?"&nbsp;&nbsp;&nbsp;Active":"InActive"; ?></a>
        </td>
      </tr> <?php } ?>
    </tbody>
  </table>
</div>
<?php } ?>
</body>
</html>
