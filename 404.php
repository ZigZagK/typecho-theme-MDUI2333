<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-typo mdui-card mdui-m-y-3">
				<div class="mdui-card-primary">
					<div class="mdui-card-primary-title">404 Not Found!</div>
					<div class="mdui-card-primary-subtitle">并没有此页面呢……</div>
				</div>
				<div class="mdui-card-content">
					<p>你到底是怎么进来的？算了不关我事QAQ……</p>
					<blockquote>
						<p id="hitokoto">一言加载中</p>
						<footer>—— <span id="hitokotofrom">一言加载中</span></footer>
					</blockquote>
					<blockquote>
						<p id="OIerdictum">大佬语录加载中</p>
						<footer>—— <span id="OIerdictumdalao">大佬语录加载中</span></footer>
					</blockquote>
					<button class="mdui-btn mdui-btn-icon mdui-ripple mdui-color-theme-accent" id="ordermore"><i class="mdui-icon material-icons">&#xe5d5;</i></button><span class="mdui-text-color-theme-accent mdui-m-l-1"><strong>再来两条</strong></span>
					<script>
						$.ajax({url:'https://v1.hitokoto.cn/',success:function(data) {$('#hitokoto').text(data.hitokoto);$('#hitokotofrom').text(data.from);}});
						$.ajax({url:'https://api.zigzagk.top/dictumapi/?type=dictum&encode=json',success:function(data) {$('#OIerdictum').text(data.text);$('#OIerdictumdalao').text(data.dalao);}});
						$('#ordermore').click(function(){
							$.ajax({url:'https://v1.hitokoto.cn/',success:function(data) {$('#hitokoto').text(data.hitokoto);$('#hitokotofrom').text(data.from);}});
							$.ajax({url:'https://api.zigzagk.top/dictumapi/?type=dictum&encode=json',success:function(data) {$('#OIerdictum').text(data.text);$('#OIerdictumdalao').text(data.dalao);}});
						});
					</script>
				</div>
				<div class="mdui-card-actions">
					<a href="/" class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-m-a-1">返回首页</a>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-m-a-1" mdui-tooltip="{content:'右上角可以搜索文章哦',position:'top'}">帮助 1</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-m-a-1" mdui-tooltip="{content:'左上角导航栏里有分类和标签啊',position:'top'}">帮助 2</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-m-a-1" mdui-tooltip="{content:'不想看文章了也可以左下角听歌呢',position:'top'}">帮助 3</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-m-a-1" onclick="mdui.snackbar({message:'你是有多无聊才把帮助都点了一遍',position:'right-bottom'});" mdui-tooltip="{content:'<del>你是有多无聊才把帮助都看了一遍</del>',position:'top'}">我是凑数</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>