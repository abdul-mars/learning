<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="icon" href="assets/logo.jpg" type="image/x-icon">
<style>
    body {
        font-family: Arial, sans-serif;
        /*background-color: #f8f9fa;*/
        background: url('assets/logo.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        display: flex;
        height: 100vh;
        justify-content: center;
        align-items: center;
    }
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
    }
    .form-group label {
        font-weight: bold;
    }
</style>
</head>
<body>

	<div class="container">
	    <div class="form-container">
	    	<h4 class="text-center">Tamale Technical Institute (TTI)</h4>
	        <h2 class="mb- text-center">Students Login</h2><?//= password_hash('qaz', PASSWORD_DEFAULT); ?> <hr>
	        <?php if (isset($_GET['msg']) && isset($_GET['class'])) { ?>
				<div class="alert <?= $_GET['class']; ?> alert-dismissible fade show" role="alert">
					<strong> <?= $_GET['msg']; ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
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
	            	<button type="submit" class="btn btn-success btn-block">Login</button>
	            </div>
	            <h5 class="text-center mt-2">Are you a Tutor? <a href="tutor/login.php">Login Here</a></h5>
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
