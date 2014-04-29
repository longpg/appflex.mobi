<?php if ( have_comments() ) : ?>
  <div id="respond">	
<div class="nav">
Bình luận
</div>
<div class="commentlist"><?php wp_list_comments(array('style' => 'div')); ?></div>
  <?php else :?>
  <?php if ('open' == $post->comment_status) : ?>
  <?php else :?>
  <p><?php _e('comment closed', 'themejunkie'); ?></p>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ('open' == $post->comment_status) : ?>
  <div id="respond">
<div class="nav">
Gửi Bình luận
</div>
    <div class="cancel-comment-reply"> <small>
      <?php cancel_comment_reply_link(); ?>
      </small> </div>
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p><?php print 'You must be'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php print 'Logged in'; ?></a> <?php print 'to post comment'; ?>.</p>
    <?php else : ?>
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
      <?php if ( $user_ID ) : ?>
      <p><?php print 'Logged as'; ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php print 'Log out'; ?> &raquo;</a></p>
      <?php else : ?> <div align="left"><font color="#404550"><b>Tên bạn:</b></font></div>
  
      <input class="author" type="text" value="" onclick="this.value='';" name="author" id="author" size="22" tabindex="1"/>
        <label for="author"><small>
        <?php if ($req) echo "(Required)"; ?>
        </small></label>

      <?php endif; ?>
      <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->	<div align="left"><font color="#404550"><b>Lời bình:</b></font></div>	<div style="background-color:#FFFF66;color:#FF0000;width:250px;border:#FF3366 1px dashed;font-size:10px">Yêu cầu bình luận có văn hóa và lịch sự !</div>
     <textarea name="comment" id="comment" tabindex="4"></textarea>
      	  <div align="left">	  <input class="submit" name="submit" type="submit" id="submit" tabindex="5" value="Gửi" />
      <?php comment_id_fields(); ?></div>
    </form>
    <?php endif; // If registration required and not logged in ?>
  <?php endif; // if you delete this the sky will fall on your head ?>
</div>
