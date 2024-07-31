<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>Login</title>
		<style>
		    body {
		        font-family: Arial, sans-serif;
		        background-color: #f8f9fa;
		    }
		    .form-container {
		        max-width: 400px;
		        margin: 10px auto;
		        background-color: #fff;
		        padding: 30px;
		        border-radius: 10px;
		        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		    }
		    .form-group label {
		        font-weight: bold;
		        margin-top: 10px;
		    }
		</style>
	</head>
	<body>
		<div class="container">
		    <div class="form-container">
		        <h2 class="mb- text-center">Sign Up</h2> <hr>
		        <form action="process/signup.pro.php" method="post">
		            <div class="form-group">
		                <label for="lname">Lastname:</label>
		                <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter Lastname" required>
		            </div>
		            <div class="form-group">
		                <label for="fname">Firstname:</label>
		                <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Firstname" required>
		            </div>
		            <div class="form-group">
		                <label for="email">Email:</label>
		                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
		            </div>
		            <div class="form-group">
		                <label for="password">Password:</label>
		                <div class="input-group">
		                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
		                    <div class="input-group-append">
		                        <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">Show</button>
		                    </div>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="confirmPassword">Confirm Password:</label>
		                <div class="input-group">
		                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="re-enter  password" required>
		                    <div class="input-group-append">
		                        <button class="btn btn-outline-secondary" type="button" id="showCnfmPasswordBtn">Show</button>
		                    </div>
		                </div>
		            </div>
		            <div>
		            	<button type="submit" class="btn btn-primary btn-block mt-3" style="width: 100%">Sign Up</button>
		            </div>
		            <h5 class="text-center mt-2">Already have account? <a href="login.php">Login</a></h5>
		        </form>
		    </div>
		</div>


		<script src="js/jquery-3.7.1.min.js"></script>
	<script>
	    document.getElementById("showPasswordBtn").addEventListener("click", function() {
	        var passwordInput = document.getElementById("password");
	        if (passwordInput.type === "password") {
	            passwordInput.type = "text";
	            this.textContent = "Hide";
	        } else {
	            passwordInput.type = "password";
	            this.textContent = "Show";
	        }
	    });
	    $(document).ready(function(){
	    	$('#showCnfmPasswordBtn').click(function() {
	    		if ($('#confirmPassword').attr('type') == 'password') {
	    			$('#confirmPassword').attr('type', 'text');
	    			$(this).text('Hide');
	    		} else {
	    			$('#confirmPassword').attr('type', 'password');
	    			$(this).text('Show');
	    		}
	    	});
	    })
	</script>

	</body>
</html>
