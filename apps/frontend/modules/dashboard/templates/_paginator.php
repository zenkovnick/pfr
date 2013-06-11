<?php if ($pager->haveToPaginate())  { ?>

  <ul class="pagination">

    <!-- <span><?php //echo link_to('Latest', 'resources/'.$action.'?page='.$pager->getFirstPage(),'class="pager"') ?></span> -->
    
    <li class="prev"><a href="#<?php echo ( $pager->getPage() > 1 ? $pager->getPage() -1 : $pager->getPage() ); ?>" class="paginator-link-prev">Prev</a></li>
    
    <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
        
        <?php if($page == $pager->getPage()): ?>
          <li class="active">
            <em id="<?php echo $page ?>"><?php echo $page ?></em>
            <span class="pointer"></span>
          </li>
        <?php else: ?>
          <li>
            <a href="#<?php echo $page; ?>" id="<?php echo $page ?>" class="paginator-link pager"><?php echo $page ?></a>
            <?php /*echo link_to($page, 'resources/'.$action.'?page='.$page,'class="pager"') */?>
          </li>
        <?php endif; ?>
      
        <?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
    <?php endforeach ?>
    
    <li class="next"><a href="#<?php echo ( $pager->getPage()+1 < count($pager) ? $pager->getPage() +1 : $pager->getPage() ); ?>" class="paginator-link-next">Next</a></li>
    
    <!-- <span><?php //echo link_to('Oldest', 'resources/'.$action.'?page='.$pager->getLastPage(),'class="pager"') ?></span> -->

  </ul>
<?php } ?>
