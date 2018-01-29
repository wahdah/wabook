<form action="" method="post">

	<p>Name : <?= $name ?> </p>
	
	<p>Email : <?= $email ?></p>	
	
	<p><label for="newpw">New Password </label><input id="newpw" pattern=".{6,}" title="6 characters minimum" maxlength="25" size="20" type="password" placeholder="Enter New Password" name="newpw" value="" required /></p>
	
	<p><label for="newpw2">Confirm Password : </label><input id="newpw2" pattern=".{6,}" title="6 characters minimum" size="20" maxlength="25" type="password" placeholder="Re-enter New Password" name="newpw2" value="" required /></p>
	
	<input type="submit" name="changepw" value="Save" />
	
</form>
