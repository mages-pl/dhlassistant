<?php if(!isset($is_template)) die(); ?>
<?php
//Info
/* @var $field \DhlAssistant\Core\Models\FormField */
$field = $aVars['field'];
$field_name = $aVars['field_name'];
$id = str_replace(':', '_', $field_name);
$value = $field->Value === null && $field->DefaultValue !== null ? $field->DefaultValue : $field->Value;
?>
<div class="field <?php echo $field->Type; ?>" id="field_div_<?php echo $id; ?>">
<span class="field_name"><?php echo $field->FullName; ?>:</span>
<span id="field_<?php echo $id; ?>"><?php echo htmlspecialchars($value); ?></span>
<?php if (isset($field->Params['after_html'])) echo $field->Params['after_html']; ?>
</div>