<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php if ($this->options->AplayerCode) echo $this->options->AplayerCode; ?>
<script src="https://cdn.jsdelivr.net/npm/aplayer@1.10/dist/APlayer.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/meting@1.2/dist/Meting.min.js"></script>

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

<script src="https://cdnjs.loli.net/ajax/libs/mdui/0.4.1/js/mdui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>


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
			// something went wrong, hide the canvas container
			document.getElementById('MyTagCloud').style.display = 'none';
		}
	};
</script>
<script src="<?php Helper::options()->themeUrl(); ?>js/tagcanvas.min.js"></script>

<script type="text/x-mathjax-config">
	MathJax.Hub.Config({
		extensions: ["tex2jax.js"],
		jax: ["input/TeX", "output/HTML-CSS"],
		tex2jax: {
			inlineMath:  [ ["$", "$"],  ["\\(","\\)"] ],
			displayMath: [ ["$$","$$"], ["\\[","\\]"] ],
			processEscapes: true
		},
		"HTML-CSS": { availableFonts: ["TeX"] }
	});
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-MML-AM_CHTML' async></script>
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.13.0/build/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script>
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
	var sidebar = new mdui.Drawer('#sidebar',{overlay:true});
	document.getElementById('togglesidebar').addEventListener('click', function () {sidebar.toggle();});
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
	})
</script>

<?php $this->footer(); ?>
</body>
</html>