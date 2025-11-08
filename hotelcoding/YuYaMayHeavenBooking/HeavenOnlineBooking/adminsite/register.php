<?php
include 'heavenconnect.php';


$showAlert = false;
$showError = false;
$exists=false;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    
    
    $sql = "Select * from users where username='$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    
    
    if($num == 0) {
        if(($password == $cpassword) && $exists==false) {
            
            $hash = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `users` ( `username`,`password`, type) VALUES ('$username','$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            
            if ($result) {
                $showAlert = true;
            } }
            else {
                $showError = "Incorrect Password.";
            } }
            
            if($num>0)
            {
                $exists="Incorrect Username.";
            } }
            ?>
	
<!doctype html>
<html lang="en">

<head>
					<title> Heaven Hotel Online Booking System </title>
					
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	
<style>
 

	.form-container{
	margin-left: 150px;
	margin-right: 150px;
    background-image: url("rooms.jpg");
    background-image: cover;
    font-family: 'Titillium Web', sans-serif;
    font-size: 0;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 0 25px -15px rgba(0, 0, 0, 0.3);
}
.form-container .title{
    text-align: center;
    color: #000;
    font-size: 25px;
    font-weight: 600;
    text-transform: capitalize;
    margin: 0 0 25px;
}
.form-container .title:after{
    content: '';
    background-color: #00A9EF;
    height: 3px;
    width: 60px;
    margin: 10px 0 0;
    display: block;
    clear: both;
}
.form-container .sub-title{
    color: #333;
    font-size: 18px;
    font-weight: 600;
    text-align: center;
    text-transform: uppercase;
    margin: 0 0 20px;
}
.form-container .form-horizontal{ font-size: 0; }
.form-container .form-horizontal .form-group{
    color: #333;
    width: 50%;
    padding: 0 8px;
    margin-left: 250px;
    display: inline-block;
}
.form-container .form-horizontal .form-group:nth-child(4){ margin-bottom: 30px; }
.form-container .form-horizontal .form-group label{
    font-size: 17px;
    font-weight: 600;
}
.form-container .form-horizontal .form-control{
    color: #888;
    background: #fff;
    font-weight: 400;
    letter-spacing: 1px;
    height: 40px;
    margin-left: 80px;
    padding: 6px 12px;
    border-radius: 10px;
    border: 2px solid #e7e7e7;
    box-shadow: none;
}
.form-container .form-horizontal .form-control:focus{ box-shadow: 0 0 5px #dcdcdc; }
.form-container .form-horizontal .check-terms{
    padding: 0 8px;
    margin: 0 0 25px;
}
.form-container .form-horizontal .check-terms .check-label{
    color: #333;
    font-size: 14px;
    font-weight: 500;
    font-style: italic;
    vertical-align: top;
    display: inline-block;
}
.form-container .form-horizontal .check-terms .checkbox{
    height: 17px;
    width: 17px;
    min-height: auto;
    margin: 2px 8px 0 0;
    border: 2px solid #d9d9d9;
    border-radius: 2px;
    cursor: pointer;
    display: inline-block;
    position: relative;
    appearance: none;
    -moz-appearance: none;
    -webkit-appearance: none;
    transition: all 0.3s ease 0s;
}
.form-container .form-horizontal .check-terms .checkbox:before{
    content: '';
    height: 5px;
    width: 9px;
    border-bottom: 2px solid #00A9EF;
    border-left: 2px solid #00A9EF;
    transform: rotate(-45deg);
    position: absolute;
    left: 2px;
    top: 2.5px;
    transition: all 0.3s ease;
}
.form-container .form-horizontal .check-terms .checkbox:checked:before{ opacity: 1; }
.form-container .form-horizontal .check-terms .checkbox:not(:checked):before{ opacity: 0; }
.form-container .form-horizontal .check-terms .checkbox:focus{ outline: none; }
.form-container .signin-link{
    color: #333;
    font-size: 14px;
    width: calc(100% - 190px);
    margin-right: 30px;
    display: inline-block;
    vertical-align: top;
}
.form-container .signin-link a{
    color: #00A9EF;
    font-weight: 600;
    transition: all 0.3s ease 0s;
}
.form-container .signin-link a:hover{ text-decoration: underline; }
.form-container .form-horizontal .signup{
    color: #fff;
    background: #00A9EF;
    font-size: 15px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 160px;
    padding: 8px 15px 9px;
    border-radius: 10px;
    transition: all 0.3s ease 0s;
}
.form-container .form-horizontal .btn:hover,
.form-container .form-horizontal .btn:focus{
    text-shadow: 0 0 5px rgba(0,0,0,0.5);
    box-shadow: 3px 3px rgba(0,0,0,0.15),5px 5px rgba(0,0,0,0.1);
    outline: none;
}
@media only screen and (max-width:479px){
    .form-container .form-horizontal .form-group{ width: 100%; }
    .form-container .signin-link{
        width: 100%;
        margin: 0 10px 15px;
    }
}
</style>
</head>

<body>
	
<?php
	
	if($showAlert) {
	
		echo ' <div class="alert alert-success	alert-dismissible fade show" role="alert">
	
			<strong>Completed!</strong> You created an account successfully. Now you can login.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			</button>
		    </div> ';
	}
	
	if($showError) {
	
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
		     <strong>Something is wrong.</strong> '. $showError.'
	
	         <button type="button" class="close" data-dismiss="alert aria-label="Close">
	         <span aria-hidden="true">×</span>
	         </button>
	         </div> ';
    }
		
	if($exists) {
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
	
		      <strong>Something is wrong.</strong> '. $exists.'
		      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">×</span>
	          </button>
	          </div> ';
	}

?>
	
<div class="form-bg">
<div class="container">
<div class="row">
<div class="col-md-offset-3 col-md-6">
<div class="form-container">
                
                
                    <h3 class="title">Register</h3>
                    <form class="form-horizontal" action="login.php" method="post">
                    
                        <div class="form-group">
                            <label>Username</label> <br>
                            <input type="text" class="form-control"  id="username"	name="username" placeholder="Username">
                            
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address</label> <br>
                            <input type="email" class="form-control" id="password" name="password" placeholder="Address">
                        </div>                      
                        
                        <div class="form-group">
                            <label>Password</label> <br>
                            <input type="password" class="form-control" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
                        </div>
                        
                        <div class="form-group">
                            <label>Confirm Password</label> <br>
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>
                        
                        <h4 class="sub-title">Personal Information</h4>
                        <div class="form-group">
                            <label>Phone No.</label> <br>
                            <input type="text" class="form-control" placeholder="Phone Number">
                        </div>
                        
                        <div class="form-group">
                            <label>Gender</label> <br>
                            <select class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Perfer">Perfer not to say</option>
                            </select>                           
                        </div>
                        
                        
                        <div class="check-terms">
                            <input type="checkbox" class="checkbox">
                            <span class="check-label">I agree to the terms</span>
                        </div>
                        
                        <span class="signin-link">Already have an account? Click here to <a href="login.php">Login</a></span>
                        <button class="btn signup">Create Account</button>
                    </form>
                    
</div> </div></div></div></div>
            
        
<script>

</script>
</body>
</html>
