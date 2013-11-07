<?php if($pager->getResults()->count() > 0): ?>
    <ul class="flights-list">
        <?php foreach($pager->getResults() as $flight): ?>
            <?php if($flight->getRiskFactorType() == 'medium'): ?>
                <li class="yellow" id="<?php echo $flight->getId() ?>">
            <?php elseif($flight->getRiskFactorType() == 'high'): ?>
                <li class="red" id="<?php echo $flight->getId() ?>">
            <?php else: ?>
                <?php if($flight->getRiskFactorSum() == 0): ?>
                    <li class="grey" id="<?php echo $flight->getId() ?>">
                <?php else: ?>
                    <li id="<?php echo $flight->getId() ?>">
                <?php endif ?>
            <?php endif ?>
                <a href="<?php echo url_for('@delete_risk_assessment_popup?id='.$flight->getId()) ?>" class="delete_risk_assessment fancy">X</a>

            <?php if(!is_null($flight->getRiskFactorSum())): ?>
                    <span class="risk"><?php echo $flight->getRiskFactorSum() ?></span>
                <?php endif ?>

                <a class="name" href="<?php echo url_for(($flight->getDrafted() ? "@edit_flight" : "@view_flight")."?account_id={$account->getId()}&id={$flight->getId()}") ?>">
                    <?php echo $flight->getAirportFrom()->getICAO() ? $flight->getAirportFrom()->getICAO() : "" ?>
                    <?php echo $flight->getAirportTo()->getICAO() ? "- {$flight->getAirportTo()->getICAO()}" : "" ?>
                    <?php echo date('m/d/Y', strtotime($flight->getDepartureDate()))?>

                    ETD <?php echo $flight->getTimeStr(); ?>
                    <?php echo $flight->getTripNumber() ? "({$flight->getPlane()->getTailNumber()})" : "" ?>

                    <?php if($flight->getDrafted()): ?>
                        <?php echo " - draft" ?>
                    <?php endif ?>

                </a>
                <?php if($flight->getStatus() == 'complete'): ?>
                    <a class="send-flight-email-link" href="#">Send</a>
                <?php endif ?>
                <span class="info">
                    <?php echo "Submitted ".date('m/d/Y Hi', strtotime($flight->getUpdatedAt()))?>
                </span>
                <?php if($flight->getStatus() == 'complete'): ?>
                    <div class="email-form" style="display:none;">
                        <input type="text" class="emails" placeholder="List emails separated with commas" />
                        <button class="send-email btn btn-green">Send</button>
                        <p class="email-error"></p>
                    </div>
                <?php endif ?>

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
    var email_pattern = /^[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+(\.[-a-z0-9!#\$%&'*+\/=?\^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i;


    jQuery(document).ready(function() {

        //if (getParamsFromHash(location.hash).tab === '') location.hash = '#newest';
        /*onHashChange();
        if (! "onhashchange" in window) {
            hashCheckInterval = setInterval( checkHash , 100)
        }else {
            jQuery(window).bind("hashchange", onHashChange );
        }*/

        jQuery('a.send-flight-email-link').bind('click', showEmailForm);
        jQuery('.send-email').bind('click', sendEmail);
        //jQuery('.delete_risk_assessment').bind('click', deleteRiskAssessment)

        jQuery("a.fancy").fancybox({
            'titlePosition'     : 'over',
            'overlayOpacity'    : 0.4,
            'centerOnScroll'    : true,
            showCloseButton     : false,
            'type'              : 'ajax',
            hideOnOverlayClick  : true

        });

    });

    function showEmailForm(event) {
        event.preventDefault();
        var root_li = jQuery(this).closest('li');
        var form = jQuery('.email-form', root_li);
        var emails_el = jQuery('.emails', form);
        var email_error = jQuery('p.email-error', form);
        if(form.hasClass('open')){
            form.removeClass('open').hide(500);
            emails_el.val('');
            email_error.text('');
        } else {
            form.addClass('open').show(500);
        }
    }

    function sendEmail(event){
        event.preventDefault();
        var root_li = jQuery(this).closest('li');
        var root_el = jQuery(this).closest('.email-form');
        var emails_el = jQuery('.emails', root_el);
        var email_error = jQuery('p.email-error', root_el);
        if(emails_el.val()) {

            var emails = emails_el.val().split(',');
            var wrong_emails = [];
            for(var idx=0; idx<emails.length; idx++) {
                if(!jQuery.trim(emails[idx]).match(email_pattern)){
                    wrong_emails.push(emails[idx]);
                }
            }
            if(wrong_emails.length == 0){
                emails_el.removeClass('invalid-field');
                email_error.removeClass('fail');
                email_error.text('Sending...');
                jQuery.ajax({
                    url: '<?php echo url_for("@dashboard_email?account_id={$account->getId()}") ?>',
                    dataType: 'json',
                    data: {emails: emails_el.val(), flight_id: root_li.prop('id')},
                    type: 'post',
                    success: function(data) {
                        if(data.result == "OK"){
                            email_error.text('Report was sent successfully');
                            setTimeout(function(){
                                root_el.removeClass('open').hide(500);
                                emails_el.val('');
                                email_error.text('');
                            }, 2000)
                        } else {
                            email_error.addClass('fail');
                            email_error.text(data.result);
                        }
                    }

                });
            } else {
                var error_text = wrong_emails.join(', ') + " incorrect";
                email_error.addClass('fail');
                email_error.text(error_text);
            }
        } else {
            emails_el.addClass('invalid-field');
        }

    }

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