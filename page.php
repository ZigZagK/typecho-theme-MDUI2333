<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-card mdui-m-y-3">
				<div class="mdui-card-media">
					<div class="thumbnail" style="background:url(<?php ShowThumbnail($this); ?>);"></div>
					<div class="mdui-card-media-covered">
						<div class="mdui-card-primary">
							<div class="mdui-card-primary-title"><?php $this->title() ?></div>
						</div>
					</div>
				</div>
				<div class="mdui-card-actions">
					<div class="mdui-chip">
						<img class="mdui-chip-icon mdui-color-grey-200" src="<?php echo GravatarURL($this->author->mail,100); ?>" />
						<span class="mdui-chip-title"><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
					</div>
					<div class="mdui-chip">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe916;</i></span>
						<span class="mdui-chip-title"><a href="<?php $this->permalink(); ?>"><?php $this->date(); ?></a></span>
					</div>
					<div class="mdui-chip" id="commentsnumber">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">&#xe0b9;</i></span>
						<span class="mdui-chip-title"><a href="<?php $this->permalink(); ?>#comments"><?php $this->commentsNum('0 条评论', '1 条评论', '%d 条评论'); ?></a></span>
					</div>
					<?php if ($this->user->hasLogin()){ ?>
						<a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid; ?>" target="_blank" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right mdui-hidden-sm-down" mdui-tooltip="{content:'编辑该页面',position:'right'}"><i class="mdui-icon material-icons">&#xe3c9;</i></a>
					<?php } ?>
				</div>
				<div class="mdui-divider"></div>
				<div class="mdui-card-content post-container" style="padding-left:4%;padding-right:4%;">
					<div class="mdui-typo">
		  				<?php echo RewriteContent($this->content); ?>
					</div>
				</div>
				<div class="mdui-divider"></div>
				<?php $this->need('comments.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>