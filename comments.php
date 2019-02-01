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
			<span class="mdui-typo-caption mdui-text-color-theme-accent mdui-hidden-sm-up"><?php $comments->date(); ?></span>
			<?php convertSmilies($comments->content); ?>
			<div class="mdui-chip">
				<?php if ($comments->authorId == $comments->ownerId){ ?>
				<span class="mdui-chip-icon mdui-color-theme-accent" ><i class="mdui-icon material-icons">account_circle</i></span>
				<div class="mdui-chip-title">博主</div>
				<?php } else { ?>
				<span class="mdui-chip-icon" ><i class="mdui-icon material-icons">remove_red_eye</i></span>
				<div class="mdui-chip-title">访客</div>
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
						<img class="mdui-chip-icon" src="https://cdn.v2ex.com/gravatar/<?php echo HashTheMail($this->user->mail) ?>?s=100&r=&d=mystery" />
						<span class="mdui-chip-title"><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a></span>
					</div>
					<a href="<?php $this->options->logoutUrl(); ?>" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip="{content: '退出登录', position: 'top'}"><i class="mdui-icon material-icons">exit_to_app</i></a>
			<?php else: ?>
			<div class="mdui-card">
				<div class="mdui-card-content mdui-row">
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon" style="width:32px;height:32px;"><img src="https://cdn.v2ex.com/gravatar/?s=100&r=&d=mystery" id="ajax-avatar" style="border-radius:100%;" /></i>
						<div class="mdui-spinner" id="ajax-loading" style="display:none;position:absolute;left:16px;"></div>
						<input type="text" name="author" id="author" class="text mdui-textfield-input" placeholder="名称" value="<?php $this->remember('author'); ?>" required />
						<div class="mdui-textfield-error">名称不能为空</div>
					</div>
					<div class="mdui-textfield mdui-col-xs-12 mdui-col-sm-4">
						<i class="mdui-icon material-icons">email</i>
						<input type="email" name="mail" id="mail" class="text mdui-textfield-input" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
						<input type="hidden" name="receiveMail" id="receiveMail" value="yes" />
						<!-- CommentToMail插件，如果没有该插件可以无视上面这句话 -->
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
						<textarea name="text" id="commenttextarea" class="textarea mdui-textfield-input" placeholder="Dalao们快来评论啊QAQ" required <?php if ($this->options->commenttextlimit) echo 'maxlength="'.$this->options->commenttextlimit.'"';?>><?php $this->remember('text'); ?></textarea>
						<div class="mdui-textfield-error">评论不能为空</div>
						<div class="mdui-textfield-helper">资瓷Markdown和LaTex数学公式</div>
					</div>
					<?php if ($this->options->commentpicture == 'true'){ ?>
					<div class="mdui-text-color-theme-accent mdui-btn mdui-btn-icon mdui-float-left" mdui-tooltip="{content: '使用表情',position: 'top'}" mdui-dialog="{target: '#QAQ'}"><i class="mdui-icon material-icons">sentiment_very_satisfied</i></div>
					<div class="mdui-dialog" id="QAQ">
						<div class="mdui-tab mdui-tab-full-width" id="QAQTab">
							<a href="#ywz" class="mdui-ripple">QwQ</a>
							<a href="#tieba" class="mdui-ripple">贴吧</a>
							<a href="#orz" class="mdui-ripple">Orz</a>
						</div>
						<div class="mdui-dialog-content">
							<div id="ywz">
								<a href="javascript:Smilies.grin('QwQ');" mdui-tooltip="{content: 'QwQ', position: 'top'}" mdui-dialog-close><span class="mdui-btn">QwQ</span></a>
								<a href="javascript:Smilies.grin('|´・w・)ノ');" mdui-tooltip="{content: 'Hi', position: 'top'}" mdui-dialog-close><span class="mdui-btn">|´・w・)ノ</span></a>
								<a href="javascript:Smilies.grin('ヾ(≧∇≦*)ゝ');" mdui-tooltip="{content: '开心', position: 'top'}" mdui-dialog-close><span class="mdui-btn">ヾ(≧∇≦*)ゝ</span></a>
								<a href="javascript:Smilies.grin('(☆w☆)');" mdui-tooltip="{content: '星星眼', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(☆w☆)</span></a>
								<a href="javascript:Smilies.grin('（╯‵□′）╯︵┴─┴');" mdui-tooltip="{content: '掀桌', position: 'top'}" mdui-dialog-close><span class="mdui-btn">（╯‵□′）╯︵┴─┴</span></a>
								<a href="javascript:Smilies.grin('┬─┬ ノ( ' - 'ノ)');" mdui-tooltip="{content: '放好桌子', position: 'top'}" mdui-dialog-close><span class="mdui-btn">┬─┬ ノ( ' - 'ノ)</span></a>
								<a href="javascript:Smilies.grin('￣﹃￣');" mdui-tooltip="{content: '流口水', position: 'top'}" mdui-dialog-close><span class="mdui-btn">￣﹃￣</span></a>
								<a href="javascript:Smilies.grin('(/w＼)');" mdui-tooltip="{content: '捂脸', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(/w＼)</span></a>
								<a href="javascript:Smilies.grin('୧(๑•̀⌄•́๑)૭');" mdui-tooltip="{content: '加油', position: 'top'}" mdui-dialog-close><span class="mdui-btn">୧(๑•̀⌄•́๑)૭</span></a>
								<a href="javascript:Smilies.grin('⌇●﹏●⌇');" mdui-tooltip="{content: '吓死宝宝惹', position: 'top'}" mdui-dialog-close><span class="mdui-btn">⌇●﹏●⌇</span></a>
								<a href="javascript:Smilies.grin('(ฅ´w`ฅ)');" mdui-tooltip="{content: '已阅留爪', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(ฅ´w`ฅ)</span></a>
								<a href="javascript:Smilies.grin('(╯°A°)╯︵○○○');" mdui-tooltip="{content: '去吧大师球', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(╯°A°)╯︵○○○</span></a>
								<a href="javascript:Smilies.grin('φ(￣∇￣o)');" mdui-tooltip="{content: '太萌惹', position: 'top'}" mdui-dialog-close><span class="mdui-btn">φ(￣∇￣o)</span></a>
								<a href="javascript:Smilies.grin('(ó﹏ò｡)');" mdui-tooltip="{content: '我受到了惊吓', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(ó﹏ò｡)</span></a>
								<a href="javascript:Smilies.grin('Σ(っ °Д °;)っ');" mdui-tooltip="{content: '什么鬼', position: 'top'}" mdui-dialog-close><span class="mdui-btn">Σ(っ °Д °;)っ</span></a>
								<a href="javascript:Smilies.grin('(｡•ˇ‸ˇ•｡)');" mdui-tooltip="{content: '哼', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(｡•ˇ‸ˇ•｡)</span></a>
								<a href="javascript:Smilies.grin('(⊙０⊙)');" mdui-tooltip="{content: '目瞪狗呆', position: 'top'}" mdui-dialog-close><span class="mdui-btn">(⊙０⊙)</span></a>
							</div>
							<div class="QAQPicture" id="tieba">
								<a href="javascript:Smilies.grin(':tieba9:');" mdui-tooltip="{content: '滑天下之大稽', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/9.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba26:');" mdui-tooltip="{content: '我的滑稽会冒汗', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/26.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba1:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/1.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba2:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/2.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba3:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/3.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba4:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/4.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba5:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/5.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba6:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/6.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba7:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/7.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba8:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/8.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba10:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/10.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba11:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/11.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba12:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/12.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba13:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/13.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba14:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/14.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba15:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/15.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba16:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/16.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba17:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/17.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba18:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/18.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba19:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/19.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba20:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/20.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba21:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/21.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba22:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/22.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba23:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/23.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba24:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/24.png" /></div></a>
								<a href="javascript:Smilies.grin(':tieba25:');" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/tieba/25.png" /></div></a>

							</div>
							<div class="QAQPicture" id="orz">
								<a href="javascript:Smilies.grin(':orz1:');" mdui-tooltip="{content: '啥？', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/1.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz2:');" mdui-tooltip="{content: '恐惧', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/2.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz3:');" mdui-tooltip="{content: '倍感压力', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/3.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz4:');" mdui-tooltip="{content: 'WHAT???', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/4.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz11:');" mdui-tooltip="{content: '无奈.jpg', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/11.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz16:');" mdui-tooltip="{content: '快吃药', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/16.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz5:');" mdui-tooltip="{content: '生无可恋.jpg', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/5.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz6:');" mdui-tooltip="{content: 'Orz', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/6.gif" /></div></a>
								<a href="javascript:Smilies.grin(':orz14:');" mdui-tooltip="{content: '没有', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/14.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz10:');" mdui-tooltip="{content: '向大佬低头', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/10.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz7:');" mdui-tooltip="{content: '递茶', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/7.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz12:');" mdui-tooltip="{content: '奥妙重重', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/12.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz8:');" mdui-tooltip="{content: '惊恐无比', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/8.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz9:');" mdui-tooltip="{content: '或许这就是大佬', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/9.png" /></div></a>
								<a href="javascript:Smilies.grin(':orz13:');" mdui-tooltip="{content: '以头抢桌尔', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/13.gif" /></div></a>
								<a href="javascript:Smilies.grin(':orz15:');" mdui-tooltip="{content: '一脸懵逼', position: 'top'}" mdui-dialog-close><div class="mdui-btn"><img src="<?php Typecho_Widget::widget('Widget_Options')->themeUrl() ?>img/QAQ/Orz/15.png" /></div></a>
							</div>
							<!-- 如果需要自己编写，图片栏要加上class="QAQPicture"否则显示会GG -->
						</div>
						<div class="mdui-dialog-actions"><div class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-dialog-close>关闭表情</div></div>
					</div>
					<?php } ?>
					<button type="submit" class="submit mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right" mdui-tooltip="{content: '提交评论', position: 'top'}"><i class="mdui-icon material-icons">check</i></button>
					<div class="cancel-comment-reply mdui-float-right" style="display:inline">
						<?php $comments->cancelReply('<button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" mdui-tooltip=\'{content: "取消回复", position: "top"}\'><i class="mdui-icon material-icons">close</i></button>'); ?>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php $comments->listComments(); ?>
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

<style>
	div#comments ol.comment-list {padding:0!important;}
	span.comment-reply a:hover:before,span.comment-reply a:focus:before {display:none!important;}
	div.cancel-comment-reply a:hover:before,div.cancel-comment-reply a:focus:before {display:none!important;}
	#QAQ {height:75%!important;}
	#QAQ .mdui-dialog-content {height:calc(100% - 100px)!important;}
	#QAQ a {color:unset!important;}
	#QAQ a:hover:before,#QAQ a:focus:before {display:none!important;}
	#QAQ .mdui-dialog-content .QAQPicture .mdui-btn {min-width:unset;padding:5px;height:unset;margin-bottom:-13px;}
	div.page-navigator {list-style:none;}
	div.page-navigator li {display:inline-block;padding:0 20px;}
	div.page-navigator li.current a {color:black!important;}
</style>

<script>
	var QAQTab = new mdui.Tab('#QAQTab');
	mdui.JQ('#QAQ').on('open.mdui.dialog', function () { QAQTab.handleUpdate(); });
</script>
<script>
	document.getElementById('ajax-loading').style.display="inline-block";
	document.getElementById('ajax-avatar').style.display="none";
	var _email = $("input#mail").val();
	$.ajax({
		type: 'GET',
		data: {action: 'ajax_avatar_get',form: '<?php $this->permalink() ?>',email: _email},
		success: function(data) {$('#ajax-avatar').attr('src', data);}
	});
	setTimeout(function(){
		document.getElementById('ajax-loading').style.display="none";
		document.getElementById('ajax-avatar').style.display="inline";
	},750);
	$("input#mail").blur(function() {
		document.getElementById('ajax-loading').style.display="inline-block";
		document.getElementById('ajax-avatar').style.display="none";
		var _email = $(this).val();
		$.ajax({
			type: 'GET',
			data: {action: 'ajax_avatar_get',form: '<?php $this->permalink() ?>',email: _email},
			success: function(data) {$('#ajax-avatar').attr('src', data);}
		});
		setTimeout(function(){
			document.getElementById('ajax-loading').style.display="none";
			document.getElementById('ajax-avatar').style.display="inline";
		},750);
		return false;
	});
</script>
<script>
	Smilies = {
		dom : function(id) {
			return document.getElementById(id);
		},
		grin : function (tag) {
			tag = ' ' + tag + ' '; myField = this.dom('commenttextarea');
			document.selection ? (myField.focus(), sel = document.selection.createRange(), sel.text = tag, myField.focus()) : this.insertTag(tag);
		},
		insertTag : function (tag) {
			myField = Smilies.dom('commenttextarea');
			myField.selectionStart || myField.selectionStart == '0' ? (
				startPos = myField.selectionStart,endPos = myField.selectionEnd,cursorPos = startPos,
				myField.value = myField.value.substring(0, startPos) + tag + myField.value.substring(endPos, myField.value.length),
				cursorPos += tag.length,myField.focus(),myField.selectionStart = cursorPos,myField.selectionEnd = cursorPos
			) : (
				myField.value += tag,myField.focus()
			);
		}
	}
</script>