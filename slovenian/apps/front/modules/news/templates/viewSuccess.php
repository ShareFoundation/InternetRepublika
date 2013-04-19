<div class="news-static-box">
  <ul>
    <li class="news-box">
      <h1><a href="<?php echo $news->getLink() ?>"><?php echo $news->getTitle() ?></a></h1>
      <div class="content"><?php echo sfOutputEscaper::unescape($news->getText()) ?></div>
      
      <div class="socialNews">
        <div class="like-share">  
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $news->getLink() ?>" data-text="<?php echo $news->getTitle() ?>" data-hashtags="netrepublika">Tweet</a>
        </div>
        <div class="like-share">
          <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $news->getLink() ?>&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=190915007686913" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:21px;" allowTransparency="true"></iframe>
        </div>
      </div> 
      <?php include_component('comment', 'comment', array('type' => 3, 'id' => $news->getId())) ?>
    </li>
  </ul>
</div>