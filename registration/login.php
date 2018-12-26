<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="../css/bulma.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="container">
		<div class="columns is-centered">
			<main class="column is-three-quarters">

				<div class="header has-background-grey-dark">
						<h2 class="title is-2 has-text-white-ter">Login</h2>
					</div>

				<form method="post" action="login.php">
					<?php include('errors.php'); ?>
					<div class="field">
						<label class="label is-medium">Username</label>
						<div class="control">
							<input autofocus autocomplete="off" class="input is-medium" type="text" name="username" >
						</div>
					</div>
					<div class="field">
						<label class="label is-medium">Password</label>
						<div class="control">
							<input class="input is-medium" type="password" name="password">
						</div>
					</div>
					<div class="field">
						<div class="control">
							<button type="submit" class="button is-link is-medium" name="login_user">Login</button>
						</div>
					</div>
					<p>
						Not yet a member? <a href="register.php">Sign up</a>
					</p>
				</form>
			</main>
		</div>
	</div>
</body>
</html>