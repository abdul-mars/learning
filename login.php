<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group label {
        font-weight: bold;
    }
</style>
</head>
<body>

	<div class="container">
	    <div class="form-container">
	        <h2 class="mb-4">Login</h2><?//= password_hash('qaz', PASSWORD_DEFAULT); ?>
	        <form action="process/login.pro.php" method="post">
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
	            <div>
	            	<button type="submit" class="btn btn-primary btn-block">Login</button>
	            </div>
	            <!-- <h5 class="text-center mt-2">Dont have account? <a href="signup.php">Sign Up</a></h5> -->
	        </form>
	    </div>
	</div>

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
</script>

</body>
</html>
