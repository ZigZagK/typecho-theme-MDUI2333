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
function getAllDiaryMonth($page){
	$db=Typecho_Db::get();
	$comments=$db->fetchAll($db->select()
		->from('table.comments')
		->where('cid = ?',$page->cid)
		->order('created',Typecho_Db::SORT_DESC)
	);
	$monthTimeList=[];
	$last=NULL;
	foreach ($comments as $comment){
		$time=$comment['created']??0;
		$monthStr=date('Y-n',$time);
		if ($monthStr!=$last) {$monthTimeList[]=$time;$last=$monthStr;}
	}
	return $monthTimeList;
}
function getDiaryUrl($post,$year,$month){
	return $post->permalink.'?'.http_build_query(array('type'=>'diary','y'=>$year,'m'=>$month,'auth'=>md5($year.Helper::options()->apisalt.$month)));
}
?>
<div class="mdui-container mdui-m-b-2">
	<?php $this->comments()->to($comments); ?>
	<?php $comments->listComments(array('before'=>'','after'=>'')); ?>
	<div class="mdui-tab mdui-color-theme" mdui-tab>
	<?php $monthTimeList=getAllDiaryMonth($this); ?>
	<?php
	foreach($monthTimeList as $time)
		echo '<a href="#'.date('Y-n',$time).'" id="tab-'.date('Y-n',$time).'"class="mdui-ripple">'.date('Y.n',$time).'</a>';
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
	foreach($monthTimeList as $time)
		echo '
		<div class="mdui-typo" id="'.date('Y-n',$time).'">
			<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4 mdui-row-xl-4" id="diaryContent-'.date('Y-n',$time).'">
			</div>
		</div>';
	?>
</div>
<script>
	QAQTABreload();smiliesreload();
	var diaryCacheDict={};
	function loadDiaryContent(url,contentIdStr){
		if (diaryCacheDict[contentIdStr]==true) return;
		$.ajax({
			url:url,
			type:"GET",
			success:function(data){
				diaryCacheDict[contentIdStr]=true;
				$("[id='"+contentIdStr+"']").html(data);
				mathjaxreload(contentIdStr);codelinenumber('#'+contentIdStr);
				highlightreload('#'+contentIdStr);mdui.mutation();
			}
		});
	}
	<?php
	if ($monthTimeList[0]??NULL){
		$year=(int)date('Y',$monthTimeList[0]);$month=(int)date('n',$monthTimeList[0]);
		$diaryId='diaryContent-'.$year.'-'.$month;
		echo 'loadDiaryContent("'.getDiaryUrl($this,$year,$month).'","'.$diaryId.'");';
	}
	?>
	<?php
	foreach($monthTimeList as $time){
		$year=(int)date('Y',$time);$month=(int)date('n',$time);
		$tabId='tab-'.$year.'-'.$month;$diaryId='diaryContent-'.$year.'-'.$month;
		echo '$("[id=\''.$tabId.'\']").on("click",function(){loadDiaryContent("'.getDiaryUrl($this,$year,$month).'","'.$diaryId.'");});';
	}
	?>
</script>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>