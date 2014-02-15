<li>
    <blockquote class="comment">
        <?php echo Parsedown::instance()->parse(strip_tags($comment->text)); ?>
        <footer class='subtitle text-right'>
            - <?php echo $comment->user->display_name; ?>
            &nbsp;&nbsp;&nbsp;
            <span class="btn btn-default btn-sm reply-to" data-id="<?php echo $comment->id;?>">Reply</span>
        </footer>
    </blockquote>
    <?php echo $nested; ?>
</li>