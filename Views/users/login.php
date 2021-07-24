

</form>

<?php if(!empty($_SESSION['erreur'])): ?>
<div class="alert alert-danger" role="alert">
 <?php echo $_SESSION['erreur']; unset($_SESSION['erreur']) ?>
</div>
<?php endif; ?>

<h1>Connexion</h1>


<form  method="POST">
<label for="email">Email :</label>
<input type="email" name="email" id="email" class="form-control" required>
<label for="password">Password :</label>
<input type="password" name="password" id="password" class="form-control" autofocus>
<!-- ['id' => 'password', 'class' => 'form-control', 'autofocus' => true]  -->
<button class="btn btn-primary">Me connecter</button>

<a href="register">Pas de compte - S'inscrire</a>

