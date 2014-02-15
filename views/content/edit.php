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
					<textarea name="comments_text" id="comments_text" rows="5" cols="80" style="width: 725px;"><?=set_value('comments_text', isset($comments['text']) ? $comments['text'] : '')?></textarea>
					<span class='help-inline'><?php echo form_error('text'); ?></span>
				</div>
			</div>
			<div class="control-group ">
				<div class='controls'>
				    <label for="approved">Approved</label>
				    <input type="checkbox" name="approved" id="approved" value="1" <?=set_checkbox('approved', isset($comments['approved']) && $comments['approved'] == 1  ? TRUE : FALSE)?> />
				</div>
			</div>
			<?php if(!empty($comments['parent_id'])): ?>
    			<div class="control-group ">
    				<div class='controls'>
    					<a href="<?=site_url(SITE_AREA . '/content/comment/edit/' . $comments['parent_id'])?>" title="Go to Parent" class="btn btn-default">Go to Parent Comment</a>
    				</div>
    			</div>
			<?php endif; ?>
			
			<?php if(!empty($comments['user_id'])): ?>
    			<div class="control-group ">
    				<div class='controls'>
    					<a href="<?=site_url(SITE_AREA . '/settings/user/edit/' . $comments['user_id'])?>" title="Go to User" class="btn btn-default">Go to User</a>
    				</div>
    			</div>
			<?php endif; ?>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('comments_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/content/comments', lang('comments_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Comments.Content.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('comments_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('comments_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>