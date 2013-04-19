<div class="postBlock">
  <div class="dropHover"></div>
  <?php include_partial('posts/post_header', array('post' => $post)) ?>
  <div class="postContent fbPost smiley-universal" style="border-color: <?php echo $post->getBadge2()->getStyle() ?>">
    <table>
      <tbody><tr valign="top">
          <?php if($post->getLinkImage() != ''){ ?><td><?php include_partial('main/draw_post_link_photo', array('post' => $post)) ?></td><?php } ?>
          <td><div class="title"><?php echo $post->getPrintText() ?></div>
            <a href="<?php echo $post->getLinkUrl() != '' ? $post->getLinkUrl() : $post->getLink() ?>" target="_blank"><?php echo __('Go to link') ?></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php include_partial('posts/post_footer', array('post' => $post)) ?>
</div>