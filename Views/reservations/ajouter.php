

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Publier une annonce</title>
	<link rel="stylesheet" href="styles.css">
</head>


<body>


<form action=""  method="POST" enctype="multipart/form-data"> <!-- on déclare souvent c'est on'est besoin d'uploader un fichier vers le serveur -->
<div class="wrapper">
    <div class="title">
      Remplir les informations de votre animal
    </div>
    <div class="form">
       <div class="inputfield">
          <label for="nom">Nom</label>
          <input type="text" class="input" name="nom" id="nom">
       </div> 
       <?php if(!empty($erreur1)) {?>
<div id="erreur">
    <?=$erreur1 ?>
</div>
<?php }?> 
       <div class="inputfield">
        <label for="espese">Espèce</label>
        <div class="custom_select">
          <select name="espese" >
            <option value="">Select</option>
            <option value="chien">Chien/Chiot</option>
            <option value="chat">Chat/Chatton</option>
            <option value="autre">Autre espèce</option>
            
          </select>
        </div>
     </div> 
     
     <?php if(!empty($erreur2)) {?>
<div id="erreur">
    <?=$erreur2 ?>
</div>
<?php }?> 

       <div class="inputfield">
          <label>Race</label>
          <input type="text" name="race" class="input">
       </div> 
       <?php if(!empty($erreur3)) {?>
<div id="erreur">
    <?=$erreur3 ?>
</div>
<?php }?>  
      
        <div class="inputfield">
          <label>Gender</label>
          <div class="custom_select">
            <select name="genre">
              <option value="">Select</option>
              <option value="male">Màle</option>
              <option value="female">Femelle</option>
            </select>
          </div>
       </div> 

       <?php if(!empty($erreur4)) {?>
<div id="erreur">
    <?=$erreur4 ?>
</div>
<?php }?> 

       <div class="inputfield">
        <label>Age</label>
        <div class="custom_select">
          <select name="age">
            <option value="">Select</option>
            <option value="bebe">Bebe</option>
            <option value="junior">junior</option>
            <option value="adulte">adulte</option>
            <option value="segnior">segnior</option>
            
          </select>
        </div>
     </div> 

     <?php if(!empty($erreur5)) {?>
<div id="erreur">
    <?=$erreur5 ?>
</div>
<?php }?> 

     <div class="inputfield">
          <label>Ville</label>
          <input type="text" name="ville" class="input">
       </div> 

       <?php if(!empty($erreur6)) {?>
<div id="erreur">
    <?=$erreur6 ?>
</div>
<?php }?> 
        
       
      <div class="inputfield">
          <label>Description</label>
          <textarea class="textarea" name="description"></textarea>
       </div> 

       <?php if(!empty($erreur7)) {?>
<div id="erreur">
    <?=$erreur7 ?>
</div>
<?php }?> 
       
      <div  class="inputfield">
        <label for="fileselect" class="custom-file-upload">Sélectionnez une image</label>
        <input class="input" type="file" id="fileselect" name="profile_pic" accept=".jpg, .jpeg, .png">  <!-- // input de type file pour charger un fichier sur le serveur -->
      </div> 


      <?php if(!empty($erreur8)) {?>
<div id="erreur">
    <?=$erreur8 ?>
</div>
<?php }?> 


   


   <!-- <input type="file" id="fileselect" accept="image/*" name="fileselect" /> -->

   <!-- <label for="file-upload" class="custom-file-upload">
        Upload
   </label>
   <input id="file-upload" type="file" name="test"/> -->

   


      <div class="inputfield">
        <input type="submit" value="Enregistrer" class="btn" name="valider" >
      </div>
    </div>
</div>

</form>

</body>
</html>


