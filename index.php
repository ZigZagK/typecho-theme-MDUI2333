<?php
/**
 * 基于 <a target="_blank" href="https://www.mdui.org/">MDUI</a> 的Typecho主题 <del>名字是乱取的</del>
 * 
 * @package MDUI2333
 * @author ZigZagK
 * @version 1.1
 * @link https://zigzagk.top
 */
	if (!defined('__TYPECHO_ROOT_DIR__')) exit;
	$this->need('header.php');
?>

<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<?php while($this->next()): ?>
				<div class="mdui-card mdui-hoverable mdui-m-y-3">
					<a href="<?php $this->permalink() ?>">
						<div class="mdui-card-media">
							<div style="background:url(<?php ShowThumbnail($this); ?>);height:300px;background-position:center center;background-size:cover"></div>
							<div class="mdui-card-media-covered">
								<div class="mdui-card-primary">
									<div class="mdui-card-primary-title"><?php $this->title() ?></div>
								</div>
							</div>
						</div>
					</a>
					<div class="mdui-card-content"><?php $this->excerpt(100, '...'); ?></div>
					<div class="mdui-divider"></div>
					<div class="mdui-card-actions">
						<div class="mdui-chip">
							<?php post_gravatar($this->author,100,'identicon'); ?>
							<span class="mdui-chip-title"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
						</div>
						<div class="mdui-chip">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">date_range</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>"><?php $this->date(); ?></a></span>
						</div>
						<div class="mdui-chip mdui-hidden-sm-down">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">apps</i></span>
							<span class="mdui-chip-title"><?php $this->category(','); ?></span>
						</div>
						<div class="mdui-chip mdui-hidden-sm-down" mdui-menu="{target:'#posttag<?php echo $this->cid(); ?>',position:'top'}">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">local_offer</i></span>
							<span class="mdui-chip-title">查看标签</span>
						</div>
						<ul class="mdui-menu mdui-hidden-sm-down" id="posttag<?php echo $this->cid(); ?>">
							<li class="mdui-menu-item mdui-ripple"><?php $this->tags('<li class="mdui-menu-item mdui-ripple">',true,''); ?></li>
						</ul>
						<div class="mdui-chip mdui-hidden-sm-down">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">comment</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 条评论', '1 条评论', '%d 条评论'); ?></a></span>
						</div>
						<div class="mdui-chip mdui-hidden-sm-down">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">remove_red_eye</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>"><?php echo getPostViews($this); ?> 次访问</a></span>
						</div>
						<a href="<?php $this->permalink() ?>" class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-float-right">阅读全文</a>
					</div>
				</div>
			<?php endwhile; ?>
			<div class="mdui-color-white mdui-p-a-1 mdui-m-y-3 mdui-text-center">
				<div class="mdui-float-left">
				<?php if ($this->_currentPage>1){ ?>
					<?php $this->pageLink('<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">上一页</button>'); ?>
				<?php } else { ?>
					<a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" disabled>上一页</a>
				<?php } ?>
				</div>
				<a class="mdui-btn mdui-ripple mdui-color-theme"><?php echo $this->_currentPage;?>/<?php echo ceil($this->getTotal()/$this->parameter->pageSize);?></a>
				<div class="mdui-float-right">
				<?php if ($this->_currentPage<ceil($this->getTotal()/$this->parameter->pageSize)){ ?>
					<?php $this->pageLink('<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent">下一页</button>','next'); ?>
				<?php } else { ?>
					<a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" disabled>下一页</a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>