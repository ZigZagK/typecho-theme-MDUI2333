<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php function threadedComments($comments, $options) {
	$commentClass = '';
	if ($comments->authorId) {
		if ($comments->authorId == $comments->ownerId) {
			$commentClass .= ' comment-by-author';
		} else {
			$commentClass .= ' comment-by-user';
		}
	}
	$commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
?>

<div id="<?php $comments->theId(); ?>" class="mdui-panel comment-body<?php 
if ($comments->levels > 0) {
	echo ' comment-child';
	$comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
	echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass;
?>" mdui-panel>
	<?php if ($comments->levels==0) { ?>
	<div class="mdui-panel-item mdui-panel-item-open">
		<div class="mdui-panel-item-header">
			<div class="mdui-panel-item-title">
				<div class="comment-author mdui-chip mdui-hidden-xs-down">
					<?php comment_gravatar($comments,100,'mystery'); ?>
					<span class="fn mdui-chip-title"><?php comment_author($comments); ?></span>
				</div>
				<div class="mdui-hidden-sm-up"><?php comment_gravatar($comments,100,'mystery'); ?></div>
			</div>
			<div class="mdui-panel-item-summary"><span class="mdui-hidden-xs-down"><?php $comments->date(); ?></span><span class="fn mdui-chip-title mdui-hidden-sm-up"><?php comment_author($comments); ?></span></div>
			<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
		</div>
		<div class="comment-meta mdui-panel-item-body">
			<span class="mdui-typo-caption mdui-text-color-theme-accent mdui-hidden-sm-up"><?php $comments->date(); ?><br></span>
			<?php echo RewriteComment($comments); ?>
			<div class="mdui-chip">
				<?php if ($comments->authorId == $comments->ownerId){ ?>
				<span class="mdui-chip-icon mdui-color-theme-accent" ><i class="mdui-icon material-icons">account_circle</i></span><span class="mdui-chip-title">博主</span>
				<?php } else { ?>
				<span class="mdui-chip-icon" ><i class="mdui-icon material-icons">remove_red_eye</i></span><span class="mdui-chip-title">访客</span>
				<?php } ?>
			</div>
			<span class="comment-reply mdui-float-right"><?php $comments->reply('<button class="mdui-btn mdui-color-theme-accent mdui-ripple">回复</button>'); ?></span>
			<?php if ($comments->children) { ?>
				<div class="comment-children">
					<?php $comments->threadedComments($options); ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<?php } else { ?>
	<div class="mdui-panel-item mdui-panel-item-open">
		<div class="mdui-panel-item-header">
			<div class="mdui-panel-item-title">
				<div class="comment-author mdui-chip mdui-hidden-xs-down">
					<?php comment_gravatar($comments,100,'mystery'); ?>
					<span class="fn mdui-chip-title"><?php comment_author($comments); ?></span>
				</div>
				<div class="mdui-hidden-sm-up"><?php comment_gravatar($comments,100,'mystery'); ?></div>
			</div>
			<div class="mdui-panel-item-summary"><span class="mdui-hidden-xs-down"><?php $comments->date(); ?></span><span class="fn mdui-chip-title mdui-hidden-sm-up"><?php comment_author($comments); ?></span></div>
			<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
		</div>
		<div class="comment-meta mdui-panel-item-body">
			<span class="mdui-typo-caption mdui-text-color-theme-accent mdui-hidden-sm-up"><?php $comments->date(); ?><br></span>
			<?php echo RewriteComment($comments); ?>
			<div class="mdui-chip">
				<?php if ($comments->authorId == $comments->ownerId){ ?>
				<span class="mdui-chip-icon mdui-color-theme-accent" ><i class="mdui-icon material-icons">account_circle</i></span><div class="mdui-chip-title">博主</div>
				<?php } else { ?>
				<span class="mdui-chip-icon" ><i class="mdui-icon material-icons">remove_red_eye</i></span><div class="mdui-chip-title">访客</div>
				<?php } ?>
			</div>
			<span class="comment-reply mdui-float-right"><?php $comments->reply('<button class="mdui-btn mdui-color-theme-accent mdui-ripple">回复</button>'); ?></span>
		</div>
	</div>
		<?php if ($comments->children) { ?>
	<div class="comment-children">
		<?php $comments->threadedComments($options); ?>
	</div>
		<?php } ?>
	<?php } ?>
</div>
<?php } ?>

<div class="mdui-typo" id="comments" style="padding-left:2%;padding-right:2%;">
	<?php $this->comments()->to($comments); ?>
	<?php if($this->allow('comment')): ?>
	<div id="<?php $this->respondId(); ?>" class="respond mdui-m-t-4">
		<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
			<?php if($this->user->hasLogin()): ?>
			<div class="mdui-card">
				<div class="mdui-card-content mdui-row">
					<div class="mdui-chip">
						<img class="mdui-chip-icon mdui-color-grey-200" src="https://cdn.v2ex.com/gravatar/<?php echo HashTheMail($this->user->mail) ?>?s=100&r=&d=mystery" />
						<span class="mdui-chip-title"><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a></span>
					</div>
					<a href="<?php $this->options->logoutUrl(); ?>" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip="{content: '退出登录', position: 'top'}" no-pjax><i class="mdui-icon material-icons">exit_to_app</i></a>
			<?php else: ?>
			<div class="mdui-card">
				<div class="mdui-card-content mdui-row">
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon" style="width:32px;height:32px;"><img src="https://cdn.v2ex.com/gravatar/?s=100&r=&d=mystery" id="emailavatar" style="border-radius:100%;" /></i>
						<div class="mdui-spinner" id="avatarloading" style="display:none;position:absolute;left:16px;"></div>
						<input type="text" name="author" id="author" class="text mdui-textfield-input" placeholder="名称" value="<?php $this->remember('author'); ?>" required />
						<div class="mdui-textfield-error">名称不能为空</div>
					</div>
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon material-icons">email</i>
						<input type="email" name="mail" id="mail" class="text mdui-textfield-input" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
						<?php $all = Typecho_Plugin::export(); ?>
						<?php if (array_key_exists('CommentToMail', $all['activated'])){ ?>
						<input type="hidden" name="receiveMail" id="receiveMail" value="yes" />
						<!-- CommentToMail插件 -->
						<?php } ?>
						<div class="mdui-textfield-error">邮箱不能为空，请填写正确格式</div>
					</div>
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon material-icons">link</i>
						<input type="url" name="url" id="url" class="text mdui-textfield-input" placeholder="博客网址" value="<?php $this->remember('url');?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
						<div class="mdui-textfield-error">网址请用http://或https://开头</div>
					</div>
			<?php endif; ?>
					<div class="mdui-textfield mdui-col-xs-12">
						<i class="mdui-icon material-icons">message</i>
						<textarea name="text" id="commenttextarea" class="textarea mdui-textfield-input" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('commentsumbit').click();return false};" placeholder="Dalao们快来评论啊QAQ" required <?php if ($this->options->commenttextlimit) echo 'maxlength="'.$this->options->commenttextlimit.'"';?>><?php $this->remember('text'); ?></textarea>
						<div class="mdui-textfield-error">评论不能为空</div>
						<div class="mdui-textfield-helper">资瓷Markdown和LaTeX数学公式</div>
					</div>
					<?php if ($this->options->commentpicture == 'true'){ ?>
						<?php $this->need('php/QAQTAB.php'); ?>
					<?php } ?>
					<button id="commentsumbit" type="submit" class="submit mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" mdui-tooltip="{content: '提交评论(Ctrl+Enter)', position: 'top'}"><i class="mdui-icon material-icons">check</i></button>
					<div class="mdui-spinner mdui-spinner-colorful mdui-float-right" id="commenting" style="margin:0 8px;width:36px;height:36px;display:none;"></div>
					<div class="cancel-comment-reply mdui-float-right" style="display:inline">
						<?php $comments->cancelReply('<button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip=\'{content: "取消回复", position: "top"}\'><i class="mdui-icon material-icons">close</i></button>'); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div id="allcomment">
	<?php $comments->listComments(); ?>
	</div>
	<?php if ($comments->have()): ?>
	<?php $comments->pageNav('前一页','后一页',1,'...',array('wrapTag' => 'div','wrapClass' => 'page-navigator mdui-card mdui-p-a-1 mdui-m-y-2 mdui-text-center')); ?>
	<?php endif; ?>
	<?php else: ?>
	<center>
		<div class="mdui-chip mdui-m-t-1">
			<span class="mdui-chip-icon"><i class="mdui-icon material-icons">comment</i></span>
			<span class="mdui-chip-title">评论已关闭>_<</span>
		</div>
	</center>
	<?php endif; ?>
</div>

<?php $this->need('js/commentjs.php'); ?>