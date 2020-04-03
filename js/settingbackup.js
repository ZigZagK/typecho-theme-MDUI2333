function checkupdate(version){
	$.ajax({
		url:"https://api.zigzagk.top/MDUI2333info/?version="+version,
		success:function(data){
			$("#infolatest").html(data.latest);
			$("#infotext").html(data.text);
		},
		error:function(){
			$("#infolatest").html(" 出错了QAQ ");$("#infotext").html(" 出错了QAQ ");
		}
	});
}
function settingbackup(apiurl){
	var data=new Array();
	$('.typecho-option').each(function(){
		var input=$(this).find('input');
		if(input.length){
			var info={'name':input.attr('name'),'type':'input','content':input.val()};
			data.push(info);
		}
		var textarea=$(this).find('textarea');
		if(textarea.length){
			var info={'name':textarea.attr('name'),'type':'textarea','content':textarea.val()};
			data.push(info);
		}
		var select=$(this).find('select');
		if(select.length){
			var info={'name':select.attr('name'),'type':'select','content':select.find('option[selected="true"]').attr('value')};
			data.push(info);
		}
	});
	$.ajax({
		type:'POST',
		url:apiurl,
		data:{'data':JSON.stringify(data)},
		success:function(){
			mdui.snackbar({message:'外观设置备份成功',position:'right-top',onOpen:function(){$('.mdui-snackbar').css('background-color','#2196F3')}});
		},
		error:function(){
			mdui.snackbar({message:'备份失败，请检查网络',position:'right-top',onOpen:function(){$('.mdui-snackbar').css('background-color','#F44336')}});
		}
	});
}
function restorebackup(apiurl){
	$.ajax({
		url:apiurl,
		success:function(json){
			if(json.msg=='Success'){
				var data=JSON.parse(json.data);var n=data.length;
				for(var i=0;i<n;i++){
					if(data[i].type=='input') $('input[name="'+data[i].name+'"]').val(data[i].content);
					if(data[i].type=='textarea') $('textarea[name="'+data[i].name+'"]').val(data[i].content);
					if(data[i].type=='select') $('select[name="'+data[i].name+'"]').val(data[i].content);
				}
				mdui.snackbar({message:'恢复备份成功，请保存设置使设置生效',position:'right-top',onOpen:function(){$('.mdui-snackbar').css('background-color','#2196F3')}});
			} else mdui.snackbar({message:'恢复数据失败，备份不存在',position:'right-top',onOpen:function(){$('.mdui-snackbar').css('background-color','#F44336')}});
		},
		error:function(){
			mdui.snackbar({message:'恢复数据失败，请检查网络',position:'right-top',onOpen:function(){$('.mdui-snackbar').css('background-color','#F44336')}});
		}
	});
}