<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->options->AplayerCode) echo $this->options->AplayerCode; ?>
<a href="#top" class="mdui-fab mdui-fab-fixed mdui-fab-mini mdui-color-theme-accent mdui-ripple mdui-fab-hide" id="gototop" style="z-index:1"><i class="mdui-icon material-icons">keyboard_arrow_up</i></a>
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
						Copyright © <?php echo date("Y"); ?> <a href="/"><?php $this->options->title(); ?></a>
					</div>
				</div>
				<div class="mdui-typo mdui-col-xs-4 mdui-col-md-3">
					<div class="mdui-float-right">
						<div>Powered by <a href="http://typecho.org" target="_blank">Typecho</a></div>
						<div>Theme by <a href="https://github.com/ZigZagK/typecho-theme-MDUI2333" target="_blank">MDUI2333</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript">
	window.onload = function() {
		try {
			TagCanvas.Start('TagCloud','',{
				textColour: null,
				outlineColour: '#039BE5',
				weight: true,
				reverse: true,
				depth: 1,
				maxSpeed: 0.05,
				freezeDecel: true
			});
		} catch(e) {
			document.getElementById('MyTagCloud').style.display = 'none';
		}
	};
</script>
<script>hljs.initHighlightingOnLoad();</script>
<script>
	var sidebar = new mdui.Drawer('#sidebar',{overlay:true});
	mdui.JQ('#togglesidebar').on('click', function () { sidebar.toggle(); });
	var QAQTab = new mdui.Tab('#QAQTab');
	mdui.JQ('#QAQ').on('open.mdui.dialog', function () { QAQTab.handleUpdate(); });
	$(function(){
		$('pre code').each(function(){
			var lines = $(this).text().split('\n').length;
			var $numbering = $('<ul/>').addClass('pre-numbering');
			for(i=1;i<=lines;i++) $numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend($numbering);
		});
		document.getElementById('pjax-loading').style.display="none";
		document.getElementById('pjax-overlay').classList.remove("pjax-overlay-show");
		document.getElementsByTagName('body')[0].classList.remove("mdui-locked");
	});
	window.onscroll=function(){
		var top = document.getElementById('gototop');
		if ($(window).scrollTop()>200) top.classList.remove('mdui-fab-hide');
		else top.classList.add('mdui-fab-hide');
	}
	$(document).pjax('a:not(a[target="_blank"],a[no-pjax])', {
		container: '#pjax-container',
		fragment: '#pjax-container',
		timeout: 8000
	})
	$(document).on('submit', '#search', function (event) {
		$.pjax.submit(event, {
			container: '#pjax-container',
			fragment: '#pjax-container',
			timeout: 8000
		});
	})
	$(document).on('pjax:send',
	function() {
		sidebar.close();
		document.getElementsByTagName('body')[0].classList.add("mdui-locked");
		document.getElementById('pjax-overlay').classList.add("pjax-overlay-show");
		document.getElementById('pjax-loading').style.display="block";
	})
	$(document).on('pjax:complete',
	function() {
		MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
		hljs.initHighlighting.called = false;hljs.initHighlighting();
		$('pre code').each(function(){
			var lines = $(this).text().split('\n').length;
			var $numbering = $('<ul/>').addClass('pre-numbering');
			for(i=1;i<=lines;i++) $numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend($numbering);
		});
		document.getElementById('pjax-loading').style.display="none";
		document.getElementById('pjax-overlay').classList.remove("pjax-overlay-show");
		document.getElementsByTagName('body')[0].classList.remove("mdui-locked");
	})
	$(document).on('pjax:end',
	function() {
		mdui.mutation();
		loadMeting();
	})
</script>

<?php $this->footer(); ?>
</body>
</html>