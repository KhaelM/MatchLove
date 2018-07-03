<?php
    function dbconnect() {
        static $connect = null;
        if ($connect === null) {
            $connect = mysqli_connect('localhost','root', 'root', 'MatchLove');
            mysqli_set_charset($connect,"utf8");
            mysqli_query($connect, "SET lc_time_names = 'fr_FR'");
        }
        return $connect;
    }

    function getMembres($email) { // liste de tous les autres membres
        $sql = "SELECT * FROM Membre WHERE Email != %s";
        $sql = sprintf($sql,$email);
        $request = mysqli_query(dbconnect(), $sql);
        if(!$request) {echo "Could not successfully run query from DB: ";}
        $result=array();
        while($tmp = mysqli_fetch_assoc($request)) {
            $result[] = $tmp;
        }
        mysqli_free_result($request);
        return $result;
    }
    
    function getMembre($pseudo) { // fiche d'un membre
        $sql = "SELECT * FROM Membre as m JOIN Photo as p ON m.IdMembre=p.IdMembre WHERE m.Pseudo = '%s'";
        $sql = sprintf($sql,$pseudo);
        $request = mysqli_query(dbconnect(),$sql);
        if(!$request) {echo "Could not successfully run query from DB: ";}
        $result = mysqli_fetch_assoc($request);
        mysqli_free_result($request);
        return $result;
    }

    function chercher($pseudo) { // recherche simple
        $sql = "SELECT * FROM Membre WHERE Pseudo='%%%s%'";
        $sql = sprintf($sql,$pseudo);
        $request = mysqli_query(dbconnect(),$sql);
        if(!$request) {echo "Could not successfully run query from DB: ";}
        $result = mysqli_fetch_assoc($request);
        mysqli_free_result($request);
        return $result;
    }

    function chercherMulti($pseudo,$dateNaissance,$sexe) { // recherche multi-critere
        $sql = "SELECT * FROM Membre WHERE Pseudo='%%%s%' AND DateNaissance = '%s' AND Sexe = '%s'";
        $sql = sprintf($sql,$pseudo,$dateNaissance,$sexe);
        $request = mysqli_query($sql);
        $result = array();
        while($tmp = mysqli_fetch_assoc($request)) {
            $result[] = $tmp;
        }
        mysqli_free_result($request);
        return $result;
    }

    function ajouterPhoto($idMembre,$nomPhoto) { // ajouter une photo
        $sql = "INSERT INTO Photo VALUES(NULL,%s,'%s')";
        $sql = sprintf($sql,$idMembre,$nomPhoto);
        $request = mysqli_query($sql);
        mysqli_free_result($request);
    }

    function inscrire($nom,$prenom,$pseudo,$dateNaissance,$sexe,$email,$mdp) {
        $dateInscription = mysqli_fetch_assoc(mysqli_query(dbconnect(),"SELECT NOW() as date"));
        $sql = "INSERT INTO Membre VALUES(NULL,'%s','%s','%s','%s',NULL,'%s','%s',SHA1('%s'),'%s',0)";
        $sql = sprintf($sql,$nom,$prenom,$pseudo,$dateNaissance,$sexe,$email,$mdp,$dateInscription['date']);
        mysqli_query(dbconnect(),$sql);
    }

    function verifierLogin($pseudo, $password) { // test login
        $sql = "SELECT * FROM Membre WHERE Pseudo='%s'";
        $sql = sprintf($sql,$pseudo);
        $request1 = mysqli_query(dbconnect(), $sql);
        if(mysqli_num_rows($request1) === 0) {return -1;}
        $sql_ = "SELECT * FROM Membre WHERE Pseudo='%s' AND MotDePasse=SHA1('%s')";
        $sql_ = sprintf($sql_,$pseudo,$password);
        $request = mysqli_query(dbconnect(),$sql_);
        return mysqli_num_rows($request);
    }

    function getTop($critere,$nbre) {
        $sql = "SELECT * FROM Membre ORDER BY %s LIMIT %s";
        $sql = sprintf($sql,$critere,$nbre);
        $request = mysqli_query(dbconnect(),$sql);
        $result = array();
        while($tmp = mysqli_fetch_assoc($request)) {
            $result[] = $tmp;
        }
        mysqli_free_result($request);
        return $result;
    }

    function ajouterNbreVue($idVisiteur,$idMembre) {
        if($idVisiteur == $idMembre) {return 0;}
        $sql = "UPDATE Membre SET NbreVue=NbreVue+1 WHERE IdMembre=%s";
        $sql = sprintf($sql,$idMembre);
        mysqli_query(dbconnect(),$sql);
    }

    function verifierDoublon($attribut,$test) {
        $sql = "SELECT * FROM Membre WHERE %s = '%s'";
        $sql = sprintf($sql,$attribut,$test);
        $request = mysqli_query(dbconnect(),$sql);
        return mysqli_num_rows($request);
    }

    function checkInputSignUp($nom,$prenom,$pseudo,$dateNaissance,$sexe,$email,$pwd,$confirmPwd) {
        $result = array('nom'=>'','prenom'=>'','pseudo'=>'','email'=>'','pwd'=>'','dateNaissance'=>'','error'=>'');
        if($nom == null) {
            $result['error'].="<p class='error'>nom requis</p>";
        } else {
            $result['nom'] = $nom;
        }

        if($prenom == null) {
            $result['error'].="<p class='error'>prenom requis</p>";
        } else {
            $result['prenom'] = $prenom;
        }

        if($pseudo == null) {
            $result['error'].="<p class='error'>pseudo requis</p>";
        } else if(verifierDoublon("Pseudo",$pseudo)) {
            $result['error'].="<p class='error'>Pseudo déjà utilisé</p>";       
        } else {
            $result['pseudo'] = $pseudo;
        }
        
        if($email == null) {
            $result['error'].="<p class='error'>Email requis</p>";
        } else if(verifierDoublon("Email",$email) != 0) {
            $result['error'].="<p class='error'>Email déjà utilisé</p>";            
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result['error'].="<p class='error'>".$email." n'est pas une adresse valide</p>";
        } else {
            $result['email'] = $email;
        }

        if($pwd == null) {
            $result['error'].="<p class='error'>Mot de passe requis</p>";
        }else if($confirmPwd == null) {
            $result['error'].="<p class='error'>Confirmation du mot de passe requis</p>";
            $result['pwd'] = $pwd; 
        } else if(strcmp($pwd,$confirmPwd) != 0) {
            $result['error'].="<p class='error'>Les mots de passe ne correspondent pas</p>";
        }

        if($dateNaissance == null) {
            $result['error'].="<p class='error'>Verifier votre date de naissance</p>";
        } else {
            $result['dateNaissance'] = $dateNaissance;
        }
        return $result;
    }

    function checkInputLogin($login,$pwd) { 
        $result = array('error' => '','login'=>'');
        if($login == null) {
            $result['error'].="<p class='error'>Veuillez renseigner votre pseudo !</p>";
        }
        if($pwd == null) {
            $result['error'].="<p class='error'>Mot de passe obligatoire !</p>";
        }
        if(verifierLogin($login,$pwd) === 0) {
            $result['error'].= "<p class='error'>Mot de passe incorrect !</p>";
            $result['login'] = $login;
        } else if(verifierLogin($login,$pwd) === -1) {
            $result['error'].= "<p class='error'>Cette pseudo n'est pas encore inscrite !</p>";
        }
        return $result;
    }

?>