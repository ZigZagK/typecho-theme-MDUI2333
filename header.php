<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="theme-color" content="<?php echo ThemePrimary(); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
	<title><?php $this->archiveTitle(array(
		'category' => _t('分类 %s 下的文章'),
		'search' => _t('包含关键字 %s 的文章'),
		'tag' => _t('标签 %s 下的文章'),
		'author' => _t('%s 发布的文章')
	),'',' - '); ?><?php $this->options->title(); ?></title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdui@0.4.2/dist/css/mdui.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.0/build/styles/<?php if ($this->options->highlightstyle) echo $this->options->highlightstyle; else echo "default"?>.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="<?php Helper::options()->themeUrl(); ?>img/iconfont/iconfont.css" />
	<link rel="stylesheet" href="<?php Helper::options()->themeUrl(); ?>css/animate.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/mdui@0.4.2/dist/js/mdui.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-pjax@2.0.1/jquery.pjax.min.js"></script>
	<script type="text/x-mathjax-config">
		MathJax.Hub.Config({
			elements:["pjax-container"],
			showProcessingMessages:false,
			messageStyle:"none",
			extensions:["tex2jax.js"],
			jax:["input/TeX","output/HTML-CSS"],
			tex2jax:{
				inlineMath:[["$","$"],["\\(","\\)"]],
				displayMath:[["$$","$$"],["\\[","\\]"]],
				processEscapes:true
			},
			"HTML-CSS":{availableFonts:["TeX"]}
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/mathjax@2.7.5/unpacked/MathJax.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.0/build/highlight.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/blueimp-md5@2.10.0/js/md5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>
	<script src="<?php Helper::options()->themeUrl(); ?>js/jquery.headindex.min.js"></script>
	<?php $this->need('css/MDUI2333css.php'); ?>
	<?php $this->header(); ?>
</head>
<body class="mdui-theme-primary-<?php if ($this->options->themeprimary) echo $this->options->themeprimary; else echo "indigo"; ?> mdui-theme-accent-<?php if ($this->options->themeaccent) echo $this->options->themeaccent; else echo "blue" ?> mdui-appbar-with-toolbar">
	<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-hide">
		<div class="mdui-toolbar mdui-color-theme">
			<a class="mdui-btn mdui-btn-icon" id="togglesidebar"><i class="mdui-icon material-icons">&#xe5d2;</i></a>
			<a href="<?php $this->options->siteUrl(); ?>" class="mdui-typo-title"><?php $this->options->title(); ?></a>
			<div class="mdui-toolbar-spacer"></div>
			<?php if ($this->options->ExSearch=='true'){ ?>
			<button class="mdui-btn mdui-btn-icon search-form-input" mdui-tooltip="{content:'文章搜索'}"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
			<?php } else { ?>
			<div class="mdui-hidden-xs-down">
				<div class="mdui-textfield mdui-textfield-expandable mdui-float-right">
					<form method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
						<div class="mdui-textfield-icon mdui-btn mdui-btn-icon mdui-color-white-accent" style="top:unset;left:unset;" mdui-tooltip="{content:'文章搜索'}"><i class="mdui-icon material-icons">&#xe8b6;</i></div>
						<input type="text" name="s" class="mdui-textfield-input mdui-text-color-white" type="text" placeholder="输入关键字搜索"/>
						<div class="mdui-textfield-close mdui-btn mdui-btn-icon mdui-color-white-accent"><i class="mdui-icon material-icons">&#xe5cd;</i></div>
					</form>
				</div>
			</div>
			<?php } ?>
			<?php if ($this->user->hasLogin()){ ?>
				<a href="<?php $this->options->adminUrl(); ?>" target="_blank" class="mdui-btn mdui-btn-icon" mdui-tooltip="{content:'控制台'}"><i class="mdui-icon material-icons">&#xe8b8;</i></a>
			<?php } else { ?>
				<a href="<?php $this->options->adminUrl(); ?>" target="_blank" class="mdui-btn mdui-btn-icon" mdui-tooltip="{content:'登录'}"><i class="mdui-icon material-icons">&#xe853;</i></a>
			<?php } ?>
		</div>
	</div>
	<div id="pjax-overlay" style="display:none;"></div>
	<div class="mdui-dialog mdui-dialog-open" id="pjax-progress" style="display:none;">
		<div class="mdui-p-x-2">
			<p class="mdui-text-center"><?php echo $this->options->pjaxloading; ?></p>
			<div class="mdui-progress"><div class="mdui-progress-indeterminate"></div></div>
		</div>
	</div>
	<div id="pjax-container">