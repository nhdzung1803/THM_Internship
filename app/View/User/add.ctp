<div class="row">
<div class="col-xs-6 col-xs-offset-3" id="con1">
	<h2>Register</h2>
<form method="post">
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group" >
		<label>Email</label>
		<input type="text" name="email" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
		<p id="para1"><?php if(isset($err)) echo $err; ?></p>
	<div class="form-group" >
		<button type="submit" class="btn btn-warning" style="display: inline;">Sign up</button>
		<span>or</span><a href="login "> I already have an account.</a>
	</div>
</form>
</div>
</div>