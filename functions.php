<?php
define('Version','1.4.1');
function themeFields($layout){
	$field=new Typecho_Widget_Helper_Form_Element_Text('picUrl',NULL,NULL,_t('图片地址'),_t('在这里填入一个图片 URL 地址，作为文章的头图，不填则显示随机图片'));
	$layout->addItem($field);
	$field=new Typecho_Widget_Helper_Form_Element_Text('description',NULL,NULL,_t('文章描述'),_t('显示在首页等页面中文章的描述，不填则自动截取文章开头作为描述'));
	$layout->addItem($field);
}
function themeConfig($form){
	echo '<style>div#info {border:4px solid #448aff;padding:10px;} ul.typecho-option-submit button {position:fixed;bottom:20px;right:20px;}</style>';
	echo '<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>';
	echo '<script>$.ajax({type:"GET",url:"https://api.zigzagk.top/MDUI2333info/?version='.Version.'",beforeSend:function(xhr){},success:function(data){$("#infolatest").html(data.latest);$("#infotext").html(data.text);},error:function(xhr,textStatus,errorThrown){$("#infolatest").html(" 出错了QAQ ");$("#infotext").html(" 出错了QAQ ");}});</script>';
	echo '<div id="info"><center>您现在的版本是<strong>'.Version.'</strong>，最新的版本是<strong><a target="_blank" href="https://github.com/ZigZagK/typecho-theme-MDUI2333/releases"><span id="infolatest"> Loading... </span></a></strong></center>';
	echo '<center><span id="infotext"> Loading... </span></center></div>';
	echo '<center><h2>这里是MDUI2333主题的一些设置QwQ</h2></center>';
	echo '<center><h3>网站标题等基本信息需要在控制台中填写</h3></center>';
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
	$config=new Typecho_Widget_Helper_Form_Element_Select('highlightmode',array(
		'highlightjs' => 'highlightjs',
		'prismjs' => 'Prismjs'
	),'prismjs',_t('代码片渲染方案'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('highlightstyle',NULL,NULL,_t('代码片渲染样式'),_t('如果采用<code>highlightjs</code>：参考 <a target="_blank" href="https://github.com/highlightjs/highlight.js/tree/master/src/styles">highlightjs</a> 样式，如<code>tomorrow.css</code>则填写<code>tomorrow</code>，如果不填则使用<code>default</code><br>如果采用<code>Prismjs</code>：参考<a href="https://www.jsdelivr.com/package/npm/prismjs?path=themes" target="_blank">Prism</a>中的theme填写，如<code>prism-coy.css</code>则填写<code>prism-coy</code>，如果不填则使用<code>prism</code>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('posttoc',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('文章目录'),_t(''));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Select('ExSearch',array(
		'true' => '启用',
		'false' => '不启用'
	),'false',_t('实时搜索'),_t('需要下载AlanDecode大佬的 <a target="_blank" href="https://github.com/AlanDecode/Typecho-Plugin-ExSearch">ExSearch</a> 插件'));
	$form->addInput($config->multiMode());
	$config=new Typecho_Widget_Helper_Form_Element_Text('AplayerCode',NULL,NULL,_t('全站音乐播放器APlayer代码'),_t('需要下载METO大佬的 <a target="_blank" href="https://github.com/MoePlayer/APlayer-Typecho">Meting</a> 插件。若APlayer不为吸底模式则显示在页面最下方，更多问题详见 <a target="_blank" href="https://github.com/ZigZagK/typecho-theme-MDUI2333/wiki/Meting%E6%8F%92%E4%BB%B6%E5%85%A8%E7%AB%99APlayer">MDUI2333Wiki</a>'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Select('linksmode',array(
		'default' => '默认顺序',
		'rand' => '随机顺序'
	),'default',_t('友链显示顺序'),_t('默认顺序即友情链接管理中的顺序，请注意 <a target="_blank" href="https://github.com/ZigZagK/typecho-links-material">Links插件</a> 需要使用MDUI2333的配套魔改版'));
	$form->addInput($config->multiMode());
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
	$config=new Typecho_Widget_Helper_Form_Element_Textarea('customjs',NULL,NULL,_t('自定义代码'),_t('这里可以写入自定义的js,css等代码，如添加统计代码'));
	$form->addInput($config);
	$config=new Typecho_Widget_Helper_Form_Element_Textarea('pjaxreload',NULL,NULL,_t('附加PJAX重载'),_t('这里可以写入自定义的PJAX重载代码'));
	$form->addInput($config);
}
function themeInit($archive){
	Helper::options()->commentsMaxNestingLevels=19260817; //评论"无限"层
	Helper::options()->commentsMarkdown=true; //评论支持Markdown
	Helper::options()->commentsAntiSpam=false; //关闭评论反垃圾(for AJAX评论)
	Helper::options()->commentsCheckReferer=false; //关闭检查评论来源页URL是否与文章链接一致(for AJAX评论)
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
function MailHash($mail) {$mailHash=NULL;if (!empty($mail)) $mailHash=md5(strtolower($mail));return $mailHash;}
function GravatarURL($mail,$size){
	return Helper::options()->gravatarurl.MailHash($mail).'?s='.$size.'&d=mp';
}
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
			}
		}
	}
	$imgUrl=Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/QAQ/';
	foreach($smiliesTrans as $smiley => $img){
		$smiliesTag[]=$smiley;
		$smiliesReplace[]="<img src=\"$imgUrl$img[0]\" width=\"$img[1]\" height=\"$img[2]\" />";
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
	return preg_replace('/<img(.*?)src="(.*?)"(.*?)alt="(.*?)"(.*?)>/is','<a data-fancybox="gallery" href="${2}" data-caption="${4}" class="Fancybox"><img${1}src="${2}"${3}alt="${4}"${5}></a>',$content);
}
function AddMDUIPanel($content){
	$content=preg_replace('/\[panel title="(.*?)" summary="(.*?)"\]/i','<div class="mdui-panel" mdui-panel><div class="mdui-panel-item"><div class="mdui-panel-item-header"><div class="mdui-panel-item-title">${1}</div><div class="mdui-panel-item-summary">${2}</div><i class="mdui-panel-item-arrow mdui-icon material-icons">&#xe313;</i></div><div class="mdui-panel-item-body">',$content);
	$content=preg_replace('/\[panel title="(.*?)"\]/i','<div class="mdui-panel" mdui-panel><div class="mdui-panel-item"><div class="mdui-panel-item-header"><div class="mdui-panel-item-title">${1}</div><i class="mdui-panel-item-arrow mdui-icon material-icons">&#xe313;</i></div><div class="mdui-panel-item-body">',$content);
	return preg_replace('/\[\/panel\]/i','</div></div></div>',$content);
}
function RewriteContent($content){
	$content=ConvertSmilies($content);
	$content=AddFancybox($content);
	$content=AddMDUITable($content);
	$content=AddMDUIPanel($content);
	return $content;
}