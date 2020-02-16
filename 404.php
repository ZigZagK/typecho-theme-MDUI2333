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
						<p>404页面是客户端在浏览网页时，服务器无法正常提供信息，或是服务器无法回应，且不知道原因所返回的页面。据说在第三次科技革命之前，互联网的形态就是一个大型的中央数据库，这个数据库就设置在404房间里面。那时候所有的请求都是由人工手动完成的，如果在数据库中没有找到请求者所需要的文件，或者由于请求者写错了文件编号，用户就会得到一个返回信息：room 404 : file not found。404错误信息通常是在目标页面被更改或移除，或客户端输入页面地址错误后显示的页面，人们也就习惯了用404作为服务器未找到文件的错误代码了。当然实际考证传说中的room 404是不存在的，在http请求3位的返回码中，4开头的代表客户错误，5开头代表服务器端错误。</p>
						<p>……</p>
						<p>当用户不小心访问了某一个不存在的页面并且没有设置错误提示 时，用户会怎么做？如果是初次到访的访客，那么回头率是多少呢？毫无疑问，会抱怨为何出现错误，之后当然是直接关闭窗口离开。所以设置了 404页面也相当于是做了一个针对用户的提示页面，当用户访问了某一个 不存在的页面后就会转到404页面，然后因为你在这个404页面上有友好 的提示，并且有首页和主要栏目页的连接，用户就很有可能会再次点击进入你的首页。但是，Web服务器默认的404错误页面，无论是Apache还是IIS，均十分简陋、呆板且对用户不友好，无法给用户提供必要的信息以获取更 多线索，无疑这会造成用户的流失。 因此，很多网站均使用自定义404错误的方式提供用户体验避免用户流失。一般而言，自定义404页面通用的做法是在页面中放置网站快速导航链接、搜索框以及网页提供的特色服务，这样可以有效的帮助用户访问站点并获取需要的信息。</p>
						<footer>百度百科 —— 404页面</footer>
					</blockquote>
					<del>在404页面划水也是不错的体验呢。</del>
				</div>
				<div class="mdui-card-actions">
					<a href="/" class="mdui-btn mdui-ripple mdui-color-theme-accent">返回首页</a>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-tooltip="{content:'右上角可以搜索文章哦',position:'top'}">帮助 1</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-tooltip="{content:'左上角导航栏里有分类和标签啊',position:'top'}">帮助 2</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-tooltip="{content:'不想看文章了也可以左下角听歌呢',position:'top'}">帮助 3</button>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent" onclick="mdui.snackbar({message:'你是有多无聊才把帮助都点了一遍',position:'right-bottom'});" mdui-tooltip="{content:'<del>你是有多无聊才把帮助都看了一遍</del>',position:'top'}">我是凑数</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>