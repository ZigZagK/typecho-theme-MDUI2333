<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<link rel="icon shortcut" type="image/ico" href="<?php echo $this->options->favicon ?>">
	<link rel="icon" sizes="192x192" href="<?php echo $this->options->favicon ?>">
	<link rel="apple-touch-icon" href="<?php echo $this->options->favicon ?>">
	<title><?php $this->archiveTitle(array(
			'category'  =>  _t('分类 %s 下的文章'),
			'search'	=>  _t('包含关键字 %s 的文章'),
			'tag'	   =>   _t('标签 %s 下的文章'),
			'author'	=>  _t('%s 发布的文章')
		), '', ' - '); ?><?php $this->options->title(); ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@0.4.2/dist/css/mdui.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aplayer@1.10.1/dist/APlayer.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.0/build/styles/<?php if ($this->options->highlightstyle) echo $this->options->highlightstyle; else echo "default"?>.min.css">
	<link rel="stylesheet" href="https://at.alicdn.com/t/font_909068_po540uas8v.css">
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
	<style>
		a {color:unset;text-decoration:unset;}
		body {background:<?php if ($this->options->backgroundPic) echo 'url(' . $this->options->backgroundPic . ')'; else echo '#b3d4fc'; ?>;background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;}
		div#MathJax_Message{display:none!important;}
		::selection {background:#b3d4fc;text-shadow:none;}
		.pre-numbering {float:left!important;font-size:14px!important;padding:10px!important;margin:0!important;border-right:1px solid #C3CCD0!important;background:#EEE!important;text-align:right!important;color:#666!important;list-style:none!important;line-height:1.6!important;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}
		pre {padding:0!important;background:#f7f7f7!important;}
		.hljs {padding:10px!important;background:#f7f7f7!important;}
		.hljs a {color:unset!important;}
		.hljs a:hover:before,.hljs a:focus:before {display:none!important;}
		code {font-size:14px!important;line-height:1.6!important;}
		.pjax-overlay {position: fixed;top: -5000px;right: -5000px;bottom: -5000px;left: -5000px;z-index: 2000;visibility: hidden;background: rgba(0,0,0,.4);opacity: 0;-webkit-transition-duration: .3s;transition-duration: .3s;-webkit-transition-property: opacity,visibility;transition-property: opacity,visibility;-webkit-backface-visibility: hidden;backface-visibility: hidden;will-change: opacity;}
		.pjax-overlay-show {visibility: visible;opacity: 1;}
	</style>
	<?php $this->header(); ?>
</head>
<body class="mdui-theme-primary-<?php if ($this->options->themeprimary) echo $this->options->themeprimary; else echo "indigo"; ?> mdui-theme-accent-<?php if ($this->options->themeaccent) echo $this->options->themeaccent; else echo "blue" ?> mdui-appbar-with-toolbar mdui-locked" id="top">
	<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-hide">
		<div class="mdui-toolbar mdui-color-theme">
			<a class="mdui-btn mdui-btn-icon" id="togglesidebar"><i class="mdui-icon material-icons">menu</i></a>
			<a href="/" class="mdui-typo-title"><?php $this->options->title(); ?></a>
			<div class="mdui-toolbar-spacer"></div>
			<div class="mdui-hidden-xs-down">
				<div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
					<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
						<div class="mdui-textfield-icon mdui-btn mdui-btn-icon mdui-color-white-accent" style="top:unset;left:unset;" mdui-tooltip="{content: '文章搜索'}"><i class="mdui-icon material-icons">search</i></div>
						<input type="text" id="s" name="s" class="mdui-textfield-input mdui-text-color-white" type="text" placeholder="输入关键字搜索"/>
						<div class="mdui-textfield-close mdui-btn mdui-btn-icon mdui-color-white-accent"><i class="mdui-icon material-icons">close</i></div>
					</form>
				</div>
			</div>
			<?php if ($this->user->hasLogin()){ ?>
				<a href="/admin" target="_blank" class="mdui-btn mdui-btn-icon" mdui-tooltip="{content: '控制台'}"><i class="mdui-icon material-icons">tune</i></a>
			<?php } else { ?>
				<a href="/admin" target="_blank" class="mdui-btn mdui-btn-icon" mdui-tooltip="{content: '登录'}"><i class="mdui-icon material-icons">account_circle</i></a>
			<?php } ?>
		</div>
	</div>
	<div class="pjax-overlay pjax-overlay-show" id="pjax-overlay"></div>
	<div class="mdui-dialog mdui-dialog-open" id="pjax-loading" style="top:calc(50% - 33px);display:block;height:66px;width:300px;z-index:9999;">
		<div class="mdui-p-x-2">
			<p class="mdui-text-center">正在努力加载中QAQ</p>
			<div class="mdui-progress"><div class="mdui-progress-indeterminate"></div></div>
		</div>
	</div>
	<!--Start Of Pjax Part--><div id="pjax-container">