<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="../css/bulma.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<div class="columns is-centered">
			<main class="column is-three-quarters">
				<div class="header has-background-grey-dark">
					<h2 class="title is-2 has-text-white-ter">Register</h2>
				</div>
				<form method="post" action="register.php">
					<?php include('errors.php'); ?>
					<div class="field">
						<label class="label is-medium">Username</label>
						<div class="control">
							<input autocomplete="off" autofocus class="input is-medium" type="text" name="username" required value="<?php echo $username; ?>">
						</div>
					</div>
					<div class="field">
						<label class="label is-medium">Email</label>
						<div class="control">
							<input class="input is-medium" type="email" name="email" required value="<?php echo $email; ?>">
					</div>
					</div>
					<div class="field">
						<label class="label is-medium">Password</label>
						<div class="control">
							<input class="input is-medium" type="password" name="password_1" required>
						</div>
					</div>
					<div class="field">
						<label class="label is-medium">Confirm password</label>
						<div class="control">
							<input class="input is-medium" type="password" name="password_2" required>
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button type="submit" class="button is-link is-medium" name="reg_user">Register</button>
						</div>
					</div>
					<p>
						Already a member? <a href="login.php">Sign in</a>
					</p>
				</form>
			</main>
		</div>
	</div>
</body>
</html>