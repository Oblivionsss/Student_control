
<p>Личная страничка</p>

<?php foreach ($user as $users): ?>
	<h3><?php echo $users['login']; ?></h3>
	<p><?php echo $users['password']; ?></p>
	<hr>
<?php endforeach; ?>