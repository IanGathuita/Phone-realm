<?php
    require_once "../private/config.php";
    require_once "../private/db.php";
    include_once "partials/header.php";

    
    if((isset($_SESSION['logged-in']))&&($_SESSION['logged-in']==true)){
        header("Location:".ROOT_URL."public/index.php");
        exit;
    }
   

    if(isset($_POST["submit-signup"])){
    	$signup_email = isset($_POST['signup-email']) ? $_POST['signup-email'] : "";
    	$signup_password = isset($_POST["signup-password"]) ? $_POST["signup-password"] : "";
    	$confirm_signup_password = isset($_POST["confirm-signup-password"]) ? $_POST["confirm-signup-password"] : "";
    	$signup_form_error = false;
    	if($signup_email == ""){
    		$_SESSION['signup_email_error'] = "Please enter an email.";
    		$signup_form_error = true;
    	}
    	if($signup_password == ""){
    		$_SESSION['signup_password_error'] = "Please enter a password.</br>";
    		$signup_error = true;
    	}
    	if($confirm_signup_password == ""){
    		$_SESSION['confirm_signup_password_error'] = "Please re-enter the password here</br>";
    		$signup_error = true;
    	}
    	if($signup_password != $confirm_signup_password){
    		$_SESSION['password_mismatch_error'] = "Please make sure the passwords match";
    		$signup_error = true;
    	}
    	if($signup_form_error == true){
    		unset($_POST["submit-signup"]);
    		header("location:".ROOT_URL."public/login.php");
    		exit;    		
    	}
    	else{
    		// echo "<section><div><p>no error</p></div></section>";
    		//execute query
    		//Strings are interpolated because of doue quotes
    		$query = "insert into users(email,password) values('$signup_email','$signup_password')";
    		$query_result = mysqli_query($conn,$query);
    		if(! $query_result){
    			if(mysqli_errno($conn) == 1062){
    				$_SESSION['signup_email_error'] = "That email is already in use!";
    				unset($_POST["submit-signup"]);
    		        header("location:".ROOT_URL."public/login.php");
    		        exit;
    			}
    		}
    		// else{
    		// 	$_SESSION['logged_in'] = "true";
    		// 	header("location:".ROOT_URL."public/index.php");
    		// }
    	}
    	
    }
    if(isset($_POST['submit-login'])){
    	$login_email = isset($_POST['login-email']) ? $_POST['login-email'] : "";
    	$login_password = isset($_POST["login-password"]) ? $_POST["login-password"] : "";
    	$login_form_error = false;

    	if($login_email == ""){
    		$_SESSION['login_email_error'] = "Please enter an email.";
    		$login_form_error = true;
    	}

    	if($login_password == ""){
    		$_SESSION['login_password_error'] = "Please enter a password.</br>";
    		$login_form_error = true;
    	}
    	if($login_form_error == true){
    		header("Location:".ROOT_URL."public/login.php");
    		exit;    		
    	}

    	else{
    		$query = "SELECT * FROM users WHERE email = '$login_email' LIMIT 1";
    		$query_result = mysqli_query($conn,$query);
    		$count = mysqli_num_rows($query_result);
    		if($count == 1){
    			$user = mysqli_fetch_assoc($query_result);
    			if($login_password == $user['password']){
    				$_SESSION['logged-in'] = true;
    				header("location:".ROOT_URL."public/index.php");
    			    exit;
    			}
    			else{
    				$_SESSION['login_password_error'] = "Incorrect password.</br>";
    		        header("location:".ROOT_URL."public/login.php");
    			    exit;
    			}
    			
    		}
    		else{
    			$_SESSION['login_email_error'] = "That email is not registered";
    			header("location:".ROOT_URL."public/login.php");
    			exit;
    		}

    	}
    	


    }
?>
<section>
	<div class="tabs">
		<ul>
			<li id="login-tab"><a>Log in</a></li>
			<li id="register-tab"><a>Sign up</a></li>
		</ul>
	</div>
	<div class="login-register">
		<form id="login-form" method="post" target="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="login-email">Your email</label>
			<input type="email" id="login-email" name="login-email">
			<p class="invalid-input">
			<?php
				    echo isset($_SESSION['login_email_error']) ? $_SESSION['login_email_error'] : "";
				    unset($_SESSION['login_email_error']);
				?> </p>
			<label for="login-password">Your password</label>
			<input type="password" id="login-password" name="login-password">
			<p class="invalid-input">
				<?php
				    echo isset($_SESSION['login_password_error']) ? $_SESSION['login_password_error'] : "";
				    unset($_SESSION['login_password_error']);
				?>
			</p>
			<input type="submit" name="submit-login" value="Log in">			
		</form>

		<form id="register-form" method="post" target="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label for="signup-email">Your email</label>
			<input type="name"  id="signup-email" name="signup-email">
			<p class="invalid-input">
				<?php
				    echo isset($_SESSION['signup_email_error']) ? $_SESSION['signup_email_error'] : "";
				    unset($_SESSION['signup_email_error']);
				?>					
			</p>
			<label for="signup-password">Your password</label>
			<input type="password" id="signup-password" name="signup-password">
			<p class="invalid-input">
				<?php
				    echo isset($_SESSION['signup_password_error']) ? $_SESSION['signup_password_error'] : "";
				    unset($_SESSION['signup_password_error']);
				?>
			</p>
			<label for="confirm-signup-password">Confirm password</label>
			<input type="password" id="confirm-signup-password" name="confirm-signup-password">
			<p class="invalid-input">
				<?php
				    echo isset($_SESSION['confirm_signup_password_error']) ? $_SESSION['confirm_signup_password_error'] : "";
				    if(!isset($_SESSION['confirm_signup_password_error'])){
				    	echo isset($_SESSION['password_mismatch_error']) ? $_SESSION['password_mismatch_error'] : "";
				    }
				    unset($_SESSION['confirm_signup_password_error']);				    
				    unset($_SESSION['password_mismatch_error']);
				?>
			</p>
			<input type="submit" name="submit-signup" value="Sign up">			
		</form>
		
	</div>
</section>
<?php include "partials/footer.php" ?>