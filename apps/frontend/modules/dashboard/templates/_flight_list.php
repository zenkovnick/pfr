<?php if($pager->getResults()->count() > 0): ?>
    <ul class="flights-list">
        <?php foreach($pager->getResults() as $flight): ?>
            <?php if($flight->getRiskFactorType() == 'medium'): ?>
                <li class="yellow">
            <?php elseif($flight->getRiskFactorType() == 'high'): ?>
                <li class="red">
            <?php else: ?>
                <?php if($flight->getRiskFactorSum() == 0): ?>
                    <li class="grey">
                <?php else: ?>
                    <li>
                <?php endif ?>
            <?php endif ?>
                <?php if(!is_null($flight->getRiskFactorSum())): ?>
                    <span class="risk"><?php echo $flight->getRiskFactorSum() ?></span>
                <?php endif ?>
                
                <?php if($flight->getDrafted()): ?>
                    <a class="name" href="<?php echo url_for("@edit_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">
                        <?php echo sprintf('%03d', $flight->getId());?>
                        <?php echo $flight->getAirportTo()->getICAO() ? "to {$flight->getAirportTo()->getICAO()}" : "" ?> (Drafted)
                    </a>
                <?php else: ?>
                    <a class="name" href="<?php echo url_for("@view_flight?account_id={$account->getId()}&id={$flight->getId()}") ?>">
                        <?php echo sprintf('%03d', $flight->getId());?>
                        <?php echo $flight->getAirportTo()->getICAO() ? "to {$flight->getAirportTo()->getICAO()}" : "" ?>
                    </a>
                <?php endif ?>
                
                <span class="info">
                    @<?php echo date('H:i \o\n M\. d, Y', strtotime($flight->getCreatedAt()))?>
                    <?php echo $flight->getTripNumber() ? " via Type {$flight->getPlane()->getTailNumber()}" : "" ?>
                </span>
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <p class="no-flights-found">No Results</p>
<?php endif ?>

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