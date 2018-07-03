<?php
  require("function/function.php");
  
  $signupResult = array('nom'=>'','prenom'=>'','pseudo'=>'','email'=>'','pwd'=>'','dateNaissance'=>'','error'=>'');
  $loginResult = array('error' => '','login'=>'');
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['nom'])) { // inscription
      $signupResult = checkInputSignUp($_POST['nom'],$_POST['prenom'],$_POST['pseudo'],$_POST['date-naissance'],$_POST['sexe'],$_POST['email'],$_POST['mpsignup'],$_POST['confirmMpSignup']);
      if($signupResult['error'] == "") {
        inscrire($_POST['nom'],$_POST['prenom'],$_POST['pseudo'],$_POST['date-naissance'],$_POST['sexe'],$_POST['email'],$_POST['mpsignup']);
        session_start();
        $_SESSION['pseudo'] = $_POST['pseudo'];
        header("Location:accueil.php");
      }
    } else { // connexion
      $loginResult = checkInputLogin($_POST['login'],$_POST['password']);
      if($loginResult['error'] == "") {
        session_start();
        $_SESSION['pseudo'] = $_POST['login'];
        header("Location:accueil.php");
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bienvenue sur Match Love</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <style>
      .error {
        color: red;
      }
    </style>
</head>

<body>
  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1z" data-slide-to="1"></li>
      <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

      <!--First slide-->
      <div class="carousel-item active">
        <div class="view" style="background-image: url('img/main.jpg'); background-repeat: no-repeat; background-size: cover;">

          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="text-center white-text mx-5 wow fadeIn">
              <h1 class="mb-4">
                <strong><div class="animated slideInLeft">Bienvenue sur <div style="font-style: italic; font-weight: 100;" class="animated bounce infinite d-inline-block">Match Love</div><img class="animated d-inline-block pulse infinite" src="img/heart1.png" alt="heart.png"></div></strong>
              </h1>

              <p class="animated slideInLeft">
                <strong>Le numéro un des sites de rencontre</strong>
              </p>

              <p class="mb-4 d-none d-md-block animated slideInLeft">
                <strong>Likez, Matchez, Trouvez la personne de vos rêve dans ce site entièrement dédié aux rencontres amoureuses</strong>
              </p>

              <a target="_blank" href="https://mdbootstrap.com/bootstrap-tutorial/" class="btn btn-outline-white btn-lg animated slideInLeft">En savoir Plus
                <i class="fa fa-graduation-cap ml-2"></i>
              </a>
            </div>
            <!-- Content -->

          </div>
          <!-- Mask & flexbox options-->

        </div>
      </div>
      <!--/First slide-->

      <!--Second slide-->
      <div class="carousel-item">
        <!-- Full Page Intro -->
        <div class="view" style="background-image: url('img/arc.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-slight d-flex justify-content-center align-items-center">
            <!-- Content -->
            <div class="container">
              <!--Grid row-->
              <div class="row mt-5">
                <!--Grid column-->
                <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
                  <h1 class="h1-responsive font-weight-bold wow fadeInLeft" data-wow-delay="0.3s">Connectez vous Maintenant !</h1>
                  <hr class="hr-light wow fadeInLeft" data-wow-delay="0.3s">
                  <h6 class="mb-3 wow fadeInLeft" data-wow-delay="0.3s">
                    <p>Retrouvez la liste de tous vos prétendants. Découvrez leurs sentiments et leurs intentions.</p>
                  </h6>
                </div>
                <!--Grid column-->
                <!--Grid column-->
                <div class="col-md-6 col-xl-5 mb-4">
                  <!--Form-->
                  <div class="card transparent wow fadeInRight" data-wow-delay="0.3s">
                    <div class="card-body">
                      <!--Header-->
                      <div class="text-center">
                        <h3 class="white-text">
                          <i class="fa fa-user white-text"></i> Connexion</h3>
                        <hr class="hr-light">
                      </div>
                      <!--Body-->
                      <form action="index.php" method="POST">
                        <div class="md-form">
                          <i class="fa fa-user prefix white-text active"></i>
                          <input type="text" id="login" name="login" class="white-text form-control" value="<?php echo $loginResult['login']; ?>" required>
                          <label for="login" class="white-text">Pseudo</label>
                        </div>
                        <div class="md-form">
                          <i class="fa fa-lock prefix white-text active"></i>
                          <input type="password" id="mpLogin" name="password" class="white-text form-control" required>
                          <label for="mpLogin" class="white-text">Mot de passe</label>
                        </div>
                        <div class="text-center mt-4">
                          <?php echo $loginResult['error']; ?>
                          <button class="btn btn-indigo">Se connecter</button>
                          <hr class="hr-light mb-3 mt-4">
                          <div class="inline-ul text-center d-flex justify-content-center">
                            <a class="p-2 m-2 tw-ic">
                              <i class="fa fa-twitter white-text"></i>
                            </a>
                            <a class="p-2 m-2 li-ic">
                              <i class="fa fa-linkedin white-text"> </i>
                            </a>
                            <a class="p-2 m-2 ins-ic">
                              <i class="fa fa-instagram white-text"> </i>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!--/.Form-->
                </div>
                <!--Grid column-->
              </div>
              <!--Grid row-->
            </div>
            <!-- Content -->
          </div>
          <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
      </div>
      <!--/Second slide-->

      <!--Third slide-->
      <div class="carousel-item">
        <!-- Full Page Intro -->
        <div class="view" style="background-image: url('img/lake.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
          <!-- Mask & flexbox options-->
          <div class="mask rgba-black-slight  d-flex justify-content-center align-items-center">
            <!-- Content -->
            <div class="container">
              <!--Grid row-->
              <div class="row ml-4">
                <!--Grid column-->
                <div class="col-md-6 col-xl-5 mb-4">
                  <!--Form-->
                  <div class="card wow fadeInLeft ml-5" data-wow-delay="0.3s">
                    <div class="card-body">
                      <!--Header-->
                      <div class="text-center">
                        <h3>
                          <i class="fa fa-user-plus prefix"></i>Inscription</h3>
                        <hr>
                      </div>
                      <!--Body-->
                      <form action="index.php" method="POST">
                        <div class="row">
                          <div class="col-6">
                              <div class="md-form">
                                  <i class="fa fa-user-md prefix active"></i>
                                  <input name="nom" type="text" id="nom" class="form-control" value="<?php echo $signupResult['nom']; ?>" required>
                                  <label for="nom">Nom</label>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="md-form">
                                  <input name="prenom" type="text" id="prenom" class="form-control" value="<?php echo $signupResult['prenom']; ?>" required>
                                  <label for="prenom">Prénom</label>
                              </div>
                          </div>
                        </div>
                        
                        
                        <div class="md-form mt-0">
                            <i class="fa fa-user-secret prefix active"></i>
                            <input name="pseudo" type="text" id="pseudo" class="form-control" value="<?php echo $signupResult['pseudo']; ?>" required>
                            <label for="pseudo">Pseudo</label>
                        </div>
                        <div class="md-form mt-0">
                            <i class="fa fa-envelope prefix active"></i>
                            <input name="email" type="text" id="email" class="form-control" value="<?php echo $signupResult['email']; ?>" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-lock prefix active"></i>
                            <input name="mpsignup" type="password" id="mpsignup" class="form-control" value="<?php echo $signupResult['pwd']; ?>" required>
                            <label for="mpsignup">Mot de passe</label>
                        </div>
                        <div class="md-form">
                            <i class="fa fa-recycle prefix active"></i>
                            <input name="confirmMpSignup" type="password" id="confirmMpSignup" class="form-control" required>
                            <label for="confirmMpSignup">Retapez votre mot de passe</label>
                        </div>
                        <div class="row">
                          <div class="col-6 form-group">
                            <i class="fa fa-birthday-cake"></i>
                            <label for="date-naissance"> Date de naissance</label>
                            <input style="width: 200px;" type="date" name="date-naissance" value="<?php echo $signupResult['dateNaissance']; ?>" id="date-naissance" class="form-control">
                          </div>
                          <div id="sexa" class="col-6 mt-3 form-inline">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="sexe" value="m" id="homme" checked>
                              <label for="homme">Homme</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="sexe" value="f" id="femme">
                              <label for="femme">Femme</label>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <?php if(!empty($signupResult['error'])) {echo $signupResult['error'];} ?>
                        <div class="text-center mt-0">
                          <button class="btn btn-blue">S'inscrire</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!--/.Form-->
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-5 mt-md-0 mt-5 white-text text-center text-md-left">
                  <h1 class="h1-responsive font-weight-bold wow fadeInRight" data-wow-delay="0.3s">Inscrivez vous Maintenant !</h1>
                  <hr class="hr-light wow fadeInRight" data-wow-delay="0.3s">
                  <h6 class="mb-3 wow fadeInRight" data-wow-delay="0.3s">
                    <p>"Soyez la personne que tout le monde recherche ou trouvez la personne que tout le monde recherche"</p>
                  </h6>
                </div>
                <!--Grid column-->
              </div>
              <!--Grid row-->
            </div>
            <!-- Content -->
          </div>
          <!-- Mask & flexbox options-->
        </div>
        <!-- Full Page Intro -->
      </div>
      <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

  </div>
  <!--/.Carousel Wrapper-->

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
      <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();

    $(function() {
      $('input').focus(function() {
        $("#carousel-example-1z").carousel('pause');
      }).blur(function() {
        $("#carousel-example-1z").carousel('cycle');
      });
    });

  </script>
</body>

</html>
