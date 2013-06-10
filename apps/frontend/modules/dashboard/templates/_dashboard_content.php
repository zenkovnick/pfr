<ul>
    <?php foreach($pager->getResults() as $flight): ?>
        <li>
            <?php if($flight->getDrafted() && $flight->getStatus() == "new"): ?>
                <span>Drafted</span>
                <span><?php echo $flight->getId() ?></span>
                <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">Edit</a>
            <?php elseif($flight->getDrafted() && $flight->getStatus() == "assess"): ?>
                <span><?php echo $flight->getTripNumber() ?>(Drafted)</span>
                <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">Edit</a>
            <?php else: ?>
                <span><?php echo $flight->getTripNumber() ?></span>
                <span><?php echo $flight->getRiskFactorSum() ?></span>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>