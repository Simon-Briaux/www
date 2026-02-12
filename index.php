<!DOCTYPE html>
<html lang="fr">

<?php
$pageTitle = "Pernois Matériaux";
require_once "header.php";
?>


<main class="container">

    <!-- Section Hero -->
    <section class="hero">
        <h1>Exemple de titre</h1>
        <p>Découvrer tout nos articles</p>
    </section>

    <div class="articles-header">
        <h2>Articles</h2>
        <a href="articles.php" class="btn btn-all">Voir tout →</a>
    </div>
    
    <!-- Section Articles -->
    <section id="articles" class="grid">
        <?php
        // Tableau des articles
        $articles = [
            [
                'title' => 'PLanche de coffrage',
                'tag' => 'Bois',
                'image' => 'Images/coffrage.jpg',
            ],
            [
                'title' => 'Sac de ciments',
                'tag' => 'Poudre',
                'image' => 'Images/ciment.jpg',
            ],
            [
                'title' => 'Sable 04',
                'tag' => 'Agrégats',
                'image' => 'Images/sable.jpg',
            ]
        ];

        // Affichage des articles
        foreach ($articles as $a) {
            echo '<article class="card">';
            if(isset($a['image'])) { // Vérifie si l'image existe
                echo '<img class="thumb" src="'.$a['image'].'" alt="'.$a['title'].'">';
            } else {
                echo '<div class="thumb"></div>'; // Sinon on met un fond vide
            }
            echo '<div class="content">';
            echo '<span class="tag">'.$a['tag'].'</span>';
            echo '<div class="title">'.$a['title'].'</div>';
            echo '<p class="excerpt">'.($a['excerpt'] ?? '').'</p>';
            echo '<div class="meta">';
            echo '</div>'; // meta
            echo '</div>'; // content
            echo '</article>';
        }
        ?>
    </section>

    <!-- Section À propos -->
    <section id="about" style="margin-top:3rem">
        <h2>À propos</h2>
        <p class="excerpt">ceci est une zone de texte ou nous pouvons y mettre n'importe quoi</p>
    </section>

    <!-- Section Contact -->
    <section id="contact" style="margin-top:2rem">
        <h2>Contact</h2>
        <p class="excerpt">Mail: pernois.materiaux@gmail.com</p>
        <p class="excerpt">Adresse: 154 rue du Général Leclerc Pernois</p>
        <p class="excerpt">Téléphone: 03 60 24 73 48</p>
    </section>

</main>

<?php require_once "footer.php"; ?>

</body>
</html>
