<h1>Inscription</h1>
<form  method="POST">

<label for="full_name">Nom complet :</label>
<input type="text" name="full_name" id="full_name" class="form-control" required autofocus>

<label for="phone_number">Numéro de téléphone :</label>
<input type="text" name="phone_number" id="phone_number" class="form-control" required>

<label for="email">Email :</label>
<input type="email" name="email" id="email" class="form-control" required>

<label for="password">Mot de passe :</label>
<input type="password" name="password" id="password" class="form-control" >
<!-- ['id' => 'password', 'class' => 'form-control', 'autofocus' => true]  -->
<button class="btn btn-primary">S'inscrire</button>
<a href="login">Déjà inscrit - Me connecter</a>