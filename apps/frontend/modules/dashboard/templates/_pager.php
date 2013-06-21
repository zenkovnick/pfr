<?php if ($pager->haveToPaginate())  { ?>

  <ul class="pagination">

    <li class="first"><a href="#" class="paginator-link-first">First</a></li>
    
    <li class="prev"><a href="#" class="paginator-link-prev">Prev</a></li>
    
    <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
        
        <?php if($page == $pager->getPage()): ?>
          <li class="active">
            <em id="<?php echo $page ?>"><?php echo $page ?></em>
            <span class="pointer"></span>
          </li>
        <?php else: ?>
          <li>
            <a href="#" id="<?php echo $page ?>" class="paginator-link pager"><?php echo $page ?></a>
            <?php /*echo link_to($page, 'resources/'.$action.'?page='.$page,'class="pager"') */?>
          </li>
        <?php endif; ?>
      
        <?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
    <?php endforeach ?>
    
    <li class="next"><a href="#" class="paginator-link-next">Next</a></li>
    <li class="last"><a href="#" class="paginator-link-last">Last</a></li>

  </ul>
    <script type="text/javascript">
        var page;
        var next_page;
        var prev_page;
        var count_page = <?php echo ceil($pager->count()/sfConfig::get('app_dashboard_limit')); ?>;
        jQuery(document).ready(function(){
            jQuery(".paginator-link").click(function(event){
                event.preventDefault();
                pageRecalculation(parseInt(jQuery(this).attr('id')));
                sendAjax(page);
            });

            jQuery(".paginator-link-prev").click(function(event){
                event.preventDefault();
                pageRecalculation(parseInt(jQuery("li.active em").attr('id')));
                if(prev_page > 0){
                    pageRecalculation(page - 1);
                    sendAjax(page);

                }
            });

            jQuery(".paginator-link-next").click(function(event){
                event.preventDefault();
                pageRecalculation(parseInt(jQuery("li.active em").attr('id')));
                if(next_page <= count_page){
                    pageRecalculation(page + 1);
                    sendAjax(page);

                }
            });
            jQuery(".paginator-link-first").click(function(event){
                event.preventDefault();
                pageRecalculation(parseInt(jQuery("li.active em").attr('id')));
                if(prev_page >= 1){
                    pageRecalculation(1);
                    sendAjax(1);

                }
            });
            jQuery(".paginator-link-last").click(function(event){
                event.preventDefault();
                pageRecalculation(parseInt(jQuery("li.active em").attr('id')));
                if(page < count_page){
                    pageRecalculation(count_page);
                    sendAjax(count_page);

                }
            });
        });

        function sendAjax(page_num){
            jQuery.ajax({
                url: '<?php echo url_for("@get_page_content?account_id={$account->getId()}") ?>',
                data: {page: page_num},
                dataType: 'json',
                type: "GET",
                cache: false,
                success: function(data) {
                    //alert(data.dashboard_data);
                    //alert("Success: "+page+" "+prev_page+" "+next_page);
                    jQuery(".flight-list-wrapper").html(data.dashboard_data);
                }
            });
        }

        function pageRecalculation(page_param){
            page = page_param;
            prev_page = page - 1;
            next_page = page + 1;
        }

    </script>
<?php } ?>
