<?php foreach ($this->posts as $postItem): ?>
    <article>
        <h2><a href="<?= url('/posts/item?id=' . $postItem['id']) ?>"><?= $postItem['title'] ?></a></h2>
        <div><?= $postItem['text'] ?></div>
        <div>Автор: <?= $postItem['author'] ?></div>
    </article>
<?php endforeach; ?>



