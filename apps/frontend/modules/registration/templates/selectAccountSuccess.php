<h1>Which Account</h1>
<ul>
    <?php foreach($accounts as $account): ?>
        <li>
            <img src="/uploads/avatar/<?php echo $account['photo'] ?>" />
            <a href=""><?php echo $account['title'] ?></a>
            <span><?php echo $account['manager'] ?></span>
        </li>
    <?php endforeach; ?>
</ul>