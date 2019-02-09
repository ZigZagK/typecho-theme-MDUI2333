<?php
/**
 * 标签云页面
 *
 * @package custom
 */
$this->need('header.php'); ?>

<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-card mdui-m-y-3">
				<div class="mdui-card-primary mdui-text-center">
					<div class="mdui-card-primary-title">标签云</div>
					<?php $this->widget('Widget_Metas_Tag_Cloud','sort=name&ignoreZeroCount=1&desc=0')->to($tag);$total=0; ?>
					<?php while ($tag->next()): ?><?php $total++; ?><?php endwhile; ?>
					<div class="mdui-card-primary-subtitle">共计<?php echo $total; ?>个标签</div>
				</div>
				<div class="mdui-card-content" id="tag-container">
				<?php while ($tag->next()): ?>
					<a href="<?php $tag->permalink(); ?>" class="mdui-hoverable mdui-p-a-1 tag-<?php $tag->split(5,10,20,30,50); ?>"><?php $tag->name(); ?></a>
				<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#tag-container .tag-5 {font-size:1em;color:#555;}
#tag-container .tag-10 {font-size:1.3em;color:#444;}
#tag-container .tag-20 {font-size:1.6em;color:#333;}
#tag-container .tag-30 {font-size:1.9em;color:#222;}
#tag-container .tag-50 {font-size:2.2em;color:#111;}
#tag-container .tag-0 {font-size:2.5em;color:#000;}
#tag-container a {display:inline-block;}
</style>

<?php include('sidebar.php'); ?>
<?php include('footer.php'); ?>