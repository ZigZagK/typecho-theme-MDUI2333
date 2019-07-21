<?php
	if (get_headers(Typecho_Widget::widget('Widget_Options')->themeUrl."/img/QAQ/QAQ.json",1)[0]=='HTTP/1.1 200 OK')
		$getJson=file_get_contents(Typecho_Widget::widget('Widget_Options')->themeUrl."/img/QAQ/QAQ.json");
		else $getJson=file_get_contents(Helper::options()->themeFile(ThemeName(),"img/QAQ/QAQ.json"));
	$QAQTAB=json_decode($getJson,true);$TABName=array_keys($QAQTAB);$length=count($TABName);
?>
<div class="mdui-text-color-theme-accent mdui-btn mdui-btn-icon mdui-float-left" mdui-tooltip="{content: '使用表情',position: 'top'}" mdui-dialog="{target: '#QAQ'}"><i class="mdui-icon material-icons">sentiment_very_satisfied</i></div>
<div class="mdui-dialog" id="QAQ">
	<div class="mdui-tab mdui-tab-full-width" id="QAQTab">
	<?php for ($i=0;$i<$length;$i++){ ?>
		<?php $key=$TABName[$i]; ?>
		<a href="#<?php echo $key; ?>" class="mdui-ripple"><?php echo $QAQTAB[$key]['title']; ?></a>
	<?php } ?>
	</div>
	<div class="mdui-dialog-content">
	<?php for ($i=0;$i<$length;$i++){ ?>
		<?php $key=$TABName[$i];$tot=count($QAQTAB[$key]['content']); ?>
		<?php if ($QAQTAB[$key]['type']=='text'){ ?>
		<div id="<?php echo $key; ?>">
			<?php for ($j=0;$j<$tot;$j++){ ?>
			<a href="javascript:Smilies.grin('<?php echo $QAQTAB[$key]['content'][$j]['text']; ?>');" <?php if ($QAQTAB[$key]['content'][$j]['tip']!='') echo 'mdui-tooltip="{content:\''.$QAQTAB[$key]['content'][$j]['tip'].'\',position:\'top\'}" '; ?>mdui-dialog-close><span class="mdui-btn"><?php echo $QAQTAB[$key]['content'][$j]['text']; ?></span></a>
			<?php } ?>
		</div>
		<?php } else { ?>
		<div class="QAQPicture" id="<?php echo $key; ?>">
			<?php for ($j=0;$j<$tot;$j++){ ?>
			<a href="javascript:Smilies.grin(':<?php echo $key.$QAQTAB[$key]['content'][$j]['id']; ?>:');" <?php if ($QAQTAB[$key]['content'][$j]['tip']!='') echo 'mdui-tooltip="{content:\''.$QAQTAB[$key]['content'][$j]['tip'].'\',position:\'top\'}" '; ?>mdui-dialog-close><div class="mdui-btn"><img src="<?php echo Typecho_Widget::widget('Widget_Options')->themeUrl.'/img/QAQ/'.$key.'/'.$QAQTAB[$key]['content'][$j]['path']; ?>" /></div></a>
			<?php } ?>
		</div>
		<?php } ?>
	<?php } ?>
	</div>
	<div class="mdui-dialog-actions"><div class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-dialog-close>关闭表情</div></div>
</div>