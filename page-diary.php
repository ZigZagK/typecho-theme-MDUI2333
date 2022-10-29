<?php
/**
 * 日记页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Helper::options()->commentsPageBreak=false; //评论不分页，获取所有评论
$this->need('header.php');
global $total;global $diary;$total=0;
function threadedComments($comment,$options){
	$GLOBALS['diary'][$GLOBALS['total']][0]=$comment->date;
	$GLOBALS['diary'][$GLOBALS['total']][1]='
	<div class="mdui-col">
		<div id="'.$comment->theId.'" class="mdui-card mdui-m-t-2">
			<div class="mdui-card-header">
				<img class="mdui-card-header-avatar" src="'.GravatarURL($comment->mail,100).'" />
				<div class="mdui-card-header-title">'.$comment->author.'</div>
				<div class="mdui-card-header-subtitle">'.$comment->date->format(Helper::options()->commentDateFormat).'</div>
			</div>
			<div class="mdui-card-content dairy-content">'.RewriteComment($comment).'</div>
		</div>
	</div>';
	$GLOBALS['total']++;
}
?>
<div class="mdui-container mdui-m-b-2">
	<?php $this->comments()->to($comments); ?>
	<?php $comments->listComments(array('before'=>'','after'=>'')); ?>
	<div class="mdui-tab mdui-color-theme" mdui-tab>
	<?php
	$last='19260817';
	for ($i=0;$i<$total;$i++){
		if ($diary[$i][0]->format('Y-n')!=$last) echo '<a href="#'.$diary[$i][0]->format('Y-n').'" class="mdui-ripple">'.$diary[$i][0]->format('Y.n').'</a>';
		$last=$diary[$i][0]->format('Y-n');
	}
	?>
	</div>
	<?php if ($this->user->hasLogin()){ ?>
	<div class="mdui-typo mdui-card mdui-m-t-2">
		<div class="mdui-card-header">
			<i class="mdui-card-header-avatar mdui-text-color-theme-accent mdui-icon material-icons" style="font-size:35px">&#xe3c9;</i>
			<div class="mdui-card-header-title">发表日记</div>
			<div class="mdui-card-header-subtitle">在下方输入日记内容</div>
			<a href="<?php $this->options->adminUrl(); ?>manage-comments.php?cid=<?php echo $this->cid; ?>" target="_blank" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-color-theme-accent mdui-float-right mdui-ripple" style="position:absolute;right:16px;top:16px" mdui-tooltip="{content:'管理日记',position:'top'}"><i class="mdui-icon material-icons">&#xe149;</i></a>
		</div>
		<div class="mdui-card-content mdui-row">
			<?php if ($this->allow('comment')){ ?>
			<div id="<?php $this->respondId(); ?>">
				<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" style="margin:0px;" role="form">
					<div class="mdui-textfield mdui-col-xs-12" style="padding-top:0">
						<i class="mdui-icon material-icons">&#xe0c9;</i>
						<textarea name="text" id="commenttextarea" class="textarea mdui-textfield-input" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('commentsumbit').click();return false};" placeholder="在这里写下你想说的QwQ"><?php $this->remember('text'); ?></textarea>
						<div class="mdui-textfield-helper"><?php echo $this->options->commenthelper; ?></div>
					</div>
					<?php if ($this->options->commentpicture=='true') $this->need('php/QAQTAB.php'); ?>
					<button id="commentsumbit" type="submit" class="submit mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" style="margin:0 8px;" mdui-tooltip="{content:'发表(Ctrl+Enter)',position:'top'}"><i class="mdui-icon material-icons">&#xe5ca;</i></button>
				</form>
			</div>
			<?php } else { ?>
			<p>未开启评论QAQ！请在控制台中开启此页面的评论。</p>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	<?php
	$last='19260817';
	for ($i=0;$i<$total;$i++){
		if ($diary[$i][0]->format('Y-n')!=$last){
			if ($last!='19260817') echo '
			</div>
		</div>
			';
			echo '
		<div class="mdui-typo" id="'.$diary[$i][0]->format('Y-n').'">
			<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4 mdui-row-xl-4">
			';
		}
		echo $diary[$i][1];
		$last=$diary[$i][0]->format('Y-n');
	}
	if ($last!='19260817') echo '
		</div>
	</div>';
	?>
</div>
<script>
	var QAQTab=new mdui.Tab('#QAQTab');
	$('#QAQ').on('open.mdui.dialog',function(){QAQTab.handleUpdate();});
	Smilies={
		dom:function(id) {return document.getElementById(id);},
		grin:function(tag){
			tag=' '+tag+' ';myField=this.dom('commenttextarea');
			document.selection?(myField.focus(),sel=document.selection.createRange(),sel.text=tag,myField.focus()):this.insertTag(tag);
		},
		insertTag:function(tag){
			myField=Smilies.dom('commenttextarea');
			myField.selectionStart || myField.selectionStart=='0'?(
				startPos=myField.selectionStart,endPos=myField.selectionEnd,cursorPos=startPos,
				myField.value=myField.value.substring(0,startPos)+tag+myField.value.substring(endPos,myField.value.length),
				cursorPos+=tag.length,myField.focus(),myField.selectionStart=cursorPos,myField.selectionEnd=cursorPos
			):(myField.value+=tag,myField.focus());
		}
	}
</script>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>