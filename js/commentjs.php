<script>
	//Typecho自带评论函数
	window.TypechoComment = {
		dom : function (id) {return document.getElementById(id);},
		create : function (tag, attr) {
			var el = document.createElement(tag);			
			for (var key in attr) {el.setAttribute(key, attr[key]);}
			return el;
		},
		reply : function (cid, coid) {
			var comment = this.dom(cid), parent = comment.parentNode,
				response = this.dom('<?php $this->respondId(); ?>'), input = this.dom('comment-parent'),
				form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
				textarea = response.getElementsByTagName('textarea')[0];
			if (null == input) {
				input = this.create('input', {
					'type' : 'hidden',
					'name' : 'parent',
					'id'   : 'comment-parent'
				});
				form.appendChild(input);
			}
			input.setAttribute('value', coid);
			if (null == this.dom('comment-form-place-holder')) {
				var holder = this.create('div', {
					'id' : 'comment-form-place-holder'
				});
				response.parentNode.insertBefore(holder, response);
			}
			comment.appendChild(response);
			this.dom('cancel-comment-reply-link').style.display = '';
			if (null != textarea && 'text' == textarea.name) {textarea.focus();}
			return false;
		},
		cancelReply : function () {
			var response = this.dom('<?php $this->respondId(); ?>'),
			holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');
			if (null != input) {input.parentNode.removeChild(input);}
			if (null == holder) {return true;}
			this.dom('cancel-comment-reply-link').style.display = 'none';
			holder.parentNode.insertBefore(response, holder);
			return false;
		}
	};
	//表情框按钮
	var QAQTab=new mdui.Tab('#QAQTab');
	mdui.JQ('#QAQ').on('open.mdui.dialog',function(){QAQTab.handleUpdate();});
	//表情框输入
	Smilies={
		dom: function(id) {return document.getElementById(id);},
		grin: function(tag){
			tag=' '+tag+' ';myField=this.dom('commenttextarea');
			document.selection?(myField.focus(),sel=document.selection.createRange(),sel.text=tag,myField.focus()):this.insertTag(tag);
		},
		insertTag: function(tag){
			myField=Smilies.dom('commenttextarea');
			myField.selectionStart || myField.selectionStart=='0'?(
				startPos=myField.selectionStart,endPos=myField.selectionEnd,cursorPos=startPos,
				myField.value=myField.value.substring(0,startPos)+tag+myField.value.substring(endPos,myField.value.length),
				cursorPos+=tag.length,myField.focus(),myField.selectionStart=cursorPos,myField.selectionEnd=cursorPos
			):(myField.value+=tag,myField.focus());
		}
	}
	//动态加载评论头像
	<?php if (!$this->user->hasLogin()){ ?>
	document.getElementById('avatarloading').style.display="inline-block";
	document.getElementById('emailavatar').style.display="none";
	$('#emailavatar').attr('src','https://cdn.v2ex.com/gravatar/'+md5($("input#mail").val())+'?s=100&r=&d=mystery');
	setTimeout(function(){
		document.getElementById('avatarloading').style.display="none";
		document.getElementById('emailavatar').style.display="inline";
	},750);
	$("input#mail").blur(function(){
		document.getElementById('avatarloading').style.display="inline-block";
		document.getElementById('emailavatar').style.display="none";
		$('#emailavatar').attr('src','https://cdn.v2ex.com/gravatar/'+md5($("input#mail").val())+'?s=100&r=&d=mystery');
		setTimeout(function(){
			document.getElementById('avatarloading').style.display="none";
			document.getElementById('emailavatar').style.display="inline";
		},750);
	});
	<?php } ?>
	//评论无限加载
	$('a.next').click(function(){
		$this=$(this);$this.hide();$("#commenet-load").show();
		var href=$this.attr('href');
		if (href!=undefined){
			$.ajax({
				url: href,
				type: 'get',
				error: function() {mdui.alert("评论加载出错了QAQ");},
				success: function(data){
					var $res=$(data).find('#allcomment');
					$("#allcomment").append($res);mdui.mutation();
					var newhref=$(data).find('a.next').attr('href');
					if (newhref!=undefined) {$('a.next').attr('href', newhref);}
					else {$('a.next').remove();}
				},
				complete: function() {$("#commenet-load").hide();$this.show();}
			});
		}
		return false;
	});
	//AJAX评论
	$('#comment-form').submit(function(){
		var form=$(this),params=form.serialize();
		params+='&themeAction=comment';
		var appendComment=function(comment){
			var html='<div id="comment-{coid}" class="mdui-panel" mdui-panel><div class="mdui-panel-item mdui-panel-item-open"><div class="mdui-panel-item-header"><div class="mdui-panel-item-title"><div class="comment-author mdui-chip mdui-hidden-xs-down"><img class="avatar mdui-chip-icon mdui-color-grey-200" src="{avatar}" alt="{author}" width="100" height="100" />\n<span class="fn mdui-chip-title">{authorurl}</span></div><div class="mdui-hidden-sm-up"><img class="avatar mdui-chip-icon mdui-color-grey-200" src="{avatar}" alt="{author}" width="100" height="100" /></div></div><div class="mdui-panel-item-summary"><span class="mdui-hidden-xs-down">{datetime}</span><span class="fn mdui-chip-title mdui-hidden-sm-up">{author}</span></div><i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></div><div class="comment-meta mdui-panel-item-body"><span class="mdui-typo-caption mdui-text-color-theme-accent mdui-hidden-sm-up">{datetime}<br></span>{content}<div class="mdui-chip">{ifauthor}</div><span class="comment-reply mdui-float-right"><a href="?replyTo={coid}#<?php $this->respondId(); ?>" onclick="return TypechoComment.reply(\'comment-{coid}\',{coid});" class="mdui-btn mdui-color-theme-accent mdui-ripple">回复</a></span>';
			var sidebarhtml='<a href="{permalink}" class="mdui-list-item mdui-ripple" mdui-tooltip="{content: \'{datetime}\', position: \'right\'}"><div class="mdui-list-item-content mdui-text-truncate">{text}</div><div class="mdui-text-color-blue-900">{author}</div></a>';
			$.each(comment,function(k,v){
				regExp=new RegExp('{'+k+'}','g');
				html=html.replace(regExp,v);
				sidebarhtml=sidebarhtml.replace(regExp,v);
			});
			var el=$('#allcomment .comment-list:first');
			if(comment.parent!=0){
				el=$('#comment-'+comment.parent);
				if (el.find('.haveat').length<1){
					el=$('#comment-'+comment.parent).find('.comment-meta');
					if (el.find('.comment-children').length<1){
						$('<div class="comment-children"><ol class="comment-list"></ol></div>').appendTo(el);
					} else if (el.find('.comment-children .comment-list').length<1){
						$('<ol class="comment-list"></ol>').appendTo(el.find('.comment-children'));
					}
				} else {
					if (el.find('.comment-children').length<1){
						$('<div class="comment-children"><ol class="comment-list"></ol></div>').appendTo(el);
					} else if(el.find('.comment-children .comment-list').length<1){
						$('<ol class="comment-list"></ol>').appendTo(el.find('.comment-children'));
					}
				}
				el=$('#comment-'+comment.parent).find('.comment-children .comment-list:first');
			} else {
				if ($('a.next').length) $('#allcomment .comment-list .comment-parent:last').remove();
				if (el.length<1){
					$('<ol class="comment-list"></ol>').appendTo($('#allcomment'));
					el=$('#allcomment .comment-list:first');
				} else {
					el=$('#allcomment .comment-list:first');
				}
			}
			$(html).prependTo(el);
			$(sidebarhtml).prependTo('#recentcomments');
			if ($('#recentcomments').find('.mdui-list-item').length>5)
				$('#recentcomments .mdui-list-item:last').remove();
		}
		$.ajax({
			url: '<?php $this->permalink();?>',
			type: 'POST',
			data: params,
			dataType: 'json',
			beforeSend: function() {mdui.snackbar({message:'正在提交评论QwQ',position:'right-bottom',timeout:'1000'});$('#commentsumbit').css('display','none');$('#commenting').css('display','block');},
			complete: function() {mdui.mutation();},
			success: function(result){
				$('#commenting').css('display','none');$('#commentsumbit').css('display','block');
				if (result.status==1){
					mdui.dialog({content:'评论成功啦ヾ(≧∇≦*)ゝ',onClose:function(){$('html,body').animate({scrollTop:$('#comment-'+result.comment.coid).offset().top},'fast');},cssClass:'mdui-dialog-alert',buttons:[{text:'ok'}]});
					appendComment(result.comment);
					var number=parseInt($('#commentsnumber').text())+1;
					$('#commentsnumber').text(number+" 条评论");
					form.find('textarea').val('');$('#cancel-comment-reply-link').click();
					hljs.initHighlighting.called = false;hljs.initHighlighting();
					MathJax.Hub.Typeset(document.getElementById('#comment-'+result.comment.coid));
					$('#comment-'+result.comment.coid).find('pre code').each(function(){
						var lines = $(this).text().split('\n').length;
						var $numbering = $('<ul/>').addClass('pre-numbering');
						for(i=1;i<=lines;i++) $numbering.append($('<li/>').text(i));
						$(this).addClass('has-numbering').parent().prepend($numbering);
					});
				} else {mdui.alert(undefined === result.msg ? '发生了未知错误Orz' : result.msg);}
			},
			error: function(xhr,ajaxOptions,thrownError) {mdui.alert('提交评论失败了QAQ');	}
		});
		return false;
	});
</script>