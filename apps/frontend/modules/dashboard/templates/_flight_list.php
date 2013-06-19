<ul>
    <?php foreach($pager->getResults() as $flight): ?>
        <li>
            <?php if($flight->getDrafted()): ?>

                <div class="flight-title">
                    <a href="<?php echo url_for("@eidt_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">
                        <?php echo sprintf('%03d', $flight->getId());?> <?php echo $flight->getAirportTo() ? "to {$flight->getAirportTo()->getICAO()}" : "" ?> (Drafted)
                    </a>
                </div>
            <?php else: ?>
                <div class="flight-title">
                    <a href="<?php echo url_for("@view_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">
                        <?php echo sprintf('%03d', $flight->getId());?> <?php echo $flight->getAirportTo() ? "to {$flight->getAirportTo()->getICAO()}" : "" ?>
                    </a>
                </div>
            <?php endif ?>
            <div class="flight-info">
                <span>
                    @<?php echo date('H:i \o\n M\. d, Y', strtotime($flight->getCreatedAt()))?>
                    <?php echo $flight->getTripNumber() ? " via Type {$flight->getTripNumber()}" : "" ?>
                </span>
            </div>
            <?php if($flight->getRiskFactorSum()): ?>
                <span><?php echo $flight->getRiskFactorSum() ?></span>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>
<div class="pager">
    <?php include_partial('dashboard/pager', array('pager' => $pager, 'account' => $account)); ?>
</div>

<script type="text/javascript">
    /**
     * @var previousHash String for "hashchange" event emulation in IE8-
     */
    var previousHash = location.hash;

    jQuery(document).ready(function() {

        //if (getParamsFromHash(location.hash).tab === '') location.hash = '#newest';
        /*onHashChange();
        if (! "onhashchange" in window) {
            hashCheckInterval = setInterval( checkHash , 100)
        }else {
            jQuery(window).bind("hashchange", onHashChange );
        }*/
    });

    function getPage(page){
        var data = page != 1 ? 'page=' + page : '';
        jQuery.ajax({
            url: '<?php echo url_for("@get_page_content?account_id={$account->getId()}") ?>',
            data: data,
            dataType: 'json',
            type: "GET",
            cache: false,
            success: function(data) {
                //alert(data.dashboard_data);
                //alert("Success: "+page+" "+prev_page+" "+next_page);
                var el = jQuery(".flight-list-wrapper")
                el.html(data.dashboard_data);
                jQuery("ul.paginator li", el).removeClass("active");
                jQuery('ul.paginator a#'+page,el).parent("li").addClass("active");            }
        });
    }

    function getParamsFromHash( hash ){
//        if (hash === '') hash = '#newest';
        var matches = hash.match(/#([0-9]*).*/i);
        var page = 1;
        if ( matches !== null ){
            //tab = matches[1];
            page= matches[1] != '' ? matches[1] : 1;
        }
        return { page: page }
    }

    function onHashChange(){
        if (location.hash !== previousHash){
            previousHash = location.hash;
            var params = getParamsFromHash(location.hash);
            console.log(params);
            getPage(params.page);
        }
    }

    function checkHash(){
        if (location.hash !== previousHash){
            previousHash = location.hash;
            onHashChange()
        }
    }
</script>