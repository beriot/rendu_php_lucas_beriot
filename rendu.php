<?php
require __DIR__ . "/vendor/autoload.php";

## ETAPE 0

## CONNECTEZ VOUS A VOTRE BASE DE DONNEE
$pdo = new PDO('mysql:host=127.0.0.1;dbname=php', "root", "");
### ETAPE 1

####CREE UNE BASE DE DONNEE AVEC UNE TABLE PERSONNAGE, UNE TABLE TYPE
/*
 * personnages
 * id : primary_key int (11)
 * name : varchar (255)
 * atk : int (11)
 * pv: int (11)
 * type_id : int (11)
 * stars : int (11)
 */

/*
 * types
 * id : primary_key int (11)
 * name : varchar (255)
 */


#######################
## ETAPE 2

#### CREE DEUX LIGNE DANS LA TALE types
# une ligne avec comme name = feu
# une ligne avec comme name = eau


#######################
## ETAPE 3

# AFFICHER DANS LE SELECTEUR (<select name="" id="">) tout les types qui sont disponible (cad tout les type contenu dans la table types)

$query = $pdo->prepare("SELECT * FROM types ORDER BY id DESC ");
$query->execute();
$array = $query->fetchAll(PDO::FETCH_OBJ);





#######################
## ETAPE 4

# ENREGISTRER EN BASE DE DONNEE LE PERSONNAGE, AVEC LE BON TYPE ASSOCIER
if (!empty($_POST)) {
    $name = $_POST['nom'];
    $atk = $_POST['atk'];
    $type = $_POST['type'];
    $pv = $_POST['pv'];
        $query = $pdo->prepare("INSERT INTO personnages (name, atk, pv, type_id) VALUES (:name, :atk, :pv, :type) ");
        $query->execute(["name" => $name, "atk" => $atk, "pv" => $pv, "type" => $type]);
}


#######################
## ETAPE 5
# AFFICHER LE MSG "PERSONNAGE ($name) CREER"

#######################
## ETAPE 6

# ENREGISTRER 5 / 6 PERSONNAGE DIFFERENT

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rendu Php</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="nav mb-3">
    <a href="./rendu.php" class="nav-link">Acceuil</a>
    <a href="./personnage.php" class="nav-link">Mes Personnages</a>
    <a href="./combat.php" class="nav-link">Combats</a>
</nav>
<h1>Acceuil</h1>
<div class="w-100 mt-5">
    <form action="" method="POST" class="form-group">
        <div class="form-group col-md-4">
            <label for="">Nom du personnage</label>
            <input type="text" name="nom" class="form-control" placeholder="Nom">
        </div>

        <div class="form-group col-md-4">
            <label for="">Attaque du personnage</label>
            <input type="text" name="atk" class="form-control" placeholder="Atk">
        </div>
        <div class="form-group col-md-4">
            <label for="">Pv du personnage</label>
            <input type="text" name="pv" class="form-control" placeholder="Pv">
        </div>
        <div class="form-group col-md-4">
            <label for="">Type</label>
            <select name="type" id="">
                <option value="" selected disabled>Choissisez un type</option>
                <?php foreach ($array as $type) { ?>
                    <option value="<?= $type->id ?>"><?= $type->name ?> </option>
                <?php } ?>

            </select>
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
    <?php
    echo "PERSONNAGE " .$name. " CREER";
    ?>
</div>

</body>
</html>
