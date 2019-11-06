<?php foreach($this->post as $fullPost): ?>
    <article>
        <h2><?php echo $fullPost['title']; ?></h2>
		<p><?php echo $fullPost['text']; ?></p>
		<h3>Author: <?php echo $fullPost['author']; ?></h3>
    </article>

<?php endforeach; ?>
