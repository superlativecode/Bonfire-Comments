<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(4) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url(SITE_AREA .'/reports/comments') ?>" id="list"><?php echo lang('comments_list'); ?></a>
	</li>
	<?php if ($this->auth->has_permission('Comments.Reports.Create')) : ?>
	<li <?php echo $this->uri->segment(4) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url(SITE_AREA .'/reports/comments/create') ?>" id="create_new"><?php echo lang('comments_new'); ?></a>
	</li>
	<?php endif; ?>
</ul>