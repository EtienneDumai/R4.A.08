<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "votre_base_de_donnees"; // Remplacez par le nom de votre base

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Ajouter un article
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    $titre = $conn->real_escape_string($_POST['titre']);
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $auteur = $conn->real_escape_string($_POST['auteur']);
    
    $sql = "INSERT INTO article (titre, contenu, auteur) VALUES ('$titre', '$contenu', '$auteur')";
    if ($conn->query($sql) === TRUE) {
        echo "Article ajouté avec succès";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Modifier un article
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modifier'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $titre = $conn->real_escape_string($_POST['titre']);
    $contenu = $conn->real_escape_string($_POST['contenu']);
    $auteur = $conn->real_escape_string($_POST['auteur']);
    
    $sql = "UPDATE article SET titre='$titre', contenu='$contenu', auteur='$auteur' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Article modifié avec succès";
    } else {
        echo "Erreur : " . $conn->error;
    }
}

// Lecture des articles
$sql = "SELECT * FROM article";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des articles</title>
</head>
<body>
    <h1>Liste des articles</h1>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($row['titre']) . "</strong> - " . htmlspecialchars($row['auteur']) . " ";
                echo "<form method='post' style='display:inline;'><input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='text' name='titre' value='" . htmlspecialchars($row['titre']) . "'>";
                echo "<input type='text' name='contenu' value='" . htmlspecialchars($row['contenu']) . "'>";
                echo "<input type='text' name='auteur' value='" . htmlspecialchars($row['auteur']) . "'>";
                echo "<button type='submit' name='modifier'>Modifier</button></form></li>";
            }
        } else {
            echo "<li>Aucun article trouvé.</li>";
        }
        ?>
    </ul>

    <h2>Ajouter un article</h2>
    <form method="post">
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="text" name="contenu" placeholder="Contenu" required>
        <input type="text" name="auteur" placeholder="Auteur" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
