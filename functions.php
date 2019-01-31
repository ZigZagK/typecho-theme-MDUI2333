<?php
function themeFields($layout) {
	$picUrl = new Typecho_Widget_Helper_Form_Element_Text('picUrl', NULL, NULL, _t('图片地址'), _t('在这里填入一个图片 URL 地址, 作为文章的头图，如果不填则显示随机图片'));
	$layout->addItem($picUrl);
}
function themeConfig($form) {
	echo '<center><h2>这里是MDUI2333主题的一些设置QwQ</h2></center>';
	echo '<center><h3>网站标题等基本信息需要在控制台中填写</h3></center>';
	$themeprimary = new Typecho_Widget_Helper_Form_Element_Text('themeprimary', NULL, NULL, _t('主题使用的主色'), _t('顶部栏颜色等主题色。填颜色名，参考 <a target="_blank" href="https://www.mdui.org/docs/color#color">MDUI</a> 文档。如果不填则默认使用<code>indigo</code>'));
	$form->addInput($themeprimary);
	$themeaccent = new Typecho_Widget_Helper_Form_Element_Text('themeaccent', NULL, NULL, _t('主题使用的强调色'), _t('链接按钮等配件颜色。填颜色名，参考 <a target="_blank" href="https://www.mdui.org/docs/color#color">MDUI</a> 文档。如果不填则默认使用<code>blue</code>'));
	$form->addInput($themeaccent);
	$logoMail = new Typecho_Widget_Helper_Form_Element_Text('logoMail', NULL, NULL, _t('侧边栏 Logo 使用的邮箱'), _t('如果不填或该邮箱没有绑定头像则显示Gravatar的默认头像mystery'));
	$form->addInput($logoMail);
	$backgroundPic = new Typecho_Widget_Helper_Form_Element_Text('backgroundPic', NULL, NULL, _t('背景图片地址'), _t('如果不填则显示<code>#b3d4fc</code>纯色背景</span>'));
	$form->addInput($backgroundPic);
	$favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('网站小图标地址'), _t('浏览器左上角小图标的图片地址'));
	$form->addInput($favicon);
	$birthday = new Typecho_Widget_Helper_Form_Element_Text('birthday', NULL, NULL, _t('建站时间'), _t('用于显示侧边栏的运行天数，格式为 <code>年.月.日</code> ，例如 <code>2018.7.29</code> ，不填则不显示运行天数'));
	$form->addInput($birthday);
	$copyright = new Typecho_Widget_Helper_Form_Element_Text('copyright', NULL, NULL, _t('版权声明'), _t('每篇文章下方的版权声明，不填则不显示版权声明'));
	$form->addInput($copyright);
	$githublink = new Typecho_Widget_Helper_Form_Element_Text('githublink', NULL, NULL, _t('github链接'), _t('用于网站左下角的链接，不填则不显示github链接'));
	$form->addInput($githublink);
	$bilibililink = new Typecho_Widget_Helper_Form_Element_Text('bilibililink', NULL, NULL, _t('bilibili链接'), _t('用于网站左下角的链接，不填则不显示bilibili链接'));
	$form->addInput($bilibililink);
	$zhihulink = new Typecho_Widget_Helper_Form_Element_Text('zhihulink', NULL, NULL, _t('知乎链接'), _t('用于网站左下角的链接，不填则不显示知乎链接'));
	$form->addInput($zhihulink);
	$AplayerCode = new Typecho_Widget_Helper_Form_Element_Text('AplayerCode', NULL, NULL, _t('全站音乐播放器APlayer代码'), _t('参考 <a target="_blank" href="https://i-meto.com/ghost-aplayer/">Meting</a> 文档填写，若不加<code>data-fixed="true"</code>参数则显示在最下方，若不想在切换页面时停止播放请加上<code>no-destroy</code>的<code>class</code>。如果不填则不启用APlayer。'));
	$form->addInput($AplayerCode);
	$highlightstyle = new Typecho_Widget_Helper_Form_Element_Text('highlightstyle', NULL, NULL, _t('代码片渲染样式'), _t('参考 <a target="_blank" href="https://highlightjs.org/static/demo/">highlightjs</a> 样式，如果不填则使用<code>default</code>'));
	$form->addInput($highlightstyle);
	$commenttextlimit = new Typecho_Widget_Helper_Form_Element_Text('commenttextlimit', NULL, NULL, _t('评论字数限制'), _t('这里可以限制评论的最大字数，不填则没有限制'));
	$form->addInput($commenttextlimit);
	$commentpicture = new Typecho_Widget_Helper_Form_Element_Select('commentpicture',array(
		'true' => '启用',
		'false' => '不启用'
	),'true',_t('评论表情'),_t(''));
	$form->addInput($commentpicture->multiMode());
}
function themeInit($archive) {
	Helper::options()->commentsAntiSpam = false; //反垃圾和PJAX撞了，我又搞不来，我也很绝望啊
	if(isset($_GET['action']) == 'ajax_avatar_get' && 'GET' == $_SERVER['REQUEST_METHOD'] ) {
		$host = 'https://cdn.v2ex.com/gravatar/';
		$email = strtolower( $_GET['email']);$hash = md5($email);
		$sjtx = 'mystery';$avatar = $host . $hash . '?d='.$sjtx;
		echo $avatar;die();
	} else { return; }
}
function getPostViews($widget, $format = "{views}") {
	$fields = unserialize($widget->fields);
	if (array_key_exists('views', $fields))
		$views = (!empty($fields['views'])) ? intval($fields['views']) : 0;
	else
		$views = 0;
	if ($widget->is('single')) {
		$vieweds = Typecho_Cookie::get('contents_viewed');
		if (empty($vieweds))
			$vieweds = array();
		else
			$vieweds = explode(',', $vieweds);
		if (!in_array($widget->cid, $vieweds)) {
			$views = $views + 1;
			$widget->setField('views', 'int', $views, $widget->cid);
			$vieweds[] = $widget->cid;
			$vieweds = implode(',', $vieweds);
			Typecho_Cookie::set("contents_viewed",$vieweds);
		}
	}
	return str_replace("{views}", $views, $format);
}
function HashtheMail($mail) {$mailHash = NULL;if (!empty($mail)) $mailHash = md5(strtolower($mail));return $mailHash;}
function comment_gravatar($comment, $size = 32, $default = NULL) {
	$mailHash = HashtheMail($comment->mail);
	$url = 'https://cdn.v2ex.com/gravatar/';if (!empty($comment->mail)) $url .= $mailHash;
	$url .= '?s=' . $size;$url .= '&r=' . $rating;$url .= '&d=' . $default;
	echo '<img class="avatar mdui-chip-icon" src="' . $url . '" alt="' . $comment->author . '" width="' . $size . '" height="' . $size . '" />';
}
function comment_author($comment) {
	if ($comment->url) echo '<a target="_blank" href="' , $comment->url , '"' , ($noFollow ? ' rel="external nofollow"' : NULL) , '>' , $comment->author , '</a>'; else echo $comment->author;
}
function post_gravatar($user, $size = 40, $default = NULL, $class = NULL) {
	$mailHash = HashtheMail($user->mail);
	$url = 'https://cdn.v2ex.com/gravatar/';if (!empty($user->mail)) $url .= $mailHash;
	$url .= '?s=' . $size;$url .= '&r=' . $rating;$url .= '&d=' . $default;
	echo '<img class="avatar mdui-chip-icon" src="' . $url . '" alt="' . $user->screenName . '" width="' . $size . '" height="' . $size . '" />';
}
function ShowThumbnail($widget) {
	$fields = unserialize($widget->fields);if ($fields['picUrl']) {echo $fields['picUrl'];return;}
	$rand = rand(1,19);$random = Helper::options()->themeUrl . '/img/random/material-' . $rand . '.png';echo $random;
}
function CountCateOrTag($id){
	$db = Typecho_Db::get();$po=$db->select('table.metas.count')->from ('table.metas')->where ('parent = ?', $id)->orWhere('mid = ? ', $id);
	$pom = $db->fetchAll($po);$num = count($pom);$shu = 0;for ($x=0; $x<$num; $x++) $shu=$pom[$x]['count']+$shu;return $shu;
}
function convertSmilies($widget){
	$smiliesTrans = array(
		':tieba1:'=>'tieba/1.png',
		':tieba2:'=>'tieba/2.png',
		':tieba3:'=>'tieba/3.png',
		':tieba4:'=>'tieba/4.png',
		':tieba5:'=>'tieba/5.png',
		':tieba6:'=>'tieba/6.png',
		':tieba7:'=>'tieba/7.png',
		':tieba8:'=>'tieba/8.png',
		':tieba9:'=>'tieba/9.png',
		':tieba10:'=>'tieba/10.png',
		':tieba11:'=>'tieba/11.png',
		':tieba12:'=>'tieba/12.png',
		':tieba13:'=>'tieba/13.png',
		':tieba14:'=>'tieba/14.png',
		':tieba15:'=>'tieba/15.png',
		':tieba16:'=>'tieba/16.png',
		':tieba17:'=>'tieba/17.png',
		':tieba18:'=>'tieba/18.png',
		':tieba19:'=>'tieba/19.png',
		':tieba20:'=>'tieba/20.png',
		':tieba21:'=>'tieba/21.png',
		':tieba22:'=>'tieba/22.png',
		':tieba23:'=>'tieba/23.png',
		':tieba24:'=>'tieba/24.png',
		':tieba25:'=>'tieba/25.png',
		':tieba26:'=>'tieba/26.png',
		':orz1:'=>'Orz/1.png',
		':orz2:'=>'Orz/2.png',
		':orz3:'=>'Orz/3.png',
		':orz4:'=>'Orz/4.png',
		':orz5:'=>'Orz/5.png',
		':orz6:'=>'Orz/6.gif',
		':orz7:'=>'Orz/7.png',
		':orz8:'=>'Orz/8.png',
		':orz9:'=>'Orz/9.png',
		':orz10:'=>'Orz/10.png',
		':orz11:'=>'Orz/11.png',
		':orz12:'=>'Orz/12.png',
		':orz13:'=>'Orz/13.gif',
		':orz14:'=>'Orz/14.png',
		':orz15:'=>'Orz/15.png',
		':orz16:'=>'Orz/16.png',
	);
	$imgUrl = Typecho_Widget::widget('Widget_Options')->themeUrl . '/img/QAQ/';
	foreach($smiliesTrans as $smiley => $img) {
		$smiliesTag[] = $smiley;
		$smiliesReplace[] = "<img src=\"$imgUrl$img\" alt=\"\" class=\"smiley\" />";
	}   
	$output = '';
	$textArr = preg_split("/(<.*>)/U", $widget, -1, PREG_SPLIT_DELIM_CAPTURE);
	$stop = count($textArr);
	for ($i = 0; $i < $stop; $i++) {
		$content = $textArr[$i];
		if ((strlen($content) > 0) && ('<' != $content{0})) {
			$content = str_replace($smiliesTag, $smiliesReplace, $content);
		}
		$output .= $content;
	}
	echo $output;
}