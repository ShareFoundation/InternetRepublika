<ul id="navigation">
  
  <?php if($sf_user->isAuthenticated()){ ?> 
    
    <li><a <?php echo ($sf_context->getModuleName() == 'main')?'class="active"':'' ?> href="<?php echo url_for('@homepage', true) ?>">Home Page</a></li>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See User', 'Manage User'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'sfGuardUser')?'class="active"':'' ?> href="<?php echo url_for('sf_guard_user/index', true) ?>">Users</a></li>  
    <?php } ?>
  
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Badge', 'Manage Badge'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'badge')?'class="active"':'' ?> href="<?php echo url_for('badge/index', true) ?>">Badges</a></li>
    <?php } ?>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Party', 'Manage Party'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'party')?'class="active"':'' ?> href="<?php echo url_for('party/index', true) ?>">Parties</a></li>
    <?php } ?>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Flag', 'Manage Flag'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'flag' || $sf_context->getModuleName() == 'flag_view')?'class="active"':'' ?> href="<?php echo url_for('flag/index', true) ?>">Flag</a></li>
      <li><a <?php echo ($sf_context->getModuleName() == 'flag_comment')?'class="active"':'' ?> href="<?php echo url_for('flag_comment/index', true) ?>">Flag Comments</a></li>
    <?php } ?>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Page', 'Manage Page'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'mg_page_admin')?'class="active"':'' ?> href="<?php echo url_for('mg_page_admin/index', true) ?>">Pages</a></li>
    <?php } ?>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Content', 'Manage Content'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'mg_content_admin')?'class="active"':'' ?> href="<?php echo url_for('mg_content_admin/index', true) ?>">Content</a></li>
    <?php } ?>
      
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See Menu', 'Manage Menu'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'menu')?'class="active"':'' ?> href="<?php echo url_for('menu/index', true) ?>">Menus</a></li>
    <?php } ?>
    
    <?php if($sf_user->hasCredential(array('Entire Admin', 'See News', 'Manage News'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'news')?'class="active"':'' ?> href="<?php echo url_for('news/index', true) ?>">News</a></li>
    <?php } ?>

    <?php if($sf_user->hasCredential(array('Entire Admin', 'Manage Settings'), false)){ ?>
      <li><a <?php echo ($sf_context->getModuleName() == 'settings')?'class="active"':'' ?> href="<?php echo url_for('settings/index', true) ?>">Settings</a></li>
    <?php } ?>
      
    <li><a href="<?php echo url_for('@sf_guard_signout', true) ?>">Logout</a></li>
  <?php }else{ ?>
    <li><a <?php echo ($sf_context->getActionName() == 'signin')?'class="active"':'' ?> href="<?php echo url_for('@sf_guard_signin', true) ?>">Login</a></li>    
  <?php } ?>
</ul>