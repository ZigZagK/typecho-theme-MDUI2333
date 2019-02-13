<?php
/**
 * 友情链接页面
 *
 * @package custom
 */
$this->need('header.php'); ?>

<div class="mdui-container">
	<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4 mdui-m-y-2">
		<?php if (class_exists("Links_Plugin")): ?>
			<?php Links_Plugin::output('
			<div class="mdui-col">
				<div class="mdui-card mdui-m-y-1 mdui-hoverable">
					<a href="{url}" target="_blank">
						<div class="mdui-card-header">
							<img class="mdui-card-header-avatar" src="{image}" alt="{name}"/>
							<div class="mdui-card-header-title">{name}</div>
							<div class="mdui-card-header-subtitle">{description}</div>
						</div>
					</a>
				</div>
			</div>
			'); ?>
		<?php endif; ?>
	</div>
</div>

<?php include('sidebar.php'); ?>
<?php include('footer.php'); ?>