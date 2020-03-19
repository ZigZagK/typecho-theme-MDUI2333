<?php
/**
 * 追番页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
define('siteUrl',$this->options->siteUrl);define('salt',$this->options->apisalt);
function listapi($uid) {echo siteUrl.'?'.http_build_query(array('type'=>'bilibili','opt'=>'list','uid'=>$uid,'auth'=>md5($uid.salt.$uid)));}
function coverapi($url) {echo siteUrl.'?'.http_build_query(array('type'=>'bilibili','opt'=>'cover','url'=>$url,'auth'=>md5($url.salt.$url)));}
?>
<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
		</div>
	</div>
</div>
<script>
    $.ajax({
        url:'<?php listapi($this->text); ?>',
        success:function(data){
            mdui.snackbar({message:'hahah'});
        }
    });
</script>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>