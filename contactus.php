<?php
    session_start();
    include("database.php");

    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit'])){
        $Fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $Iname = mysqli_real_escape_string($conn, $_POST['lname']);
        $Email = mysqli_real_escape_string($conn, $_POST['email']);
        $Mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $Message = mysqli_real_escape_string($conn, $_POST['message']);




        

        if(!empty($Fname) && !empty($Iname) && !empty($Email) && !empty($Mobile) ){
            $query ="INSERT INTO `contact` (fname, lname, email, mobile, message) VALUES('$Fname', '$Iname', '$Email', '$Mobile', '$Message')";
            
            mysqli_query($conn, $query);
            echo "<script type='text/javascript'>alert('Successfully Created'); window.location.href = 'contactus.php';</script>";
            exit(); // Ensure no further output after redirection
        }
        else{
            echo "<script type='text/javascript'>alert('Please Enter some Valid Details');</script>";
        }
    }
?>



<html>
<head>
<link rel="stylesheet" href="contactus.css">
<title>contact us | Vista Cinema</title>

<script type="text/javascript">
// character validation
function allowOnlyLetters(event) 
{
    var charCode = event.charCode || event.keyCode; // Get the character code

    //  letter (A-Z or a-z) 
    if ((charCode >= 65 && charCode <= 90) || 
        (charCode >= 97 && charCode <= 122) || 
        charCode == 8 || charCode == 32) { 
        return true;
    } else {
        return false; 
    }
}
</script>


</head>
<body>

<header>
        <h2 class="logo">Vista Cinema</h2>
        <nav class="navigation">
            <a href="home.html">Home</a>
            <a href="aboutus.html">About Us</a>
            <a href="movie.html">Movies</a>
            <a href="contactus.php">Contact</a>
            
        </nav>
    </header>

<div class="contact">
<form method="post">
<h1>Contact Us Forms </h1>
<input type ="text" id="fname" name="fname" placeholder="First Name" onkeypress="return allowOnlyLetters(event)" required> &nbsp 
<input type ="text" id="lname" name="lname" placeholder="Last Name" onkeypress="return allowOnlyLetters(event)"  required> &nbsp
<input type ="email" id="email" name="email" placeholder="Email" required>&nbsp
<input type ="text" id="mobile" name="mobile" placeholder="Mobile" required>&nbsp
<h4> Type your Message Here...</h4>

<textarea name="message" required></textarea><br><br>

<input type="submit" value="submit" name="submit" id="button">

</form>
</div>

</body>
</html>