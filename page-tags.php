<?php
/**
 * 标签云页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>
<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-card mdui-m-y-3">
				<div class="mdui-card-primary mdui-text-center">
					<div class="mdui-card-primary-title">标签云</div>
					<?php $this->widget('Widget_Metas_Tag_Cloud','sort=name&ignoreZeroCount=1&desc=0')->to($tag);$total=0;$max=0; ?>
					<?php while ($tag->next()) {$total++;if ($tag->count>$max) $max=$tag->count;} ?>
					<div class="mdui-card-primary-subtitle">共计<?php echo $total; ?>个标签</div>
				</div>
				<div class="mdui-card-content" id="tag-container">
				<?php while ($tag->next()){ ?>
					<a href="<?php $tag->permalink(); ?>" class="mdui-hoverable mdui-p-a-1" style="font-size:<?php echo round($tag->count/$max*1+1,2); ?>em;color:#<?php $color=sprintf('%02s',base_convert(round(119-85*$tag->count/$max),10,16));echo $color.$color.$color; ?>"><?php $tag->name(); ?></a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>