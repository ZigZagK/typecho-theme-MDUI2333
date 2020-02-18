<?php $plugin=Typecho_Plugin::export(); ?>
<script>
	$('#gototop').click(function(){$('html,body').animate({scrollTop:'0px'},'normal');});
	$(window).scroll(function(){
		if ($(window).scrollTop()>200) $('#gototop').removeClass('mdui-fab-hide');
		else $('#gototop').addClass('mdui-fab-hide');
	});
	var sidebar=new mdui.Drawer('#sidebar',{overlay:true});
	$('#togglesidebar').on('click',function(){sidebar.toggle();});
	var QAQTab=new mdui.Tab('#QAQTab');
	$('#QAQ').on('open.mdui.dialog',function(){QAQTab.handleUpdate();});
	<?php if ($this->options->ExSearch=='true'){ ?>
	function ExSearchCall(item){
		if (item&&item.length){
			$('.ins-close').click();let url=item.attr('data-url');
			$.pjax({url:url,container:'#pjax-container',fragment:'#pjax-container',timeout:8000});
		}
	}
	<?php } ?>
	function animatecss(element,animationName,speed,callback){
		const node=document.querySelector(element);
		node.classList.add('animated',animationName);
		$(element).css('animation-duration',speed);
		function handleAnimationEnd(){
			node.classList.remove('animated',animationName);
			node.removeEventListener('animationend',handleAnimationEnd);
			if (typeof callback==='function') callback();
		}
		node.addEventListener('animationend',handleAnimationEnd);
	}
	$(function(){
		<?php if ($this->options->announcement!=''){ ?>
		mdui.snackbar({message:"<?php echo $this->options->announcement; ?>",position:'<?php echo $this->options->announcementpos; ?>',closeOnOutsideClick:false});
		<?php } ?>
		hljs.initHighlightingOnLoad();
		$('pre code').each(function(){
			var lines=$(this).text().split('\n').length;
			var numbering=$('<ul/>').addClass('pre-numbering');
			for(var i=1;i<=lines;i++) numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend(numbering);
		});
		<?php if ($this->options->posttoc=='true'){ ?>
		$(".post-container").headIndex({
			articleWrapSelector:'.post-container',
			indexBoxSelector:'#post-toc'
		});
		<?php } ?>
		mdui.mutation();
	});
	$(document).pjax('a:not(a[target="_blank"],a[no-pjax])',{container:'#pjax-container',fragment:'#pjax-container',timeout:8000});
	$(document).on('submit','#search',function(event){$.pjax.submit(event,{container:'#pjax-container',fragment:'#pjax-container',timeout:8000});});
	$(document).on('pjax:send',function(){
		sidebar.close();
		$('#pjax-overlay').css('display','block');
		$('#pjax-progress').css('display','block');
	});
	$(document).on('pjax:complete',function(){
		MathJax.Hub.Typeset(document.getElementById('pjax-container'));
		hljs.initHighlighting.called=false;hljs.initHighlighting();
		$('pre code').each(function(){
			var lines=$(this).text().split('\n').length;
			var numbering=$('<ul/>').addClass('pre-numbering');
			for(var i=1;i<=lines;i++) numbering.append($('<li/>').text(i));
			$(this).addClass('has-numbering').parent().prepend(numbering);
		});
		<?php if ($this->options->posttoc=='true'){ ?>
		$(".post-container").headIndex({
			articleWrapSelector:'.post-container',
			indexBoxSelector:'#post-toc'
		});
		<?php } ?>
		animatecss('#pjax-overlay','fadeOut','0.5s',function(){$('#pjax-overlay').css('display','none');});
		animatecss('#pjax-progress','fadeOut','0.5s',function(){$('#pjax-progress').css('display','none');});
	});
	$(document).on('pjax:end',function(){
		mdui.mutation();
		<?php if (array_key_exists('Meting',$plugin['activated'])){ ?>
		loadMeting();
		<?php } ?>
		<?php echo $this->options->pjaxreload; ?>
	});
</script>
<?php if ($this->options->customjs) echo $this->options->customjs; ?>