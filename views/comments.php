<div id="comments">
    <div>
    	<h3>Comments</h3>
    </div>
    
    <br />
    
    <?php $this->load->view('comments/comment_form'); ?>
    
    <hr>
    
    <?php if (!empty($comments)) : ?>
        <h4>All Comments</h4>
    	<?=$comments?>
    <?php else: ?>
        <h4>No Comments</h4>
    <?php endif; ?>
        
</div>