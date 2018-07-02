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

    function inscrire($nom,$prenom,$pseudo,$day,$month,$year,$photoProfil,$sexe,$email,$mdp) {  
        $sql = "SELECT STR_TO_DATE('%s%s%s%s%s','%s%s%s')";
        $sql = sprintf($sql,$day,'/',$month,'/',$year,'%d', '/%m', '/%Y');
        $sql1 = "INSERT INTO Membre VALUES(NULL,'%s','%s','%s','%s','%s','%s','%s',SHA1('%s'),'SELECT NOW()')";
        $sql1 = sprintf($sql1,$nom,$prenom,$pseudo,$sql,$photoProfil,$sexe,$email,$mdp);
        $request = mysqli_query(dbconnect(),$sql);
        mysqli_free_result($request);
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

?>