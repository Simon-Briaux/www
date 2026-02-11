<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pernois Materiaux</title>
  <link rel="icon" href="Images/Logo.jpg" type="image/jpg">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
  <div class="container nav">
    <div class="brand">Pernois<span>Materiaux</span></div>
    <nav>
      <a href="articles.php">Articles</a>
      <a href="#about">À propos</a>
      <a href="#contact">Contact</a>
    </nav>
  </div>
</header>

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

<footer>
  <div class="container">
    <p>© 2026 — Pernois materiaux</p>
  </div>
</footer>
<script src="main.js"></script>
</body>
</html>
