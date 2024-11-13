
<?php if (! empty($articles) && is_array($articles)) : ?>
    <ul>
        <?php foreach ($articles as $article): ?>
        <?php echo "<li > ".$article['id_articles'].". ".$article['titre'].".".$article['description'].". ".$article['contenu']." </li >";?>
        <?php endforeach; ?>
    </ul>
    <?php else : ?>
<?php endif ?>