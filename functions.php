<?php
define('Version','1.4.5');
function themeFields($layout){
	$field=new Typecho_Widget_Helper_Form_Element_Text('picUrl',NULL,NULL,_t('头图地址'),_t('在这里填入一个图片 URL 地址，作为文章/页面的头图，不填则显示随机图片'));
	$layout->addItem($field);
	$field=new Typecho_Widget_Helper_Form_Element_Text('description',NULL,NULL,_t('文章描述/页面图标'),_t('文章描述：显示在首页等页面中文章的描述，不填则自动截取文章开头作为描述<br>页面图标：显示在侧边栏的页面的图标，参照<a href="https://www.mdui.org/docs/material_icon" target="_blank">Material图标填写</a>，比如<code>link</code>或者<code>&amp;#xe157;</code>'));
	$layout->addItem($field);
}
function themeConfig($form){
	echo '<link rel="stylesheet" href="'.Helper::options()->themeUrl.'/css/settingbackup.min.css">';
	echo '<script src="'.Helper::options()->themeUrl.'/js/jquery.min.js"></script>';
	echo '<script src="'.Helper::options()->themeUrl.'/js/mdui.min.js"></script>';
	echo '<script src="'.Helper::options()->themeUrl.'/js/settingbackup.min.js"></script>';
	echo '<div id="info"><center>您现在的版本是<strong>'.Version.'</strong>，最新的版本是<strong><a target="_blank" href="https://github.com/ZigZagK/typecho-theme-MDUI2333/releases"><span id="infolatest"> Loading... </span></a></strong></center>';
	echo '<center><span id="infotext"> Loading... </span></center>';
	echo '<center><button id="settingbackup" class="btn primary">备份外观设置</button><button id="restorebackup" class="btn primary">恢复备份数据</button></center></div>';
	echo '<center><h2>这里是MDUI2333主题的一些设置QwQ</h2></center>';
	echo '<center><h3>网站标题等基本信息需要在控制台中填写</h3></center>';
	$backupapi=Helper::options()->siteUrl."?".http_build_query(array('type'=>'settingbackup','opt'=>'backup','salt'=>Helper::options()->apisalt));
	$restoreapi=Helper::options()->siteUrl."?".http_build_query(array('type'=>'settingbackup','opt'=>'restore','salt'=>Helper::options()->apisalt));
	echo "<script>checkupdate('".Version."');$('#settingbackup').click(function(){settingbackup('".$backupapi."');});$('#restorebackup').click(function(){restorebackup('".$restoreapi."');});</script>";
	$config=new Typecho_Widget_Helper_Form_Element_Text('themeprimary',NULL,NULL,_t('主题使用的主色'),_t('顶部栏颜色等主题色。填颜色名，参考 <a target="_blank" href="https://www.mdui.org/docs/color#color">MDUI</a> 文档。如果不填则默认使用<code>indigo</code>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('themeaccent',NULL,NULL,_t('主题使用的强调色'),_t('链接按钮等配件颜色。填颜色名，参考 <a target="_blank" href="https://www.mdui.org/docs/color#color">MDUI</a> 文档。如果不填则默认使用<code>blue</code>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('logourl',NULL,NULL,_t('侧边栏 Logo 图片地址'),_t('如果不填则显示Gravatar的默认头像mystery'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('backgroundPic',NULL,NULL,_t('背景图片地址'),_t('如果不填则显示<code>#b3d4fc</code>纯色背景</span>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('birthday',NULL,NULL,_t('建站时间'),_t('用于显示侧边栏的运行天数，格式为 <code>年-月-日</code> ，例如 <code>2018-7-29</code>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('copyright',NULL,NULL,_t('版权声明'),_t('每篇文章下方的版权声明'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('githublink',NULL,NULL,_t('github链接'),_t('用于网站左下角的github链接'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('bilibililink',NULL,NULL,_t('bilibili链接'),_t('用于网站左下角的bilibili链接'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('zhihulink',NULL,NULL,_t('知乎链接'),_t('用于网站左下角的知乎链接'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('filing',NULL,NULL,_t('备案信息'),_t('用于显示网站备案信息'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('gafiling',NULL,NULL,_t('公安备案信息'),_t('用于显示网站公安备案信息'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('announcement',NULL,NULL,_t('网站公告'),_t('在访客进入网站时显示的公告'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('announcementpos',array(
		'top' => '正上方',
		'bottom' => '正下方',
		'left-top' => '左上方',
		'left-bottom' => '左下方',
		'right-top' => '右上方',
		'right-bottom' => '右下方'
	),'right-bottom',_t('网站公告显示位置'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('pjaxloading',NULL,'正在努力加载中QAQ',_t('PJAX加载提示语'),_t('在切换页面时显示的提示语'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('gravatarurl',array(
		'https://gravatar.loli.net/avatar/' => 'loli源',
		'https://cdn.v2ex.com/gravatar/' => 'V2EX源',
		'https://www.gravatar.com/avatar/' => 'Gravatar www源',
		'https://secure.gravatar.com/avatar/' => 'Gravatar secure源',
		'https://cn.gravatar.com/avatar/' => 'Gravatar cn源'
	),'https://gravatar.loli.net/avatar/',_t('Gravatar头像源'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Select('twemoji',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('Twemoji'),_t('在博客中使用<a href="https://github.com/mozilla/twemoji-colr" target="_blank">Twemoji</a>来替代系统默认的emoji'));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Select('highlightmode',array(
		'highlightjs' => 'highlightjs',
		'prismjs' => 'Prismjs'
	),'prismjs',_t('代码片渲染方案'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('highlightstyle',NULL,NULL,_t('代码片渲染样式'),_t('如果采用 <a href="https://highlightjs.org/static/demo/" target="_blank">highlightjs</a> ：参考 <a target="_blank" href="https://www.jsdelivr.com/package/npm/highlight.js?path=styles">highlightjs</a> 样式，如<code>tomorrow.css</code>则填写<code>tomorrow</code>，如果不填则使用<code>default</code><br>如果采用 <a href="https://prismjs.com/download.html" target="_blank">Prismjs</a> ：参考 <a href="https://www.jsdelivr.com/package/npm/prismjs?path=themes" target="_blank">Prism</a> 中的theme填写，如<code>prism-coy.css</code>则填写<code>prism-coy</code>，如果不填则使用<code>prism</code>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('ExSearch',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('实时搜索'),_t('需要下载AlanDecode大佬的 <a target="_blank" href="https://github.com/AlanDecode/Typecho-Plugin-ExSearch">ExSearch</a> 插件'));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Select('posttoc',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('文章目录'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('posttimeouttext',NULL,NULL,_t('文章时效提醒'),_t('文章超过一定天数没有更新后将会显示的提示文本，不填则不开启'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('posttimeout',NULL,NULL,_t('文章时效天数'),_t('显示文章时效提醒的最低天数，不填则默认180天'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('AplayerCode',NULL,NULL,_t('全站音乐播放器APlayer代码'),_t('需要下载METO大佬的 <a target="_blank" href="https://github.com/MoePlayer/APlayer-Typecho">Meting</a> 插件。若APlayer不为吸底模式则显示在页面最下方，更多问题详见 <a target="_blank" href="https://github.com/ZigZagK/typecho-theme-MDUI2333/wiki/Meting%E6%8F%92%E4%BB%B6%E5%85%A8%E7%AB%99APlayer">MDUI2333Wiki</a>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('linksmode',array(
		'default' => '默认顺序',
		'rand' => '随机顺序'
	),'default',_t('友链显示顺序'),_t('默认顺序即友情链接管理中的顺序，请注意 <a target="_blank" href="https://github.com/ZigZagK/typecho-links-material">Links插件</a> 需要使用MDUI2333的配套魔改版'));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('bangumicachetimeout',NULL,NULL,_t('追番数据缓存时间(秒)'),_t('填0表示不缓存<strong>(不推荐)</strong>，不填则默认半天(43200)'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('commentplaceholder',NULL,'Dalao们快来评论啊QAQ',_t('评论框提示信息'),_t('未输入时显示在评论框的文字'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('commenthelper',NULL,'支持Markdown和LaTeX数学公式',_t('评论框帮助信息'),_t('显示在评论框下部的帮助信息'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Text('commentsuccess',NULL,'评论成功QwQ！',_t('评论成功提示信息'),_t('评论成功时显示的提示信息'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('commentpicture',array(
		'true' => '启用',
		'false' => '不启用'
	),'true',_t('评论表情框'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('commenttextlimit',NULL,NULL,_t('评论字数限制'),_t('限制评论的最大字数，不填则没有限制（注：<strong>作用有限</strong>）'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('upyuncdn',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('又拍云图标'),_t('在网站右下角显示又拍云图标'));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('apisalt',NULL,Typecho_Common::randString(32),_t('API接口保护'),_t('保护API不被滥用，在启用主题时自动生成，无需手动设置。若没有生成，可重启主题（<strong>注意备份</strong>）'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Textarea('customjs',NULL,NULL,_t('自定义代码'),_t('这里可以写入自定义的js,css等代码，如添加统计代码'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Textarea('pjaxreload',NULL,NULL,_t('附加PJAX重载'),_t('这里可以写入自定义的PJAX重载代码'));
	$form->addInput($config);
}
function errorexit($status) {header($status);die();}
function printjson($json) {header('Content-type:application/json;charset=utf-8');die($json);}
function printarray($data) {printjson(json_encode($data));}
function geturl($url){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE); 
	curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE); 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$output=curl_exec($ch);curl_close($ch);return $output;
}
function themeInit(){
	Helper::options()->commentsMaxNestingLevels=19260817;
	Helper::options()->commentsMarkdown=true;
	Helper::options()->commentsAntiSpam=false;
	Helper::options()->commentsCheckReferer=false;
	$gets=$_GET;$posts=$_POST;$salt=Helper::options()->apisalt;$type=$gets['type'];
	if ($type=='settingbackup'){
		$opt=$gets['opt'];$db=Typecho_Db::get();
		if ($opt=='backup' && $_SERVER['REQUEST_METHOD']=='POST'){
			if ($gets['salt']!=$salt) errorexit('HTTP/1.1 403 Forbidden');
			$data=$posts['data'];if (empty($data)) errorexit('HTTP/1.1 403 Forbidden');
			if (!empty($db->fetchRow($db->select()->from('table.options')->where('name=?','theme:SettingBackup'))))
				$db->query($db->update('table.options')->rows(array('value'=>$data))->where('name=?','theme:SettingBackup'));
				else $db->query($db->insert('table.options')->rows(array('name'=>'theme:SettingBackup','user'=>'0','value'=>$data)));
			printarray(array('msg'=>'Success'));
		}
		if ($opt=='restore' && $_SERVER['REQUEST_METHOD']=='GET'){
			if ($gets['salt']!=$salt) errorexit('HTTP/1.1 403 Forbidden');
			$data=$db->fetchRow($db->select()->from('table.options')->where('name=?','theme:SettingBackup'));
			if (empty($data)) printarray(array('msg'=>'Error'));
			else printarray(array('msg'=>'Success','data'=>$data['value']));
		}
		errorexit('HTTP/1.1 403 Forbidden');
	}
	if ($type=='bangumicache' && $_SERVER['REQUEST_METHOD']=='GET'){
		$url=$gets['url'];$ssid=$gets['ssid'];if (empty($url) || empty($ssid)) errorexit('HTTP/1.1 403 Forbidden');
		if ($gets['auth']!=md5($url.$salt.$ssid)) errorexit('HTTP/1.1 403 Forbidden');
		mkdir(Helper::options()->themeFile(ThemeName(),"cache/bangumi/cover"),0777,true);
		if (!file_exists(Helper::options()->themeFile(ThemeName(),"cache/bangumi/cover/".$ssid.'.jpg'))){
			$img=geturl($url);if (empty($img)) errorexit('HTTP/1.1 403 Forbidden');
			$file=fopen(Helper::options()->themeFile(ThemeName(),"cache/bangumi/cover/".$ssid.'.jpg'),"w");
			fwrite($file,$img);fclose($file);
		}
		header('Location:'.Helper::options()->themeUrl.'/cache/bangumi/cover/'.$ssid.'.jpg');
	}
}
function ThemeName(){
	$db=Typecho_Db::get();$query=$db->select('value')->from('table.options')->where('name = ?','theme');
	$result=$db->fetchAll($query);return $result[0]["value"];
}
function ThemePrimary(){
	$primary=Helper::options()->themeprimary;
	switch($primary){
		case 'red':return '#F44336';break;
		case 'pink':return '#E91E63';break;
		case 'purple':return '#9C27B0';break;
		case 'deep-purple':return '#673AB7';break;
		case 'indigo':return '#3F51B5';break;
		case 'blue':return '#2196F3';break;
		case 'light-blue':return '#03A9F4';break;
		case 'cyan':return '#00BCD4';break;
		case 'teal':return '#009688';break;
		case 'green':return '#4CAF50';break;
		case 'light-green':return '#8BC34A';break;
		case 'lime':return '#CDDC39';break;
		case 'yellow':return '#FFEB3B';break;
		case 'amber':return '#FFC107';break;
		case 'orange':return '#FF9800';break;
		case 'deep-orange':return '#FF5722';break;
		case 'brown':return '#795548';break;
		case 'grey':return '#9E9E9E';break;
		case 'blue-grey':return '#607D8B';break;
		default:return '#3F51B5';
	}
}
function ThemeAccent(){
	$accent=Helper::options()->themeaccent;
	switch($accent){
		case 'red':return '#FF5252';break;
		case 'pink':return '#FF4081';break;
		case 'purple':return '#E040FB';break;
		case 'deep-purple':return '#7C4DFF';break;
		case 'indigo':return '#536DFE';break;
		case 'blue':return '#448AFF';break;
		case 'light-blue':return '#40C4FF';break;
		case 'cyan':return '#18FFFF';break;
		case 'teal':return '#64FFDA';break;
		case 'green':return '#69F0AE';break;
		case 'light-green':return '#B2FF59';break;
		case 'lime':return '#EEFF41';break;
		case 'yellow':return '#FFFF00';break;
		case 'amber':return '#FFD740';break;
		case 'orange':return '#FFAB40';break;
		case 'deep-orange':return '#FF6E40';break;
		default:return '#448AFF';
	}
}
function Countdays($start,$end) {return (strtotime($end)-strtotime($start))/86400;}
function MailHash($mail) {$mailHash=NULL;if (!empty($mail)) $mailHash=md5(strtolower($mail));return $mailHash;}
function GravatarURL($mail,$size) {return Helper::options()->gravatarurl.MailHash($mail).'?s='.$size.'&d=mp';}
/* 魔改自Material(https://github.com/idawnlight/typecho-theme-material) */
function ShowThumbnail($widget){
	$fields=unserialize($widget->fields);if ($fields['picUrl']) {echo $fields['picUrl'];return;}
	$rand=mt_rand(1,19);$random=Helper::options()->themeUrl.'/img/random/material-'.$rand.'.png';echo $random;
}
function CountCateOrTag($id){
	$db=Typecho_Db::get();$po=$db->select('table.metas.count')->from('table.metas')->where('parent = ?',$id)->orWhere('mid = ? ',$id);
	$pom=$db->fetchAll($po);$num=count($pom);$shu=0;for ($x=0;$x<$num;$x++) $shu=$pom[$x]['count']+$shu;return $shu;
}
function APlayerSalt($string){
	$plugin=Typecho_Plugin::export();
	if (!array_key_exists('Meting',$plugin['activated'])) return $string;
	$salt=Typecho_Widget::widget('Widget_Options')->plugin('Meting')->salt;
	if (empty($salt)) return $string;
	preg_match('/data-server="(.*?)"/i',$string,$server);
	preg_match('/data-type="(.*?)"/i',$string,$type);
	preg_match('/data-id="(.*?)"/i',$string,$id);
	$auth=md5($salt.$server[1].$type[1].$id[1].$salt);
	return preg_replace('/<div(.*?)>(.*?)<\/div>/i','<div${1} data-auth='.$auth.'>${2}</div>',$string);
}
function comment_author($comment){
	if ($comment->url) echo '<a target="_blank" href="'.$comment->url.'" rel="external nofollow">'.$comment->author.'</a>';
	else echo $comment->author;
}
/* 魔改自Smilies(https://github.com/jzwalk/Smilies) */
function ConvertSmilies($widget){
	$getJson=file_get_contents(Helper::options()->themeFile(ThemeName(),"img/QAQ/QAQ.json"));
	$QAQTAB=json_decode($getJson,true);$TABName=array_keys($QAQTAB);$length=count($TABName);
	for ($i=0;$i<$length;$i++){
		$key=$TABName[$i];$tot=count($QAQTAB[$key]['content']);
		if ($QAQTAB[$key]['type']=='picture'){
			$width=$QAQTAB[$key]['width'];$height=$QAQTAB[$key]['height'];
			for ($j=0;$j<$tot;$j++){
				$string=':'.$key.$QAQTAB[$key]['content'][$j]['id'].':';
				$smiliesTrans[$string][0]='/'.$key.'/'.$QAQTAB[$key]['content'][$j]['path'];
				if ($width!='') $smiliesTrans[$string][1]=$width;
				if ($QAQTAB[$key]['content'][$j]['width']!='') $smiliesTrans[$string][1]=$QAQTAB[$key]['content'][$j]['width'];
				if ($height!='') $smiliesTrans[$string][2]=$height;
				if ($QAQTAB[$key]['content'][$j]['height']!='') $smiliesTrans[$string][2]=$QAQTAB[$key]['content'][$j]['height'];
				$smiliesTrans[$string][2]=$QAQTAB[$key]['content'][$j]['tip'];
			}
		}
	}
	$imgUrl=Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/QAQ/';
	foreach($smiliesTrans as $smiley => $img){
		$smiliesTag[]=$smiley;
		$smiliesReplace[]="<img src=\"$imgUrl$img[0]\" alt=\"$img[2]\" width=\"$img[1]\" height=\"$img[2]\" />";
	}
	$output='';$textArr=preg_split("/(<.*>)/U",$widget,-1,PREG_SPLIT_DELIM_CAPTURE);$stop=count($textArr);
	for ($i=0;$i<$stop;$i++){
		$content=$textArr[$i];
		if ((strlen($content)>0)&&('<'!=$content{0}))
			$content=str_replace($smiliesTag,$smiliesReplace,$content);
		$output.=$content;
	}
	return $output;
}
function GetCommentAt($coid){
	$db=Typecho_Db::get();$fa=$db->fetchRow($db->select('coid,author')->from('table.comments')->where('coid = ?',$coid));
	return '<strong class="haveat"><a href="#comment-'.$fa['coid'].'">@'.$fa['author'].'&nbsp;</a></strong>';
}
function RewriteComment($comment){
	$content=ConvertSmilies($comment->content);
	if ($comment->parent) $content=GetCommentAt($comment->parent).$content;
	return $content;
}
function AddMDUITable($content){
	return preg_replace('/<table>(.*?)<\/table>/is','<div class="mdui-table-fluid"><table class="mdui-table mdui-table-hoverable">${1}</table></div>',$content);
}
function AddFancybox($content){
	return preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/i','<a data-fancybox="gallery" href="${2}" data-caption="${4}" class="Fancybox"><img${1}src="${2}"${3}alt="${4}"${5}></a>',$content);
}
function AddMDUIPanel($content){
	$content=preg_replace('/\[panel title="(.*?)" summary="(.*?)"\]/i','<div class="mdui-panel" mdui-panel><div class="mdui-panel-item"><div class="mdui-panel-item-header"><div class="mdui-panel-item-title">${1}</div><div class="mdui-panel-item-summary">${2}</div><i class="mdui-panel-item-arrow mdui-icon material-icons">&#xe313;</i></div><div class="mdui-panel-item-body">',$content);
	$content=preg_replace('/\[panel title="(.*?)"\]/i','<div class="mdui-panel" mdui-panel><div class="mdui-panel-item"><div class="mdui-panel-item-header"><div class="mdui-panel-item-title" style="width:100%">${1}</div><i class="mdui-panel-item-arrow mdui-icon material-icons">&#xe313;</i></div><div class="mdui-panel-item-body">',$content);
	return preg_replace('/\[\/panel\]/i','</div></div></div>',$content);
}
function getbangumi($uid,$pn){
	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,"https://api.bilibili.com/x/space/bangumi/follow/list?type=1&follow_status=0&pn=".$pn."&ps=100&vmid=".$uid."&ts=998244353");
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_REFERER,'https://space.bilibili.com/'.$uid.'/bangumi');
	curl_setopt($ch,CURLOPT_HTTPHEADER,array("Origin:https://space.bilibili.com","Referer:https://space.bilibili.com/".$uid."/bangumi"));
	$output=curl_exec($ch);curl_close($ch);return $output;
}
function BangumiList($uid){
	if (empty($uid)) return '';
	if (!empty($json=file_get_contents(Helper::options()->themeFile(ThemeName(),"cache/bangumi/bangumidata.json")))){
		$bangumi=json_decode($json,true);$timeout=Helper::options()->bangumicachetimeout;if ($timeout=='') $timeout=43200;
		if ($bangumi['uid']==$uid && strtotime(date('Y-m-d H:i:s'))-strtotime($bangumi['time'])<$timeout) return $bangumi['data'];
	} else mkdir(Helper::options()->themeFile(ThemeName(),"cache/bangumi"),0777,true);
	$json=getbangumi($uid,1);if (empty($json)) return '';
	$bangumi=json_decode($json,true);$data=$bangumi['data']['list'];
	$total=$bangumi['data']['total'];$pn=1;
	while (true){
		$total-=100;if ($total<=0) break;$pn++;
		$json=getbangumi($uid,$pn);$bangumi=json_decode($json,true);
		$data=array_merge($data,$bangumi['data']['list']);
	}
	$json=json_encode(array('time'=>date('Y-m-d H:i:s'),'uid'=>$uid,'data'=>$data));
	$file=fopen(Helper::options()->themeFile(ThemeName(),"cache/bangumi/bangumidata.json"),"w");
	fwrite($file,$json);fclose($file);return $data;
}
function BangumiCover($url,$ssid){
	if (file_exists(Helper::options()->themeFile(ThemeName(),"cache/bangumi/cover/".$ssid.'.jpg'))) return Helper::options()->themeUrl.'/cache/bangumi/cover/'.$ssid.'.jpg';
	return Helper::options()->siteUrl."?".http_build_query(array('type'=>'bangumicache','url'=>$url,'ssid'=>$ssid,'auth'=>md5($url.Helper::options()->apisalt.$ssid)));
}
function BangumiStar($rating){
	$score=$rating['score'];$count=$rating['count'];if ($count==0) return '<span class="mdui-text-color-orange">暂无评分</span>';
	$str='';$star=floor($score/2);for ($i=1;$i<=$star;$i++) $str.='<i class="mdui-icon material-icons">&#xe838;</i>';
	if ($score-$star*2>=1.5) {$star++;$str.='<i class="mdui-icon material-icons">&#xe838;</i>';}
	else if ($score-$star*2>=0.5) {$star++;$str.='<i class="mdui-icon material-icons">&#xe839;</i>';}
	for ($i=$star+1;$i<=5;$i++) $str.='<i class="mdui-icon material-icons">&#xe83a;</i>';
	return '<span class="mdui-text-color-orange">'.$str.' '.$score.'</span>';
}
function BangumiPanel($uid){
	$list=BangumiList($uid);if (empty($list)) return '';$n=count($list);$str='';
	$temp='<div class="mdui-col mdui-m-y-1" mdui-tooltip="{content:\'{title}\',position:\'top\'}"><a href="{url}" target="_blank" class="mdui-card mdui-hoverable">
		<div class="mdui-card-media"><div class="bangumi-cover" style="background-image:url({cover})"></div></div>
		<div class="mdui-card-content"><div class="bangumi-title mdui-typo-subheading mdui-text-truncate">{title}</div><div class="bangumi-star">{star}</div></div>	
	</a></div>';
	$str.='<div id="bangumi">';$str.='<h1>在看</h1>';
	$str.='<div class="mdui-row-xs-2 mdui-row-sm-4 mdui-row-md-5 mdui-row-lg-5 mdui-row-xl-5">';
	for ($i=0;$i<$n;$i++)
		if ($list[$i]['follow_status']==2)
			$str.=str_replace(array('{url}','{title}','{cover}','{star}'),array($list[$i]['url'],$list[$i]['title'],BangumiCover($list[$i]['cover'],$list[$i]['season_id']),BangumiStar($list[$i]['rating'])),$temp);
	$str.='</div><h1>看过</h1>';
	$str.='<div class="mdui-row-xs-2 mdui-row-sm-4 mdui-row-md-5 mdui-row-lg-5 mdui-row-xl-5">';
	for ($i=0;$i<$n;$i++)
		if ($list[$i]['follow_status']==3)
			$str.=str_replace(array('{url}','{title}','{cover}','{star}'),array($list[$i]['url'],$list[$i]['title'],BangumiCover($list[$i]['cover'],$list[$i]['season_id']),BangumiStar($list[$i]['rating'])),$temp);
	$str.='</div></div>';return $str;
}
function AddBangumi($content){
	preg_match('/\[bangumi uid="(.*?)"\]/i',$content,$match);
	return preg_replace('/\[bangumi uid="'.$match[1].'"\]/i',BangumiPanel($match[1]),$content);
}
function RewriteContent($content){
	$content=ConvertSmilies($content);
	$content=AddFancybox($content);
	$content=AddMDUITable($content);
	$content=AddMDUIPanel($content);
	$content=AddBangumi($content);
	return $content;
}