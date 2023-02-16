<?php 
session_start();
require_once 'connexion.php';
$date = "";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php 
    $pro = $access->prepare("SELECT expediteur, destinataire, message, date FROM sms  ");
    $pro->execute();
  ?>
<br><br>
<div class="container">
  <form method='post' action="index.php">
  <table class='table table-striped table-sm'>
<tr>
            <th>expediteur</th>
            <th>destinataire</th>
            <th>message</th>
            <th>date et heure d'ajout</th>
        </tr>
      <?php  while($row =$pro->fetch(PDO::FETCH_ASSOC)){  ?>
           
   
       <tr>
            
            <td><?= $row['expediteur'] ?></td>
            <td><?= $row['destinataire'] ?></td>
            <td><?= $row['message'] ?></td>  
            <td><?= $row['date'] ?></td>  
            </tr>
            <?php } ?> 

   
    <nav>
        <div class="debut">
            <h1>
                bienvenu sur votre plate forme de chate
            </h1>
        </div>
    <form action="index.php" method="post">
 <div  class="row">
       <input name="expediteur"  type="text" placeholder="nom de l'expediteur" required> <br><br>
       <select name="destinataire" id="">
           <option value=""><span> selectionner le destinataire</span></option>
           <option value="">brayn</option>
           <option value="">loic</option>
           <option value="">herman</option>
           <option value="">novic</option>
       </select><br> <br>
       <input type="datetime-local" name="date"><br> <br>
       <textarea name="message" id="" cols="30" rows="10" placeholder="saisisez votre message ici" required></textarea><br> <br>
     <script name="date">
    var d = new Date();
    var date = d.getFullYear() +'-'+ (d.getMonth()+1) +'-'+ d.getDate();
    var hours = d.getHours() + ":"+ d.getMinutes() + ":" + d.getSeconds();
    var fullData = date + '' +hours;
    console.log(fullData);
    document.write(d);
</script><br> <br>
       <div style="display: block;">
     <button  type="submit" name="valider">Envoyer</button>
     <button  type="submit" name="annuler">Annuler</button>
     </div>
     </div>
    </form>
  

</nav>
</body>

</html>

<?php   
 if (isset($_POST['valider'])) {
     if( !empty($_POST['expediteur']) AND !empty($_POST['destinataire']) AND !empty($_POST['message']) AND !empty($_POST['date'])) {
         $expediteur = htmlspecialchars($_POST['expediteur']);
         $destinataire = htmlspecialchars($_POST['destinataire']);
         $message = htmlspecialchars($_POST['message']);
         $date = htmlspecialchars($_POST['date']);
         
          $pro = $access->prepare("INSERT INTO sms (`expediteur`, `destinataire`, `message`, `date`) VALUES (?, ?, ?, ?)");
          $pro -> execute(array($expediteur, $destinataire, $message, $date)); 
        }
 }


?>