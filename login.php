<?php
session_start();
  require 'db_open.php';
  $varErrmessage="";
  $varscript="";
  $varAccount="";
  $varPassword="";

  
  if (isset($_GET['st'])){ //logout 時會給的變數
	if ($_GET['st']=="logout"){
		unset($_SESSION['sAccount']);}}

  if (isset($_POST['usrAccount'])) { //使用者輸入帳號後，帳號密碼的判斷
	 $varAccount=$_POST['usrAccount'];
	 $varPassword=$_POST['usrPassword'];
	 $sql = "SELECT * FROM `admin` where admin_name='$varAccount'"; // 指定SQL查詢字串
	 $result = mysqli_query($link, $sql);
	 if (mysqli_num_rows($result) == 0)
	 	{$varErrmessage ="請輸入正確帳號";

		}
	 else
	   { $row = mysqli_fetch_assoc($result);	 	 
	    if ($varPassword==$row['admin_pwd']){
	    	$_SESSION['sAccount']=$varAccount;
			$_SESSION['aname']=$row['admin_name'];
			$_SESSION['sLogintime']=date("F j, Y, g:i a");
			mysqli_close($link);  // 關閉資料庫連接
			//echo $total_records;
	    	header('Location: index.php');}
        else
	    	$varErrmessage ="請輸入正確密碼";
		}
  }
  
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>後端管理系統</title>
	
	<!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="logo/fav.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="logo/fav.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="logo/fav.png">
    <!-- Standard iPad Touch Icon--> 
    <link rel="apple-touch-icon" sizes="72x72" href="logo/fav.png">
    <!-- Standard iPhone Touch Icon--> 
    <link rel="apple-touch-icon" sizes="57x57" href="logo/fav.png">
	
	<!-- Styles -->
    <link href="assets/fontAwesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/nixon.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">

	<div class="Nixon-login">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="login-content">
						<div class="login-logo">
							 <h2><img id="" src="logo/logoSmall.png" style="width:50px;height:43px;"/>Backend Management System</h2>
						</div>
						<div class="login-form">
							<h4>Login</h4>
							<form method="post" action="login.php">
								<div class="form-group">
									<label>Account</label>
									<input type="text" name = "usrAccount" id="usrAccount" class="form-control" value="<?=$varAccount?>" placeholder="Account">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="usrPassword" class="form-control" value="<?=$varPassword?>"  placeholder="Password">
								</div>
								<div>
									<label>
  										<?=$varErrmessage?>
									</label>
									<label class="pull-right">
										<a href="send-password.html">Forget password？</a>
									</label>
									
								</div>
								<button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Login</button>		
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>