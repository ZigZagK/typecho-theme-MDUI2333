<script>
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
	$('.haveat a').click(function(){if (location.hostname==this.hostname && location.pathname==this.pathname){var target=$(this.hash);if (target.length) {$('html,body').animate({scrollTop:target.offset().top},'fast');return false;}}});
	var QAQTab=new mdui.Tab('#QAQTab');
	$('#QAQ').on('open.mdui.dialog',function(){QAQTab.handleUpdate();});
	var Smilies={
		dom:function(id) {return document.getElementById(id);},
		grin:function(tag){
			tag=' '+tag+' ';myField=this.dom('commenttextarea');
			document.selection?(myField.focus(),sel=document.selection.createRange(),sel.text=tag,myField.focus()):this.insertTag(tag);
		},
		insertTag:function(tag){
			myField=Smilies.dom('commenttextarea');
			myField.selectionStart || myField.selectionStart=='0'?(
				startPos=myField.selectionStart,endPos=myField.selectionEnd,cursorPos=startPos,
				myField.value=myField.value.substring(0,startPos)+tag+myField.value.substring(endPos,myField.value.length),
				cursorPos+=tag.length,myField.focus(),myField.selectionStart=cursorPos,myField.selectionEnd=cursorPos
			):(myField.value+=tag,myField.focus());
		}
	}
	<?php if (!$this->user->hasLogin()){ ?>
	$('#emailavatar').attr('src','<?php echo $this->options->gravatarurl; ?>'+md5($("input#mail").val())+'?s=100&d=mystery');
	$('input#mail').blur(function(){$('#emailavatar').attr('src','<?php echo $this->options->gravatarurl; ?>'+md5($("input#mail").val())+'?s=100&d=mystery');});
	$('input[name="receiveMail"]').change(function(){
		var status=$('input[name="receiveMail"]').is(':checked');
		if (!status) {$('#receiveMailicon').html('&#xe7f6;');$('#receiveMailicon').addClass('mdui-text-color-grey');$('#receiveMailicon').removeClass('mdui-text-color-theme-accent');}
		else {$('#receiveMailicon').html('&#xe7f7;');$('#receiveMailicon').addClass('mdui-text-color-theme-accent');$('#receiveMailicon').addClass('mdui-text-color-grey');}
	});
	<?php } ?>
	$('#comment-form').submit(function(event){
		var commentdata=$(this).serializeArray();
		$.ajax({
			url:$(this).attr('action'),
			type:$(this).attr('method'),
			data:commentdata,
			beforeSend:function() {$('#commentsumbit').css('display','none');$('#commenting').css('display','block');},
			error:function() {mdui.alert('发生了未知错误','评论失败');$('#commenting').css('display','none');$('#commentsumbit').css('display','block');},
			success:function(data){
				$('#commenting').css('display','none');$('#commentsumbit').css('display','block');
				var error=/<title>Error<\/title>/;
				if (error.test(data)){
					var text=data.match(/<div(.*?)>(.*?)<\/div>/is);
					var str='发生了未知错误';if (text!=null) str=text[2];
					mdui.alert(str,'评论失败');
				} else {
					$('#commenttextarea').val('');$('#commenttextarea').css('height','');
					if ($('#cancel-comment-reply-link').css('display')!='none') $('#cancel-comment-reply-link').click();
					var target='#comments',parent=true;
					$.each(commentdata,function(i,field) {if (field.name=='parent') parent=false;});
					if (!parent || !$('div.page-navigator .prev').length){
						var latest=-19260817;
						$('#comments .mdui-panel',data).each(function(){
							var id=$(this).attr('id'),coid=parseInt(id.substring(8));
							if (coid>latest) {latest=coid;target='#'+id;}
						});
					}
					$('#recentcomment').html($('#recentcomment',data).html());
					$('#commentsnumber').html($('#commentsnumber',data).html());
					$('#commentcontent').html($('#commentcontent',data).html());
					MathJax.Hub.Typeset(document.getElementById('commentcontent'));
					document.querySelectorAll('#commentcontent pre code').forEach((block) => {<?php if ($this->options->highlightmode=='highlightjs'){ ?>hljs.highlightBlock(block);<?php } else { ?>Prism.highlightElement(block);<?php } ?>});
					$('#commentcontent pre code').each(function(){
						var lines=$(this).text().split('\n').length;
						var numbering=$('<ul/>').addClass('pre-numbering');
						for(var i=1;i<=lines;i++) numbering.append($('<li/>').text(i));
						$(this).addClass('has-numbering').parent().prepend(numbering);
					});
					mdui.mutation();$('html,body').animate({scrollTop:$(target).offset().top},'fast');
					mdui.snackbar({message:'<?php echo $this->options->commentsuccess; ?>',position:'right-bottom'});
					$('.haveat a').click(function(){if (location.hostname==this.hostname && location.pathname==this.pathname){var target=$(this.hash);if (target.length) {$('html,body').animate({scrollTop:target.offset().top},'fast');return false;}}});
				}
			}
		});
		return false;
	});
</script>