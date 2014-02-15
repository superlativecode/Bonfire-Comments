<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($comments))
{
	$comments = (array) $comments;
}
$id = isset($comments['id']) ? $comments['id'] : '';

?>
<div class="admin-box">
	<h3>Comments</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('text') ? 'error' : ''; ?>">
				<?php echo form_label('Comment'. lang('bf_form_label_required'), 'comments_text', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'comments_text', 'id' => 'comments_text', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments_text', isset($comments['text']) ? $comments['text'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('text'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('comments_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/reports/comments', lang('comments_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>