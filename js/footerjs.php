<script>
	//返回顶部
	$('#gototop').click(function(){$('html,body').animate({scrollTop:'0px'},'normal');});
	window.onscroll=function(){
		var top = document.getElementById('gototop');
		if ($(window).scrollTop()>200) top.classList.remove('mdui-fab-hide');
		else top.classList.add('mdui-fab-hide');
	}
	//侧边栏按钮
	var sidebar=new mdui.Drawer('#sidebar',{overlay:true});
	mdui.JQ('#togglesidebar').on('click',function() {sidebar.toggle();});
	//表情框按钮
	var QAQTab=new mdui.Tab('#QAQTab');
	mdui.JQ('#QAQ').on('open.mdui.dialog',function() {QAQTab.handleUpdate();});
	//球形标签云加载
	<?php if ($this->options->tagcloudmode=='ball'){ ?>
	window.onload=function(){
		try{
			TagCanvas.Start('TagCloud','',{textColour: null,outlineColour: '#039BE5',weight: true,reverse: true,depth: 1,maxSpeed: 0.05,freezeDecel: true});
		} catch(e) {document.getElementById('MyTagCloud').style.display = 'none';}
	};
	<?php } ?>
	//代码高亮
	hljs.initHighlightingOnLoad();
	//百度统计代码
	<?php if ($this->options->baidustatistics) echo $this->options->baidustatistics; ?>
	//即时搜索
	<?php if ($this->options->ExSearch=='true'){ ?>
	function ExSearchCall(item){
		if (item&&item.length){
			$('.ins-close').click();let url=item.attr('data-url');
			$.pjax({url:url,container:'#pjax-container',fragment:'#pjax-container',timeout:8000});
		}
	}
	<?php } ?>
	//第一次加载
	$(function(){
		$('pre code').each(function(){
			var lines = $(this).text().split('\n').length;
			var $numbering = $('<ul/>').addClass('pre-numbering');
			for(i=1;i<=lines;i++) $numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend($numbering);
		});
		<?php if ($this->options->posttoc=='true'){ ?>
		$("#post-container").headIndex({
			articleWrapSelector: '#post-container',
			indexBoxSelector: '#post-toc',
			offset: -420
		});
		<?php } ?>
		document.getElementById('pjax-loading').style.display="none";
		document.getElementById('pjax-overlay').classList.remove("pjax-overlay-show");
		document.getElementsByTagName('body')[0].classList.remove("mdui-locked");
		mdui.mutation();
	});
	//PJAX
	$(document).pjax('a:not(a[target="_blank"],a[no-pjax])',{
		container: '#pjax-container',
		fragment: '#pjax-container',
		timeout: 8000
	})
	$(document).on('submit','#search',function(event){
		$.pjax.submit(event,{
			container: '#pjax-container',
			fragment: '#pjax-container',
			timeout: 8000
		});
	})
	//PJAX重载
	$(document).on('pjax:send',
	function() {
		sidebar.close();
		document.getElementsByTagName('body')[0].classList.add("mdui-locked");
		document.getElementById('pjax-overlay').classList.add("pjax-overlay-show");
		document.getElementById('pjax-loading').style.display="block";
	})
	$(document).on('pjax:complete',
	function() {
		MathJax.Hub.Typeset(document.getElementById('pjax-container'));
		hljs.initHighlighting.called = false;hljs.initHighlighting();
		$('pre code').each(function(){
			var lines = $(this).text().split('\n').length;
			var $numbering = $('<ul/>').addClass('pre-numbering');
			for(i=1;i<=lines;i++) $numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend($numbering);
		});
		<?php if ($this->options->posttoc=='true'){ ?>
		$("#post-container").headIndex({
			articleWrapSelector: '#post-container',
			indexBoxSelector: '#post-toc',
			offset: -420
		});
		<?php } ?>
		document.getElementById('pjax-loading').style.display="none";
		document.getElementById('pjax-overlay').classList.remove("pjax-overlay-show");
		document.getElementsByTagName('body')[0].classList.remove("mdui-locked");
	})
	$(document).on('pjax:end',
	function() {
		mdui.mutation();
		<?php $all=Typecho_Plugin::export(); ?>
		<?php if (array_key_exists('Meting',$all['activated'])){ ?>
		loadMeting();
		<?php } ?>
	})
</script>