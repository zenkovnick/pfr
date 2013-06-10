<ul>
    <?php foreach($pager->getResults() as $flight): ?>
        <li>
            <?php if($flight->getDrafted() && $flight->getStatus() == "new"): ?>
                <?php if($flight->getTripNumber()): ?>
                    <span><?php echo $flight->getTripNumber() ?>(Drafted)</span>
                <?php else: ?>
                    <span>Drafted</span>
                    <span><?php echo $flight->getId() ?></span>
                <?php endif ?>
                <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">Edit</a>
            <?php elseif($flight->getDrafted() && $flight->getStatus() == "assess"): ?>
                <span><?php echo $flight->getTripNumber() ?>(Drafted)</span>
                <a href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">Edit</a>
            <?php else: ?>
                <span><?php echo $flight->getTripNumber() ?></span>
                <span><?php echo $flight->getRiskFactorSum() ?></span>
                <span><?php echo date('Y-m-d', strtotime($flight->getCreatedAt())) ?></span>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>
<div class="pager">
    <?php include_partial('dashboard/pager', array('pager' => $pager, 'account' => $account)); ?>
</div>