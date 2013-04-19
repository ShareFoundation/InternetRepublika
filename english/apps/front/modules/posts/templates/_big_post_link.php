<table class="table-fbPost">
  <tbody><tr valign="top">
      <?php if ($post->getLinkImage() != '') { ?><td><?php include_partial('main/draw_post_link_photo', array('post' => $post, 'width' => 250, 'height' => 250)) ?></td><?php } ?>
      <td><div class="title"><?php echo $post->getPrintText() ?></div>
        <a href="<?php echo $post->getLinkUrl() != '' ? $post->getLinkUrl() : $post->getLink() ?>" target="_blank"><?php echo __('Go to link') ?></a>
      </td>
    </tr>
  </tbody>
</table>