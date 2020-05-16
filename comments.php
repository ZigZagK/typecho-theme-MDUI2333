<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$plugin=Typecho_Plugin::export();
function threadedComments($comment,$options){ ?>
<div class="mdui-panel" id="<?php $comment->theId(); ?>" mdui-panel>
	<div class="mdui-panel-item mdui-panel-item-open">
		<div class="mdui-panel-item-header">
			<div class="mdui-panel-item-title">
				<div class="mdui-chip mdui-hidden-xs-down">
				<img class="mdui-chip-icon mdui-color-grey-200" src="<?php echo GravatarURL($comment->mail,100); ?>" />
					<span class="mdui-chip-title"><?php comment_author($comment); ?></span>
				</div>
				<img class="mdui-chip-icon mdui-color-grey-200 mdui-hidden-sm-up" src="<?php echo GravatarURL($comment->mail,100); ?>" />
			</div>
			<div class="mdui-panel-item-summary"><span class="mdui-hidden-xs-down"><?php $comment->date(); ?></span><span class="mdui-chip-title mdui-hidden-sm-up"><?php comment_author($comment); ?></span></div>
			<i class="mdui-panel-item-arrow mdui-icon material-icons">&#xe313;</i>
		</div>
		<div class="mdui-panel-item-body">
			<span class="mdui-typo-caption mdui-text-color-theme-accent mdui-hidden-sm-up"><?php $comment->date(); ?><br></span>
			<?php if ($comment->status=='waiting') { ?><small><strong class="mdui-text-color-theme-accent"><?php echo $options->commentStatus; ?></strong></small><br><?php } ?>
			<?php echo RewriteComment($comment); ?>
			<div class="mdui-chip">
				<?php if ($comment->authorId==$comment->ownerId){ ?>
				<span class="mdui-chip-icon mdui-color-theme-accent" ><i class="mdui-icon material-icons">&#xe853;</i></span><span class="mdui-chip-title">博主</span>
				<?php } else { ?>
				<span class="mdui-chip-icon" ><i class="mdui-icon material-icons">&#xe417;</i></span><span class="mdui-chip-title">访客</span>
				<?php } ?>
			</div>
			<span class="comment-reply mdui-float-right"><?php $comment->reply('<button class="mdui-btn mdui-color-theme-accent mdui-ripple">回复</button>'); ?></span>
			<?php if ($comment->levels==0){ ?>
				<?php if ($comment->children){ ?>
				<div class="comment-children">
					<?php $comment->threadedComments($options); ?>
				</div>
				<?php } ?>
		</div>
	</div>
			<?php } else { ?>
		</div>
	</div>
	<?php if ($comment->children){ ?>
	<div class="comment-children">
		<?php $comment->threadedComments($options); ?>
	</div>
	<?php } ?>
			<?php } ?>
</div>
<?php } ?>
<div class="mdui-typo" id="comments" style="padding-left:4%;padding-right:4%;font-size:14px;">
	<?php $this->comments()->to($comments); ?>
	<?php if (!$this->allow('comment')){ ?>
	<center class="mdui-m-y-2">
		<div class="mdui-chip">
			<span class="mdui-chip-icon"><i class="mdui-icon material-icons">&#xe92a;</i></span>
			<span class="mdui-chip-title">评论已关闭>_<</span>
		</div>
	</center>
	<?php } else if ($this->hidden){ ?>
	<center class="mdui-m-y-2">
		<div class="mdui-chip">
			<span class="mdui-chip-icon"><i class="mdui-icon material-icons">&#xe92a;</i></span>
			<span class="mdui-chip-title">密码保护无法评论>_<</span>
		</div>
	</center>
	<?php } else { ?>
	<div id="<?php $this->respondId(); ?>" class="mdui-m-y-2">
		<?php if ($this->options->commentrule!=''){ ?>
		<div class="mdui-card mdui-color-theme-accent mdui-m-b-1">
			<div class="mdui-card-content mdui-valign">
				<div class="mdui-m-r-2"><i class="mdui-icon material-icons">&#xe002;</i></div>
				<div><?php echo $this->options->commentrule; ?></div>
			</div>
		</div>
		<?php } ?>
		<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
			<?php if ($this->user->hasLogin()){ ?>
			<div class="mdui-card">
				<div class="mdui-card-content mdui-row">
					<div class="mdui-chip mdui-m-l-1">
						<img class="mdui-chip-icon mdui-color-grey-200" src="<?php echo GravatarURL($this->user->mail,100); ?>" />
						<span class="mdui-chip-title"><a href="<?php $this->options->profileUrl(); ?>" target="_blank"><?php $this->user->screenName(); ?></a></span>
					</div>
					<a href="<?php $this->options->logoutUrl(); ?>" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip="{content:'退出登录', position:'top'}" no-pjax><i class="mdui-icon material-icons">&#xe879;</i></a>
			<?php } else { ?>
			<div class="mdui-card">
				<div class="mdui-card-content mdui-row">
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon" style="width:32px;height:32px;"><img src="<?php echo GravatarURL('',100); ?>" id="emailavatar" style="border-radius:100%;" /></i>
						<input type="text" name="author" class="mdui-textfield-input" placeholder="名称" value="<?php $this->remember('author'); ?>" />
					</div>
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon material-icons">&#xe0be;</i>
						<input type="email" name="mail" id="mail" class="mdui-textfield-input" placeholder="邮箱" value="<?php $this->remember('mail'); ?>" />
						<div class="mdui-textfield-error">邮箱格式错误</div>
					</div>
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon material-icons">&#xe157;</i>
						<input type="url" name="url" id="url" class="mdui-textfield-input" placeholder="博客网址" value="<?php $this->remember('url');?>" />
						<div class="mdui-textfield-error">网址请用http://或https://开头</div>
					</div>
			<?php } ?>
					<div class="mdui-textfield mdui-col-xs-12">
						<i class="mdui-icon material-icons">&#xe0c9;</i>
						<textarea name="text" id="commenttextarea" class="mdui-textfield-input" onkeydown="if (event.ctrlKey&&event.keyCode==13) {document.getElementById('commentsumbit').click();return false};" placeholder="<?php echo htmlspecialchars($this->options->commentplaceholder); ?>" <?php if ($this->options->commenttextlimit) echo 'maxlength="'.$this->options->commenttextlimit.'"';?>><?php $this->remember('text'); ?></textarea>
						<div class="mdui-textfield-helper"><?php echo $this->options->commenthelper; ?></div>
					</div>
					<?php if ($this->options->commentpicture=='true') $this->need('php/QAQTAB.php'); ?>
					<?php if (!$this->user->hasLogin() && array_key_exists('Mailer',$plugin['activated'])){ ?>
					<span class="mdui-float-left mdui-valign" mdui-tooltip="{content:'邮件提醒',position:'top'}">
						<i class="mdui-icon material-icons mdui-text-color-theme-accent mdui-m-r-1" id="receiveMailicon">&#xe7f7;</i>
						<label class="mdui-switch"><input type="checkbox" name="receiveMail" value="yes" checked /><i class="mdui-switch-icon"></i></label>
					</span>
					<?php } ?>
					<button id="commentsumbit" type="submit" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" style="margin:0 8px;" mdui-tooltip="{content:'提交评论(Ctrl+Enter)',position:'top'}"><i class="mdui-icon material-icons">&#xe5ca;</i></button>
					<div class="mdui-spinner mdui-spinner-colorful mdui-float-right" id="commenting" style="margin:0 8px;width:36px;height:36px;display:none;"></div>
					<div class="cancel-comment-reply mdui-float-right mdui-m-l-1 a-no-bottom" style="display:inline">
						<?php $comments->cancelReply('<button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip=\'{content:"取消回复",position:"top"}\'><i class="mdui-icon material-icons">&#xe5cd;</i></button>'); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>
	<div id="commentcontent">
		<?php $comments->listComments(array('before'=>'<div class="comment-list">','after'=>'</div>')); ?>
		<?php if ($comments->have()){ ?>
		<?php $comments->pageNav('<i class="mdui-icon material-icons">&#xe314;</i>','<i class="mdui-icon material-icons">&#xe315;</i>',2,'···',array('wrapTag' => 'div','wrapClass' => 'page-navigator mdui-text-center mdui-m-b-2 a-no-bottom','itemTag' => 'div','currentClass' => 'current')); ?>
		<?php } ?>
	</div>
</div>
<script>
	typechocomment('<?php $this->respondId(); ?>');smoothscroll('.haveat a');QAQTABreload();smiliesreload();
	visitorfunction(<?php echo ($this->user->hasLogin()?'true':'false'); ?>,'<?php echo $this->options->gravatarurl; ?>');
	ajaxcomment({highlightmode:'<?php echo $this->options->highlightmode; ?>',commentsuccess:'<?php echo $this->options->commentsuccess; ?>'});
</script>