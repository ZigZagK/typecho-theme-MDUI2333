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
	<div class="mdui-panel-item mdui-panel-item-open">
		<div class="mdui-panel-item-header">
			<div class="mdui-panel-item-title">
				<div class="comment-author mdui-chip">
					<?php comment_gravatar($comments,100,'identicon'); ?>
					<span class="fn mdui-chip-title"><?php comment_author($comments); ?></span>
				</div>
			</div>
			<div class="mdui-panel-item-summary"><?php $comments->date(); ?></div>
			<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
		</div>
		<div class="comment-meta mdui-panel-item-body">
			<?php $comments->content(); ?>
			<span class="comment-reply"><?php $comments->reply('<button class="mdui-btn mdui-color-theme-accent mdui-ripple">回复</button>'); ?></span>
			<?php if ($comments->children) { ?>
			<div class="comment-children">
				<?php $comments->threadedComments($options); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<div class="mdui-typo mdui-p-x-3" id="comments">
	<?php $this->comments()->to($comments); ?>
	<?php if($this->allow('comment')): ?>
	<div id="<?php $this->respondId(); ?>" class="respond mdui-m-t-4">
		<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
			<?php if($this->user->hasLogin()): ?>
			<table class="mdui-table mdui-m-b-0">
				<tbody>
					<tr>
						<td>
							<?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a>
						</td>
					</tr>
				</tbody>
			</table>
			<?php else: ?>
			<table class="mdui-table mdui-m-b-0">
				<tbody>
					<tr>
						<td>
							<div class="mdui-textfield">
								<input type="text" name="author" id="author" class="text mdui-textfield-input" placeholder="名称" value="<?php $this->remember('author'); ?>" required />
								<div class="mdui-textfield-error">名称不能为空</div>
							</div>
						</td>
						<td>
							<div class="mdui-textfield">
								<input type="email" name="mail" id="mail" class="text mdui-textfield-input" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
								<div class="mdui-textfield-error">邮箱不能为空，请填写正确格式</div>
							</div>
						</td>
						<td>
							<div class="mdui-textfield">
								<input type="url" name="url" id="textarea" class="textarea mdui-textfield-input" placeholder="博客网址" value="<?php $this->remember('url');?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> /><?php $this->remember('text'); ?>
								<div class="mdui-textfield-error">网址请用http://或https://开头</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<?php endif; ?>
			<table class="mdui-table">
				<tbody>
					<tr>
						<td>
							<div class="mdui-textfield">
								<textarea name="text" id="textarea" class="textarea mdui-textfield-input" placeholder="Dalao们快来评论啊QAQ" required <?php if ($this->options->commenttextlimit) echo 'maxlength="'.$this->options->commenttextlimit.'"';?>><?php $this->remember('text'); ?></textarea>
								<div class="mdui-textfield-error">评论不能为空</div>
								<div class="mdui-textfield-helper">资瓷Markdown和LaTex数学公式</div>
							</div>
						</td>
						<td width=156>
							<button type="submit" class="submit mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" mdui-tooltip="{content: '提交评论', position: 'top'}"><i class="mdui-icon material-icons">check</i></button>
							<div class="cancel-comment-reply" style="display:inline">
								<?php $comments->cancelReply('<button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip=\'{content: "取消回复", position: "top"}\'><i class="mdui-icon material-icons">close</i></button>'); ?>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
	<?php $comments->listComments(); ?>
	<?php if ($comments->have()): ?>
	<?php $comments->pageNav('前一页','后一页',1,'...',array('wrapTag' => 'div','wrapClass' => 'page-navigator mdui-card mdui-p-a-1 mdui-m-y-2 mdui-text-center')); ?>
	<?php endif; ?>
	<?php else: ?>
	<div class="mdui-typo">
		<h4 class="mdui-text-center mdui-text-color-theme"><?php _e('评论已关闭>_<'); ?> <small>可以去留言板留言QwQ</small></h4>
	</div>
	<?php endif; ?>
</div>

<style>
	div#comments ol.comment-list {padding:0!important;}
	span.comment-reply a:hover:before,span.comment-reply a:focus:before {display:none!important;}
	div.cancel-comment-reply a:hover:before,div.cancel-comment-reply a:focus:before {display:none!important;}
	div.page-navigator {list-style:none;}
	div.page-navigator li {display:inline-block;padding:0 20px;}
	div.page-navigator li.current a {color:black!important;}
</style>