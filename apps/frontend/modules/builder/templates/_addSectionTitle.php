<li class="risk-factor-entity li_section_title" id="rf_<?php echo $risk_factor->getId() ?>">
    <input type="hidden" value="<?php echo $risk_factor->getId() ?>" class="question_id" />
    <div class="entry-header" style="background: #FFF !important;">
        <span class="question truncate"><?php echo $risk_factor->getQuestion() ?></span>
        <a href="" class="delete-section" style="display: none;">Delete</a>
    </div>
    <input style="display: none;" type="text" class="section_title_value" value="<?php echo $risk_factor->getQuestion(); ?>" />
</li>