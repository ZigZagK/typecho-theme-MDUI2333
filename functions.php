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
	$birthday = new Typecho_Widget_Helper_Form_Element_Text('birthday', NULL, NULL, _t('建站时间'), _t('用于显示侧边栏的运行天数，格式为 <code>年-月-日</code> ，例如 <code>2018-7-29</code> ，不填则不显示运行天数'));
	$form->addInput($birthday);
	$copyright = new Typecho_Widget_Helper_Form_Element_Text('copyright', NULL, NULL, _t('版权声明'), _t('每篇文章下方的版权声明，不填则不显示版权声明'));
	$form->addInput($copyright);
	$githublink = new Typecho_Widget_Helper_Form_Element_Text('githublink', NULL, NULL, _t('github链接'), _t('用于网站左下角的链接，不填则不显示github链接'));
	$form->addInput($githublink);
	$bilibililink = new Typecho_Widget_Helper_Form_Element_Text('bilibililink', NULL, NULL, _t('bilibili链接'), _t('用于网站左下角的链接，不填则不显示bilibili链接'));
	$form->addInput($bilibililink);
	$zhihulink = new Typecho_Widget_Helper_Form_Element_Text('zhihulink', NULL, NULL, _t('知乎链接'), _t('用于网站左下角的链接，不填则不显示知乎链接'));
	$form->addInput($zhihulink);
	$filing = new Typecho_Widget_Helper_Form_Element_Text('filing', NULL, NULL, _t('备案信息'), _t('用于显示网站备案信息，不填则不显示备案信息'));
	$form->addInput($filing);
	$gafiling = new Typecho_Widget_Helper_Form_Element_Text('gafiling', NULL, NULL, _t('公安备案信息'), _t('用于显示网站公安备案信息，不填则不显示公安备案信息'));
	$form->addInput($gafiling);
	$AplayerCode = new Typecho_Widget_Helper_Form_Element_Text('AplayerCode', NULL, NULL, _t('全站音乐播放器APlayer代码'), _t('ps:需要下载METO大佬的 <a target="_blank" href="https://github.com/MoePlayer/APlayer-Typecho">Meting</a> 插件。格式参考 <a target="_blank" href="https://github.com/metowolf/MetingJS">Meting</a> 文档填写，若不加<code>data-fixed="true"</code>参数则显示在最下方，若不想在切换页面时停止播放请参考 <a target="_blank" href="https://github.com/MoePlayer/APlayer-Typecho/pull/60">这里</a> 。如果不填则不启用APlayer'));
	$form->addInput($AplayerCode);
	$highlightstyle = new Typecho_Widget_Helper_Form_Element_Text('highlightstyle', NULL, NULL, _t('代码片渲染样式'), _t('参考 <a target="_blank" href="https://highlightjs.org/static/demo/">highlightjs</a> 样式，如果不填则使用<code>default</code>'));
	$form->addInput($highlightstyle);
	$tagcloudmode = new Typecho_Widget_Helper_Form_Element_Select('tagcloudmode',array(
		'ball' => '侧边栏球形标签云',
		'page' => '独立页面文字标签云'
	),'ball',_t('标签云模式'),_t('ps:独立页面文字标签云需要手动创建页面，将页面模板改为标签云页面'));
	$form->addInput($tagcloudmode->multiMode());
	$posttoc = new Typecho_Widget_Helper_Form_Element_Select('posttoc',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('文章目录'),_t(''));
	$form->addInput($posttoc->multiMode());
	$ExSearch = new Typecho_Widget_Helper_Form_Element_Select('ExSearch',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('实时搜索'),_t('ps:需要下载AlanDecode大佬的 <a target="_blank" href="https://github.com/AlanDecode/Typecho-Plugin-ExSearch">ExSearch</a> 插件'));
	$form->addInput($ExSearch->multiMode());
	$commenttextlimit = new Typecho_Widget_Helper_Form_Element_Text('commenttextlimit', NULL, NULL, _t('评论字数限制'), _t('这里可以限制评论的最大字数，不填则没有限制'));
	$form->addInput($commenttextlimit);
	$commentchinese = new Typecho_Widget_Helper_Form_Element_Select('commentchinese',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('非中文评论过滤'),_t('开启后评论中必须含有至少一个汉字'));
	$form->addInput($commentchinese->multiMode());
	$commentpicture = new Typecho_Widget_Helper_Form_Element_Select('commentpicture',array(
		'true' => '启用',
		'false' => '不启用'
	),'true',_t('评论表情'),_t(''));
	$form->addInput($commentpicture->multiMode());
	$upyuncdn = new Typecho_Widget_Helper_Form_Element_Select('upyuncdn',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('又拍云图标'),_t('在网站右下角显示又拍云图标'));
	$form->addInput($upyuncdn->multiMode());
	$baidustatistics = new Typecho_Widget_Helper_Form_Element_Textarea('baidustatistics', NULL, NULL, _t('百度统计代码'), _t('在此填入百度统计提供的代码，如果不知道这是啥可以无视QAQ'));
	$form->addInput($baidustatistics);
}
function themeInit($archive) {
	Helper::options()->commentsMaxNestingLevels = 19260817; //评论"无限"层
	if ($archive->is('single') && $archive->request->isPost() && $archive->request->is('themeAction=comment')) ajaxComment($archive); //AJAX评论
}
function ThemeName(){
	$db=Typecho_Db::get();$query=$db->select('value')->from('table.options')->where('name = ?', 'theme');
	$result=$db->fetchAll($query);return $result[0]["value"];
}
function HashtheMail($mail) {$mailHash = NULL;if (!empty($mail)) $mailHash = md5(strtolower($mail));return $mailHash;}
function comment_gravatar($comment,$size,$default){
	$mailHash=HashtheMail($comment->mail);
	$url='https://cdn.v2ex.com/gravatar/';if (!empty($comment->mail)) $url.=$mailHash;
	$url.='?s='.$size;$url.='&r='.$rating;$url.='&d='.$default;
	echo '<img class="avatar mdui-chip-icon mdui-color-grey-200" src="'.$url.'" alt="'.$comment->author.'" width="'.$size.'" height="'.$size.'" />';
}
function comment_author($comment){
	if ($comment->url) echo '<a target="_blank" href="',$comment->url,'"',($noFollow?' rel="external nofollow"' : NULL),'>',$comment->author,'</a>'; else echo $comment->author;
}
function post_gravatar($user,$size,$default){
	$mailHash=HashtheMail($user->mail);
	$url='https://cdn.v2ex.com/gravatar/';if (!empty($user->mail)) $url.=$mailHash;
	$url.='?s='.$size;$url.='&r='.$rating;$url.='&d='.$default;
	echo '<img class="avatar mdui-chip-icon mdui-color-grey-200" src="'.$url.'" alt="'.$user->screenName.'" width="'.$size.'" height="'.$size.'" />';
}
function ShowThumbnail($widget){
	$fields=unserialize($widget->fields);if ($fields['picUrl']) {echo $fields['picUrl'];return;}
	$rand=rand(1,19);$random=Helper::options()->themeUrl.'/img/random/material-'.$rand.'.png';echo $random;
}
function CountCateOrTag($id){
	$db=Typecho_Db::get();$po=$db->select('table.metas.count')->from('table.metas')->where('parent = ?',$id)->orWhere('mid = ? ',$id);
	$pom=$db->fetchAll($po);$num=count($pom);$shu=0;for ($x=0;$x<$num;$x++) $shu=$pom[$x]['count']+$shu;return $shu;
}
function convertSmilies($widget){
	if (get_headers(Typecho_Widget::widget('Widget_Options')->themeUrl."/img/QAQ/QAQ.json",1)[0]=='HTTP/1.1 200 OK')
		$getJson=file_get_contents(Typecho_Widget::widget('Widget_Options')->themeUrl."/img/QAQ/QAQ.json");
		else $getJson=file_get_contents(Helper::options()->themeFile(ThemeName(),"img/QAQ/QAQ.json"));
	$QAQTAB = json_decode($getJson,true);$TABName = array_keys($QAQTAB);$length = count($TABName);
	for ($i=0;$i<$length;$i++){
		$key=$TABName[$i];$tot=count($QAQTAB[$key]['content']);
		if ($QAQTAB[$key]['type']=='picture')
			for ($j=0;$j<$tot;$j++) $smiliesTrans[':'.$key.$QAQTAB[$key]['content'][$j]['id'].':']='/'.$key.'/'.$QAQTAB[$key]['content'][$j]['path'];
	}
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
	return $output;
}
function GetCommentAt($coid){
	$db=Typecho_Db::get();$fa=$db->fetchRow($db->select('coid,author')->from('table.comments')->where('coid = ?',$coid));
	$content='<strong class="haveat"><a href="#comment-'.$fa['coid'].'">@'.$fa['author'].'&nbsp;</a></strong>';
	return $content;
}
function RewriteComment($comment){
	$content=convertSmilies($comment->content);
	if ($comment->parent) $content=GetCommentAt($comment->parent).$content;
	return $content;
}
function AddMDUITable($content){
	return preg_replace('/<\/table>/s','</table></div>',preg_replace('/<table>/s','<div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable">',$content));
}
function AddFancybox($content){
	return preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/s','<a data-fancybox="gallery" href="${2}" data-caption="${4}" class="Fancybox"><img${1}src="${2}"${3}alt="${4}"${5}></a>',$content);
}
function RewriteContent($content){
	return AddMDUITable(AddFancybox($content));
}
function ajaxComment($archive){
	$options = Helper::options();
	$user = Typecho_Widget::widget('Widget_User');
	$db = Typecho_Db::get();
	/** 评论关闭 */
	if(!$archive->allow('comment')){
		$archive->response->throwJson(array('status'=>0,'msg'=>_t('评论已关闭')));
	}
	/** 检查ip评论间隔 */
	if (!$user->pass('editor', true) && $archive->authorId != $user->uid &&
	$options->commentsPostIntervalEnable){
		$latestComment = $db->fetchRow($db->select('created')->from('table.comments')
					->where('cid = ?', $archive->cid)
					->where('ip = ?', $archive->request->getIp())
					->order('created', Typecho_Db::SORT_DESC)
					->limit(1));
		if ($latestComment && ($options->gmtTime - $latestComment['created'] > 0 &&
		$options->gmtTime - $latestComment['created'] < $options->commentsPostInterval)) {
			$archive->response->throwJson(array('status'=>0,'msg'=>_t('对不起, 您的发言过于频繁, 请稍侯再次发布')));
		}		
	}
	$comment = array(
		'cid'	   =>  $archive->cid,
		'created'   =>  $options->gmtTime,
		'agent'	 =>  $archive->request->getAgent(),
		'ip'		=>  $archive->request->getIp(),
		'ownerId'   =>  $archive->author->uid,
		'type'	  =>  'comment',
		'status'	=>  !$archive->allow('edit') && $options->commentsRequireModeration ? 'waiting' : 'approved'
	);
	/** 判断父节点 */
	if ($parentId = $archive->request->filter('int')->get('parent')) {
		if ($options->commentsThreaded && ($parent = $db->fetchRow($db->select('coid', 'cid')->from('table.comments')
		->where('coid = ?', $parentId))) && $archive->cid == $parent['cid']) {
			$comment['parent'] = $parentId;
		} else {
			$archive->response->throwJson(array('status'=>0,'msg'=>_t('父级评论不存在')));
		}
	}
	$feedback = Typecho_Widget::widget('Widget_Feedback');
	//检验格式
	$validator = new Typecho_Validate();
	$validator->addRule('author', 'required', _t('必须填写用户名'));
	$validator->addRule('author', 'xssCheck', _t('请不要在用户名中使用特殊字符'));
	$validator->addRule('author', array($feedback, 'requireUserLogin'), _t('您所使用的用户名已经被注册,请登录后再次提交'));
	$validator->addRule('author', 'maxLength', _t('用户名最多包含200个字符'), 200);
	if ($options->commentsRequireMail && !$user->hasLogin()) {
		$validator->addRule('mail', 'required', _t('必须填写电子邮箱地址'));
	}
	$validator->addRule('mail', 'email', _t('邮箱地址不合法'));
	$validator->addRule('mail', 'maxLength', _t('电子邮箱最多包含200个字符'), 200);
	if ($options->commentsRequireUrl && !$user->hasLogin()) {
		$validator->addRule('url', 'required', _t('必须填写个人主页'));
	}
	$validator->addRule('url', 'url', _t('个人主页地址格式错误'));
	$validator->addRule('url', 'maxLength', _t('个人主页地址最多包含200个字符'), 200);
	$validator->addRule('text', 'required', _t('必须填写评论内容'));
	$comment['text'] = $archive->request->text;
	/** 对一般匿名访问者,将用户数据保存一个月 */
	if (!$user->hasLogin()) {
		/** Anti-XSS */
		$comment['author'] = $archive->request->filter('trim')->author;
		$comment['mail'] = $archive->request->filter('trim')->mail;
		$comment['url'] = $archive->request->filter('trim')->url;
		/** 修正用户提交的url */
		if (!empty($comment['url'])) {
			$urlParams = parse_url($comment['url']);
			if (!isset($urlParams['scheme'])) {
				$comment['url'] = 'http://' . $comment['url'];
			}
		}
		$expire = $options->gmtTime + $options->timezone + 30*24*3600;
		Typecho_Cookie::set('__typecho_remember_author', $comment['author'], $expire);
		Typecho_Cookie::set('__typecho_remember_mail', $comment['mail'], $expire);
		Typecho_Cookie::set('__typecho_remember_url', $comment['url'], $expire);
	} else {
		$comment['author'] = $user->screenName;
		$comment['mail'] = $user->mail;
		$comment['url'] = $user->url;
		/** 记录登录用户的id */
		$comment['authorId'] = $user->uid;
	}
	/** 评论者之前须有评论通过了审核 */
	if (!$options->commentsRequireModeration && $options->commentsWhitelist) {
		if ($feedback->size($feedback->select()->where('author = ? AND mail = ? AND status = ?', $comment['author'], $comment['mail'], 'approved'))) {
			$comment['status'] = 'approved';
		} else {
			$comment['status'] = 'waiting';
		}
	}
	if ($error = $validator->run($comment)) {
		$archive->response->throwJson(array('status'=>0,'msg'=> implode(';',$error)));
	}
	if ($options->commentchinese=='true' && preg_match("/[\x{4e00}-\x{9fa5}]/u", $comment['text']) == 0) {
		$archive->response->throwJson(array('status'=>0,'msg'=>_t('评论内容请不少于一个中文汉字')));
	}
	/** 添加评论 */
	$commentId = $feedback->insert($comment);
	if(!$commentId){
		$archive->response->throwJson(array('status'=>0,'msg'=>_t('评论失败')));
	}
	Typecho_Cookie::delete('__typecho_remember_text');
	$db->fetchRow($feedback->select()->where('coid = ?', $commentId)
	->limit(1), array($feedback, 'push'));
	// 邮件通知插件接口
	$feedback->pluginHandle()->finishComment($feedback);
	// 返回评论数据
	$data = array(
		'cid' => $feedback->cid,
		'coid' => $feedback->coid,
		'parent' => $feedback->parent,
		'mail' => $feedback->mail,
		'url' => $feedback->url,
		'ip' => $feedback->ip,
		'agent' => $feedback->agent,
		'author' => $feedback->author,
		'authorId' => $feedback->authorId,
		'permalink' => $feedback->permalink,
		'created' => $feedback->created,
		'datetime' => $feedback->date->format($options->commentDateFormat),
		'status' => $feedback->status,
	);
	// 评论内容
	ob_start();
	$feedback->content();
	$data['content'] = convertSmilies(ob_get_clean());
	if ($data['parent']) $data['content'] = GetCommentAt($data['parent']) . $data['content'];
	$data['text'] = $comment['text'];
	// 身份标识
	if ($data['authorId']==$comment['ownerId']) $data['ifauthor'] = '<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">account_circle</i></span><div class="mdui-chip-title">博主</div>';
	else $data['ifauthor'] = '<span class="mdui-chip-icon"><i class="mdui-icon material-icons">remove_red_eye</i></span><div class="mdui-chip-title">访客</div>';
	// 网址链接
	if ($data['url']) $data['authorurl']='<a target="_blank" href="'.$data['url'].'">'.$data['author'].'</a>';
	else $data['authorurl']=$data['author'];
	// gravatar头像
	$data['avatar'] = 'https://cdn.v2ex.com/gravatar/'.HashTheMail($data['mail']).'?s=100&r=&d=mystery';
	$archive->response->throwJson(array('status'=>1,'comment'=>$data));
}