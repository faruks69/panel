<?php session_start(); /* Starts the session */
/* Check Login form submitted */
if(isset($_POST['Submit'])){
/* Define username and associated password array */
$logins = array('Alex' => '123456','username1' => 'password1','username2' => 'password2');

/* Check and assign submitted Username and Password to new variable */
$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

/* Check Username and Password existence in defined array */
if (isset($logins[$Username]) && $logins[$Username] == $Password){
/* Success: Set session variables and redirect to Protected page  */
		$_SESSION['UserData']['Username']=$logins[$Username];
		header("location:index.php");
		exit;
} else {
/*Unsuccessful attempt: Set error message */
$msg="<span style='color:red'>Invalid Login Details</span>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 1200px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
		table {border-collapse:collapse; table-layout:fixed; width:430px;}
   table td {border:solid 1px #fab; width:100px; word-wrap:break-word;}
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
						<form action="" method="post" name="Login_Form">
						  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
							<?php if(isset($msg)){?>
							<tr>
							  <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
							</tr>
							<?php } ?>
							<tr>
							  <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
							</tr>
							<tr>
							  <td align="right" valign="top">Username</td>
							  <td><input name="Username" type="text" class="Input"></td>
							</tr>
							<tr>
							  <td align="right">Password</td>
							  <td><input name="Password" type="password" class="Input"></td>
							</tr>
							<tr>
							  <td> </td>
							  <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
							</tr>
						  </table>
						</form>
                    </div>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>