<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->options->AplayerCode) echo $this->options->AplayerCode; ?>
<a class="mdui-fab mdui-fab-fixed mdui-fab-mini mdui-color-theme-accent mdui-ripple mdui-fab-hide" id="gototop" style="z-index:1"><i class="mdui-icon material-icons">keyboard_arrow_up</i></a>
<footer id="footer" role="contentinfo">
	<div class="mdui-color-white">
		<div class="mdui-container">
			<div class="mdui-row mdui-p-y-4">
				<div class="mdui-col-xs-4 mdui-col-md-3 mdui-col-offset-md-1">
					<div class="mdui-float-left">
						<?php if ($this->options->githublink) { ?><a href="<?php echo $this->options->githublink; ?>" target="_blank" class="mdui-p-x-1"><i class="mdui-icon mdui-text-color-theme-accent iconfont icon-github" mdui-tooltip="{content: 'github', position: 'top'}"></i></a><?php } ?>
						<?php if ($this->options->bilibililink) { ?><a href="<?php echo $this->options->bilibililink; ?>" target="_blank" class="mdui-p-x-1"><i class="mdui-icon mdui-text-color-theme-accent iconfont icon-bilibili" mdui-tooltip="{content: 'bilibili', position: 'top'}"></i></a><?php } ?>
						<?php if ($this->options->zhihulink) { ?><a href="<?php echo $this->options->zhihulink; ?>" target="_blank" class="mdui-p-x-1"><i class="mdui-icon mdui-text-color-theme-accent iconfont icon-zhihu" mdui-tooltip="{content: '知乎', position: 'top'}"></i></a><?php } ?>
					</div>
				</div>
				<div class="mdui-typo mdui-col-xs-4 mdui-col-md-4">
					<div class="mdui-text-center">
						<div>Copyright © <?php echo date("Y"); ?> <a href="/"><?php $this->options->title(); ?></a></div>
						<?php if ($this->options->filing) { ?><div><a href="http://www.beian.miit.gov.cn" target="_blank" rel="nofollow"><?php echo $this->options->filing; ?></a></div><?php } ?>
						<?php if ($this->options->gafiling) { ?><div><img src="<?php Helper::options()->themeUrl(); ?>/img/gaba.png" /><?php echo $this->options->gafiling; ?></div><?php } ?>
					</div>
				</div>
				<div class="mdui-typo mdui-col-xs-4 mdui-col-md-3">
					<div class="mdui-float-right">
						<div>Powered by <a href="http://typecho.org" target="_blank">Typecho</a></div>
						<div>Theme by <a href="https://github.com/ZigZagK/typecho-theme-MDUI2333" target="_blank">MDUI2333</a></div>
						<?php if ($this->options->upyuncdn=='true') { ?><div><span style="line-height:28px;">CDN by </span><a href="https://www.upyun.com" target="_blank"><img src="<?php Helper::options()->themeUrl(); ?>/img/upyun.png" height=28 /></a></div><?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php $this->need('js/footerjs.php'); ?>
<?php $this->footer(); ?>

</body>
</html>