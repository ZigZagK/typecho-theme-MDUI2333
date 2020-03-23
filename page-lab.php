<?php
/**
 * 实验室页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
function randomcolor(){
    $color[0]='blue';$color[1]='orange';$color[2]='green';$color[3]='pink';$color[4]='red';
	return $color[mt_rand(0,count($color)-1)];
}
function getinfo($str){
	$data=explode('[zIgZaGk%]',$str);
	return array('name'=>$data[0],'url'=>$data[1],'image'=>$data[2],'description'=>$data[3],'sort'=>$data[4],'user'=>$data[5]);
}
if (class_exists("Links_Plugin")) {$labs=Links_Plugin::output('{name}[zIgZaGk%]{url}[zIgZaGk%]{image}[zIgZaGk%]{description}[zIgZaGk%]{sort}[zIgZaGk%]{user}',0,'page-lab');$tot=count($labs);}
?>
<style>
	.lib-thumbnail {height:150px;background-position:center center!important;background-size:cover!important;}
	.mdui-card-media-covered .mdui-card-primary-subtitle {opacity:1!important;}
</style>
<div class="mdui-container">
	<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4 mdui-row-xl-4 mdui-m-y-2">
		<?php for ($i=0;$i<$tot;$i++){$lab=getinfo($labs[$i]);$color=randomcolor();$noimg=strpos($lab['image'],'nopic.jpg'); ?>
		<div class="mdui-col mdui-m-y-2">
			<div class="mdui-card">
				<div class="mdui-card-media">
					<div class="mdui-color-<?php echo $color; ?> lib-thumbnail"<?php if ($noimg===FALSE){ ?> style="background-image:url(<?php echo $lab['image']; ?>);<?php } ?>"></div>
						<div class="mdui-card-media-covered mdui-card-media-covered-top<?php if ($noimg!==FALSE){ ?> mdui-card-media-covered-transparent<?php } ?>">
						<div class="mdui-card-primary">
							<div class="mdui-card-primary-title"><?php echo $lab['name']; ?></div>
							<div class="mdui-card-primary-subtitle"><?php echo $lab['description']; ?></div>
						</div>
					</div>
					<div class="mdui-card-actions">
						<div class="mdui-chip mdui-float-left">
							<span class="mdui-chip-icon mdui-color-<?php echo $color; ?>"><i class="mdui-icon material-icons">&#xe8df;</i></span>
							<span class="mdui-chip-title"><?php echo $lab['user']; ?></span>
						</div>
						<a href="<?php echo $lab['url']; ?>" target="_blank" rel="external nofollow" class="mdui-color-<?php echo $color; ?> mdui-text-color-white mdui-btn mdui-ripple mdui-float-right">传送门</a>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>