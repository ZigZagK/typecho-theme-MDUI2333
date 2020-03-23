<?php
/**
 * 友情链接页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
function getinfo($str){
	$data=explode('[zIgZaGk%]',$str);
	return array('name'=>$data[0],'url'=>$data[1],'image'=>$data[2],'description'=>$data[3],'sort'=>$data[4],'user'=>$data[5]);
}
if (class_exists("Links_Plugin")){
	$Links=Links_Plugin::output('{name}[zIgZaGk%]{url}[zIgZaGk%]{image}[zIgZaGk%]{description}[zIgZaGk%]{sort}[zIgZaGk%]{user}');
	$tot=count($Links);if ($this->options->linksmode=='rand') shuffle($Links);
}
?>
<div class="mdui-container">
	<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4 mdui-row-xl-4 mdui-m-y-2">
		<?php for ($i=0;$i<$tot;$i++){$link=getinfo($Links[$i]);if ($link['sort']!='page-lab'){ ?>
		<div class="mdui-col">
			<div class="mdui-card mdui-m-y-1 mdui-hoverable">
				<a href="<?php echo $link['url']; ?>" target="_blank" rel="external nofollow">
					<div class="mdui-card-header">
						<img class="mdui-card-header-avatar" src="<?php echo $link['image']; ?>" alt="<?php echo $link['name']; ?>"/>
						<div class="mdui-card-header-title"><?php echo $link['name']; ?></div>
						<div class="mdui-card-header-subtitle"><?php echo $link['description']; ?></div>
					</div>
				</a>
			</div>
		</div>
		<?php }} ?>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>