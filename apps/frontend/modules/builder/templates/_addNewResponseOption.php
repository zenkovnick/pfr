<li class="new-response-option">
    <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['response_text'])); ?>
    <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['response_value'])); ?>
    <div class="remove-note-wrapper hidden">
        <?php include_partial("builder/field", array('field' => $form['new-response'][$number]['note'], 'placeholder' => 'Help text or link (optional)')); ?>
        <a href="" class="remove-note">Remove note</a>
    </div>
    <div class="add-note-wrapper">
        <a href="" class="add-note">Add note</a>
    </div>
    <a href="" class="delete-response-option-link hidden">Delete</a>
</li>