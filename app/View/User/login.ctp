<div class="row">
<div class="col-xs-6 col-xs-offset-3" id="con1">
	<h2>Login</h2>
<form method="post">
	<div class="form-group" >
		<label>Email:</label>
		<input type="text" name="email" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" name="password" class="form-control" required>
	</div>
		<p id="para1"><?php if(isset($err)) echo $err; ?></p>
	<div class="form-group" >
		<button type="submit" class="btn btn-primary" style="display: inline;">Sign in</button>
		<span>or</span>
		<a type="button" class="btn btn-success" href="add">Sign up</a>
	</div>
</form>
</div>
</div>