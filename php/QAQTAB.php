<?php
	//魔改自Castle(https://github.com/ohmyga233/castle-Typecho-Theme)的表情框配置
	$QAQjson=file_get_contents(Helper::options()->themeFile(ThemeName(),"img/QAQ/QAQ.json"));
	$QAQTAB=json_decode($QAQjson,true);$TABName=array_keys($QAQTAB);$length=count($TABName);
?>
<div class="mdui-text-color-theme-accent mdui-btn mdui-btn-icon mdui-float-left" style="margin:0 8px;" mdui-tooltip="{content:'使用表情',position:'top'}" mdui-dialog="{target:'#QAQ'}"><i class="mdui-icon material-icons">&#xe24e;</i></div>
<div class="mdui-dialog a-no-bottom" id="QAQ">
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
		<?php } else if ($QAQTAB[$key]['type']=='picture'){ ?>
		<div class="QAQPicture" id="<?php echo $key; ?>">
			<?php for ($j=0;$j<$tot;$j++){ ?>
			<a href="javascript:Smilies.grin(':<?php echo $key.$QAQTAB[$key]['content'][$j]['id']; ?>:');" <?php if ($QAQTAB[$key]['content'][$j]['tip']!='') echo 'mdui-tooltip="{content:\''.$QAQTAB[$key]['content'][$j]['tip'].'\',position:\'top\'}" '; ?>mdui-dialog-close><div class="mdui-btn"><img src="<?php echo asseturl('img/QAQ/'.$key.'/'.$QAQTAB[$key]['content'][$j]['path'],true); ?>" width="<?php if ($QAQTAB[$key]['content'][$j]['width']!='') echo $QAQTAB[$key]['content'][$j]['width']; else echo $QAQTAB[$key]['width']; ?>" height="<?php if ($QAQTAB[$key]['content'][$j]['height']!='') echo $QAQTAB[$key]['content'][$j]['height']; else echo $QAQTAB[$key]['height']; ?>" /></div></a>
			<?php } ?>
		</div>
		<?php } else { ?>
		<div class="QAQTextclose" id="<?php echo $key; ?>">
			<?php for ($j=0;$j<$tot;$j++){ ?>
			<a href="javascript:Smilies.grin('<?php echo $QAQTAB[$key]['content'][$j]['text']; ?>');" <?php if ($QAQTAB[$key]['content'][$j]['tip']!='') echo 'mdui-tooltip="{content:\''.$QAQTAB[$key]['content'][$j]['tip'].'\',position:\'top\'}" '; ?>mdui-dialog-close><span class="mdui-btn"><?php echo $QAQTAB[$key]['content'][$j]['text']; ?></span></a>
			<?php } ?>
		</div>
		<?php } ?>
	<?php } ?>
	</div>
	<div class="mdui-dialog-actions"><div class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-dialog-close>关闭表情</div></div>
</div>