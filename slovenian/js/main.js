function ajaxRenderComponent(module, component, data, successCallback, beforeCallback)
{
  return jQuery.ajax({
    type: 'post',
    url: BaseUrl + 'ajax-render-component/' + module + '/' + component,
    data: data,
    beforeSend: beforeCallback,
    success: successCallback
  });
}

function createModal(id, content, title, width, height)
{
  jQuery('body').append('<div id="' + id + '" style="display: none;">' + content + '</div>');
  jQuery("#" + id).dialog({
    title: title,
    width: width,
    height: height,
    autoOpen: false,
    modal: true
  });
}
function showModal(id)
{
  jQuery('#' + id).dialog('open');
}
function closeModal(id)
{
  jQuery('#' + id).dialog('close');
}
function setContentModal(id, content)
{
  jQuery('#' + id).html(content);
}
function setLoadingToModal(id)
{
  setContentModal(id, strLoading);
}

function showRegisterDialog()
{
  showModal('modal-register');
  ajaxRenderComponent('auth', 'index', '', function(data) {
    setContentModal('modal-register', data);
  },
          function() {
            setLoadingToModal('modal-register')
          });
}

function showMyProfileDialog()
{
  showModal('modal-profile');
  ajaxRenderComponent('user', 'my_profile', '', function(data) {
    setContentModal('modal-profile', data);
  },
          function() {
            setLoadingToModal('modal-profile')
          });
}

function showPartyDialog()
{
  showModal('modal-party');
  ajaxRenderComponent('user', 'create_party', '', function(data) {
    setContentModal('modal-party', data);
  },
          function() {
            setLoadingToModal('modal-party')
          });
}

function showPartyEditDialog()
{
  showModal('modal-party-edit');
  ajaxRenderComponent('user', 'create_party', '', function(data) {
    setContentModal('modal-party-edit', data);
  },
          function() {
            setLoadingToModal('modal-party-edit')
          });
}

function showPostDialog(replicaPostId)
{
  data = '';
  if (typeof replicaPostId === "undefined") {

  } else {
    data = 'replica_id=' + replicaPostId;
  }
  showModal('modal-post');
  ajaxRenderComponent('posts', 'create_post_index', data, function(data) {
    setContentModal('modal-post', data);
  },
          function() {
            setLoadingToModal('modal-post');
          });
}

function showEditPostDialog(postId)
{
  showModal('modal-post');
  ajaxRenderComponent('posts', 'create_post_index', 'post_id=' + postId, function(data) {
    setContentModal('modal-post', data);
  },
          function() {
            setLoadingToModal('modal-post');
          });
}

function featured(postId)
{
  ajaxRenderComponent('posts', 'featured', 'post_id=' + postId, function(data) {
    window.location.reload();
  });
}


function ajaxData(data)
{
  var obj = jQuery.parseJSON(data);
  this.status = obj.status;
  this.content = obj.content;
}

jQuery(document).ready(function() {
  createModal('modal-register', '', strLogin, 600, 450);
  createModal('modal-profile', '', strMyProfile, 600, 450);
  createModal('modal-party', '', strCreateParty, 600, 450);
  createModal('modal-party-edit', '', strEditParty, 600, 450);
  createModal('modal-post', '', strPost, 650, 550);
  createModal('modal-report', '', strReportPost, 650, 350);
  createModal('finish-register', '', strRegisterSuccess, 650, 450);
});

// Javascript controllers
function afterLogin(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-register');
    jAlert(ajaxResponse.content, strLogin, function() {
      window.location.reload();
    });
  } catch (e) {
    jQuery('#div-login').html(data);
  }
}

function afterForgotPassword(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-register');
    jAlert(ajaxResponse.content, strNewPassword);
  } catch (e) {
    jQuery('#div-forgot-password').html(data);
  }
}

function beforeCreateReport(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-report');
    jAlert(ajaxResponse.content, strReportPost);
  } catch (e) {
    jQuery('#div-post-report').html(data);
  }
}

function afterCreateReport(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-report');
    jAlert(ajaxResponse.content, strReportPost);
  } catch (e) {
    jQuery('#div-post-report').html(data);
  }
}

function checkIsLoggedIn()
{
  ajaxRenderComponent('auth', 'is_logged_in', '', function(data) {
    if (data != '') {
      jAlert(strSessionExpire, strLogin, function() {
        window.location.reload();
      });
    }
  });
}

function afterLogout(data)
{
  var ajaxResponse = new ajaxData(data)
  closeModal('modal-register');
  jAlert(ajaxResponse.content, strLogout, function() {
    window.location.reload();
  });
}

function afterRegister(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-register');
    window.location.reload();
  } catch (e) {
    jQuery('#div-register').html(data);
  }
}

function afterSaveProfile(data)
{
  try {
    var ajaxResponse = new ajaxData(data)
    closeModal('modal-profile');
    jAlert(ajaxResponse.content, strMyProfile, function() {
      window.location.reload();
    });
  } catch (e) {
    jQuery('#modal-profile').html(data);
  }
}


function afterSaveParty(data)
{
  try {
    var ajaxResponse = jQuery.parseJSON(data);
    closeModal('modal-party');
    jAlert(ajaxResponse.content, strCreateParty, function() {
      window.location.href = ajaxResponse.url;
    });
  } catch (e) {
    jQuery('#modal-party').html(data);
  }
}

function afterEditSaveParty(data)
{
  try {
    var ajaxResponse = jQuery.parseJSON(data);
    closeModal('modal-party-edit');
    jAlert(ajaxResponse.content, strEditParty, function() {
      window.location.href = ajaxResponse.url;
    });
  } catch (e) {
    jQuery('#modal-party-edit').html(data);
  }
}

function afterSavePost(data)
{
  try {
    var ajaxResponse = jQuery.parseJSON(data);
    closeModal('modal-post');
    jAlert(ajaxResponse.content, strPost, function() {
      window.location.href = ajaxResponse.url;
    });
  } catch (e) {
    jQuery('#create-post-main-container').html(data);
  }
}

function popRegisterToggle()
{
  jQuery("#div-login").toggle();
  jQuery("#div-register").toggle();
}

function getPollResults(pollId, obj)
{
  ajaxRenderComponent('posts', 'poll_results', 'poll_id=' + pollId, function(data) {
    jQuery('.pollAnswers', obj).html(data);
    jQuery('.poll_vote_no_post_button', obj).show();
    jQuery('.poll_vote_button', obj).hide();
    jQuery('#posts').masonry('reload');
  },
          function() {
            jQuery('.pollAnswers', obj).html(strLoading);
            jQuery('#posts').masonry('reload');
          });
}

function getPollAnswers(pollId, obj)
{
  ajaxRenderComponent('posts', 'poll_answers', 'poll_id=' + pollId, function(data) {
    jQuery('.pollAnswers', obj).html(data);
    jQuery('.poll_vote_no_post_button', obj).hide();
    jQuery('.poll_vote_button', obj).show();
    redrawCheckBoxes();
    jQuery('#posts').masonry('reload');
  },
          function() {
            jQuery('.pollAnswers', obj).html(strLoading);
            jQuery('#posts').masonry('reload');
          });
}

function pollVote(pollId, obj)
{
  ajaxRenderComponent('posts', 'poll_vote', obj.serialize() + "&poll_id=" + pollId, function(data) {
    var ajaxResponse = new ajaxData(data)
    if (ajaxResponse.status == 'error') {
      ajaxRenderComponent('posts', 'poll_answers', "&poll_id=" + pollId, function(data) {
        jQuery('.pollAnswers', obj).html(data);
        redrawCheckBoxes();
        jQuery('#posts').masonry('reload');
      });
      if (ajaxResponse.content == 'login') {
        showRegisterDialog();
      } else {
        jAlert(ajaxResponse.content, strPoll);
      }
      jQuery('#posts').masonry('reload');
    }
    else {
      jQuery('.poll_vote_button', obj).remove();
      jQuery('.poll_vote_no_post_button', obj).remove();
      getPollResults(pollId, obj);
    }
  }, function() {
    jQuery('.pollAnswers', obj).html(strLoading);
    jQuery('#posts').masonry('reload');
  });
}

function redrawTwitterButton()
{
  fixDescriptionWrap();
  twttr.widgets.load();
  redrawCheckBoxes();
  FB.XFBML.parse();
  drawDropable();
}

function fixDescriptionWrap() {
  jQuery('.post-description').each(function() {
    jQuery(this).text(jQuery(this).text().replace(/(\S{35})/g, '$1 '));
  });
}

function redrawCheckBoxes()
{
  Custom.init();
}

function drawDropable()
{
  jQuery(".postBlock").droppable({
    accept: ".leftSidebar .badge",
    drop: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).hide();

      var postId = jQuery('.postTitle', jQuery(this)).attr('post_id');
      var badgeId = jQuery(ui.draggable).attr('badge_id');
      var badgeType = jQuery(ui.draggable).attr('badge_type');
      addBadge(postId, badgeId, isUserLoggedIn, jQuery(this), badgeType);

    },
    over: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).show();
    },
    out: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).hide();
    }
  });
}

function drawDropableBig()
{
  jQuery("#singlePost").droppable({
    accept: ".leftSidebar .badge",
    drop: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).hide();

      var postId = jQuery('.spostTitle', jQuery(this)).attr('post_id');
      var badgeId = jQuery(ui.draggable).attr('badge_id');
      var badgeType = jQuery(ui.draggable).attr('badge_type');
      addBadgeBig(postId, badgeId, isUserLoggedIn, jQuery(this), badgeType);

    },
    over: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).show();
    },
    out: function(event, ui) {
      jQuery('.dropHover', jQuery(this)).hide();
    }
  });
}

function addBadgeBig(postId, badgeId, loggedIn, obj, badgeType)
{
  if (badgeType != 4) {
    ajaxRenderComponent('posts', 'add_badge', 'post_id=' + postId + '&badge_id=' + badgeId + '&logged_in=' + loggedIn, function(data) {
      var data = jQuery.parseJSON(data);

      if (data.status == 'success') {
        jQuery('.spostBadge div', obj).removeClass('ajax');
        jQuery('.spostBadge div', obj).css('background-image', 'url(' + data.badge1 + ')');
        jQuery('.spostContent', obj).css('border-color', data.badge2);
        redrawRightIndexSupportBox(postId);
      } else {
        jAlert(data.content, strBadges)
      }
    }, function() {
      jQuery('.spostBadge div', obj).addClass('ajax');
    });
  } else {
    ajaxRenderComponent('posts', 'flag_as_inapropriate_show', 'post_id=' + postId + '&badge_id=' + badgeId, function(data) {
      jQuery('#modal-report').html(data);
    }, function() {
      showModal('modal-report');
      jQuery('#modal-report').html(strLoading);
    });
  }
}

function addBadge(postId, badgeId, loggedIn, obj, badgeType)
{

  if (badgeType != 4) {
    ajaxRenderComponent('posts', 'add_badge', 'post_id=' + postId + '&badge_id=' + badgeId + '&logged_in=' + loggedIn, function(data) {
      var data = jQuery.parseJSON(data);

      if (data.status == 'success') {
        jQuery('.postBadge div', obj).removeClass('ajax');
        jQuery('.postBadge div', obj).css('background-image', 'url(' + data.badge1 + ')');
        jQuery('.postContent', obj).css('border-color', data.badge2);
      } else {
        jAlert(data.content, strBadges)
      }
    }, function() {
      jQuery('.postBadge div', obj).addClass('ajax');
    });
  } else {
    ajaxRenderComponent('posts', 'flag_as_inapropriate_show', 'post_id=' + postId + '&badge_id=' + badgeId, function(data) {
      jQuery('#modal-report').html(data);
    }, function() {
      showModal('modal-report');
      jQuery('#modal-report').html(strLoading);
    });
  }
}

function redrawRightIndexSupportBox(postId)
{
  ajaxRenderComponent('posts', 'post_right_index_support', 'post_id=' + postId, function(data) {
    jQuery('#index').html(data);
  });
}


/*
 * Tooltip script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */



this.tooltip = function() {
  /* CONFIG */
  xOffset = -15;
  yOffset = -60;
  // these 2 variable determine popup's distance from the cursor
  // you might want to adjust to get the right result		
  /* END CONFIG */
  $("a.tooltip").hover(function(e) {
    this.t = this.title;
    this.title = "";
    $("body").append("<p id='tooltip'>" + this.t + "</p>");
    $("#tooltip")
            .css("top", (e.pageY - xOffset) + "px")
            .css("left", (e.pageX + yOffset) + "px")
            .fadeIn("fast");
  },
          function() {
            this.title = this.t;
            $("#tooltip").remove();
          });
  $("a.tooltip").mousemove(function(e) {
    $("#tooltip")
            .css("top", (e.pageY - xOffset) + "px")
            .css("left", (e.pageX + yOffset) + "px");
  });
};


function deletePartie()
{
  jConfirm(strRemovePartyQuestion, strRemoveParty,
          function(back) {
            if (back) {
              ajaxRenderComponent('parties', 'delete_partie', '', function(data) {
                var obj = jQuery.parseJSON(data);
                jAlert(obj.content, strRemoveParty, function() {
                  window.location.href = '/';
                });
              },
                      function() {
                      });
            }
          });
}

function deletePost(postId)
{
  jConfirm(strRemovePostQuestion, strRemovePost,
          function(back) {
            if (back) {
              ajaxRenderComponent('posts', 'delete_post', 'post_id=' + postId, function(data) {
                var obj = jQuery.parseJSON(data);
                jAlert(obj.content, strRemovePost, function() {
                  window.location.href = '/'
                });
              },
                      function() {

                      });
            }
          });
}

function deleteUser()
{
  jConfirm(strRemoveAccountQuestion, strRemoveAccount,
          function(back) {
            if (back) {
              ajaxRenderComponent('user', 'delete_user', '', function(data) {
                var obj = jQuery.parseJSON(data);
                jAlert(obj.content, strRemoveAccount, function() {
                  window.location.href = '/logout';
                });
              },
                      function() {
                      });
            }
          });
}

// starting the script on page load
$(document).ready(function() {
  tooltip();
});

jQuery(window).bind('load', function() {
  fixDescriptionWrap();
});

// Header user menu
jQuery('#user').live('mouseover', function() {
  jQuery('.userOption').show();
})
jQuery('#user').live('mouseout', function() {
  jQuery('.userOption').hide();
})
jQuery('.userOption').live('mouseover', function() {
  jQuery('.userOption').show();
})
jQuery('.userOption').live('mouseout', function() {
  jQuery('.userOption').hide();
})