<?php if(!empty($current_user->id)): ?>
<!-- Modal -->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <?=form_open(site_url($this->uri->uri_string()), array('id' => 'comment_form', 'class' => 'form-horizontal'))?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Comment</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <textarea name="comments_text" id="comments_text" class="form-control input-xxlarge markdown_editor"><?=set_value('comments_text')?></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <?=form_hidden('post_id', $post->post_id)?>
        <?=form_hidden('slug', $post->slug)?>
        <?=form_hidden('comment_id', set_value('comment_id'))?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="create_comment">Create Comment</button>
      </div>
      <?=form_close()?>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-primary add_comment" data-toggle="modal" data-target="#commentModal">Add Comment</button>
<?php else: ?>
    <div class="alert alert-info text-center">
        You must be logged in to comment. <br> <a href="<?php echo site_url(LOGIN_URL); ?>" class="btn btn-info">Sign In</a>
    </div>
<?php endif; ?>