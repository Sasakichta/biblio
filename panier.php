<!DOCTYPE html>

<html lang="fr">

<head>

  <title>Panier</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" type="text/css" href="style.css"/> -->

  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>






<div class="container-fluid">
 


    <div class="row">
        <div class="col-md-8">
          <?php include 'entete.php';?>
        </div>
        <div class="col-md-4">
        <img src="images/photo.jpeg" class="imgPos" style="width:625px;height:226px;" alt="Image">
        </div>


        
    </div>


    <div class="row">

    <div class="col-md-3"></div>



          <div class="col-md-5">
            <div class="card;border-0"  style="width:375px;height:150px"> <!-- card pour empecher le carroussel d'être trop gros et l'afficher dans une zone determinée  /  border 0 pour enlever le border de la card -->


              <?php 
              if (isset($_SESSION['profil']))
              
              {
                    echo "Votre panier";
              }
              else {
                    echo "Votre panier est vide car vous devez vous connecter" ;
                    }
              
              ?>



            </div>
          </div>




          <div class="col-md-4">
          


            <?php              
                include 'authentification.php';       
            ?>




          </div>
    </div>


    <div class="row"></div>



</div>