<?php
/**
 * 日记页面
 *
 * @package custom
 */
$this->need('header.php'); ?>
<?php function threadedComments($comments, $options) { ?>
<div class="mdui-col">
	<div class="mdui-card mdui-m-t-2">
		<div class="mdui-card-header">
			<img class="mdui-card-header-avatar" src="https://cdn.v2ex.com/gravatar/<?php echo HashTheMail($comments->mail) ?>?s=100&r=&d=mystery" />
			<div class="mdui-card-header-title"><?php echo $comments->author; ?></div>
			<div class="mdui-card-header-subtitle"><?php $comments->date(); ?></div>
		</div>
		<div class="mdui-card-content" style="min-height:200px"><?php echo RewriteComment($comments); ?></div>
	</div>
</div>
<?php } ?>

<div class="mdui-container mdui-m-b-2">
	<?php $this->comments()->to($comments); ?>
	<div class="mdui-typo" id="comments">
		<?php $this->comments()->to($comments); ?>
		<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4">
			<?php if ($this->user->hasLogin()){ ?>
			<div class="mdui-col">
				<div class="mdui-card mdui-m-t-2">
					<div class="mdui-card-header">
						<i class="mdui-card-header-avatar mdui-text-color-theme-accent mdui-icon material-icons" style="font-size:35px">edit</i>
						<div class="mdui-card-header-title">发表日记</div>
						<div class="mdui-card-header-subtitle">在下方输入日记内容</div>
						<a href="<?php $this->options->adminUrl(); ?>manage-comments.php?cid=<?php echo $this->cid; ?>" target="_blank" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-color-theme-accent mdui-float-right mdui-ripple" style="position:absolute;right:16px;top:16px" mdui-tooltip="{content: '管理日记', position: 'top'}"><i class="mdui-icon material-icons">archive</i></a>
					</div>
					<div class="mdui-card-content" style="min-height:200px">
						<?php if($this->allow('comment')): ?>
						<div id="<?php $this->respondId(); ?>" class="respond">
							<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
								<div class="mdui-textfield" style="padding-top:0">
									<i class="mdui-icon material-icons">message</i>
									<textarea name="text" id="commenttextarea" class="textarea mdui-textfield-input" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('commentsumbit').click();return false};" placeholder="在这里写下你想说的QwQ" required><?php $this->remember('text'); ?></textarea>
									<div class="mdui-textfield-error">内容不能为空</div>
									<div class="mdui-textfield-helper">资瓷Markdown和LaTeX数学公式</div>
								</div>
								<div class="actions mdui-p-b-2">
									<?php if ($this->options->commentpicture == 'true'){ ?><?php $this->need('php/QAQTAB.php'); ?><?php } ?>
									<button id="commentsumbit" type="submit" class="submit mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" mdui-tooltip="{content: '发布(Ctrl+Enter)', position: 'top'}"><i class="mdui-icon material-icons">check</i></button>
								</div>
							</form>
						</div>
						<?php else: ?>
						<p>未开启评论QAQ！请在控制台中开启此页面的评论。</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php $comments->listComments(array('before'=>'')); ?>
		</div>
	</div>
</div>
<script>
	var QAQTab=new mdui.Tab('#QAQTab');
	mdui.JQ('#QAQ').on('open.mdui.dialog',function(){QAQTab.handleUpdate();});
	Smilies={
		dom: function(id) {return document.getElementById(id);},
		grin: function(tag){
			tag=' '+tag+' ';myField=this.dom('commenttextarea');
			document.selection?(myField.focus(),sel=document.selection.createRange(),sel.text=tag,myField.focus()):this.insertTag(tag);
		},
		insertTag: function(tag){
			myField=Smilies.dom('commenttextarea');
			myField.selectionStart || myField.selectionStart=='0'?(
				startPos=myField.selectionStart,endPos=myField.selectionEnd,cursorPos=startPos,
				myField.value=myField.value.substring(0,startPos)+tag+myField.value.substring(endPos,myField.value.length),
				cursorPos+=tag.length,myField.focus(),myField.selectionStart=cursorPos,myField.selectionEnd=cursorPos
			):(myField.value+=tag,myField.focus());
		}
	}
</script>

<?php include('sidebar.php'); ?>
<?php include('footer.php'); ?>