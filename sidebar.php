<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>
<div class="mdui-drawer mdui-drawer-close mdui-drawer-full-height mdui-color-white" id="sidebar">
	<div class="mdui-card">
		<div class="mdui-card-header">
			<img class="mdui-card-header-avatar" src="<?php if ($this->options->logourl) echo $this->options->logourl; else echo GravatarURL('',100); ?>" />
			<div class="mdui-card-header-title"><?php $this->options->title(); ?></div>
			<div class="mdui-card-header-subtitle"><?php $this->options->description(); ?></div>
		</div>
	</div>
	<?php if ($this->options->ExSearch=='false'){ ?>
	<form class="mdui-textfield mdui-hidden-sm-up" style="width:90%;margin-left:auto;margin-right:auto;" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
		<input type="text" name="s" class="mdui-textfield-input" type="text" placeholder="输入关键字搜索"/>
	</form>
	<?php } ?>
	<div class="mdui-list" mdui-collapse="{accordion:true}">
		<a href="/" class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe88a;</i>
			<div class="mdui-list-item-content">首页</div>
		</a>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe149;</i>
				<div class="mdui-list-item-content">归档</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list">
				<?php $this->widget('Widget_Contents_Post_Date','type=month&format=Y年n月')->parse('
				<a href="{permalink}" class="mdui-list-item mdui-ripple">
					<div class="mdui-list-item-content">{date}</div>
					<div class="mdui-text-color-blue-900">{count}</div>
				</a>'); ?>
			</div>
		</div>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">&#xe0b9;</i>
				<div class="mdui-list-item-content">最新评论</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list" id="recentcomment">
				<?php $this->widget('Widget_Comments_Recent@sidebar','pageSize=5&ignoreAuthor=true')->to($comment); ?>
				<?php while($comment->next()){ ?>
				<a href="<?php $comment->permalink(); ?>" class="mdui-list-item mdui-ripple" mdui-tooltip="{content:'<?php $comment->date(); ?>',position:'right'}">
					<div class="mdui-chip mdui-text-center" style="width:100%;">
						<span style="float:left;"><img class="mdui-chip-icon mdui-color-grey-200" src="<?php echo GravatarURL($comment->mail,100); ?>" /></span>
						<span class="mdui-chip-title"><?php echo $comment->author; ?></span>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
		<div class="mdui-divider"></div>
		<?php $this->widget('Widget_Metas_Category_List')->to($category);$last=-1; ?>
		<?php while ($category->next()){ ?>
			<?php if ($category->levels==0){ ?>
				<?php if ($last!=-1){ ?>
			</div>
		</div>
				<?php } ?>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-amber">&#xe5c3;</i>
				<div class="mdui-list-item-content"><?php $category->name(); ?></div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">&#xe313;</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list">
					<a href="<?php $category->permalink(); ?>" class="mdui-list-item mdui-ripple">
						<div class="mdui-list-item-content mdui-text-color-amber-900"><?php $category->name(); ?></div>
						<div class="mdui-text-color-amber-900"><?php echo CountCateOrTag($category->mid); ?></div>
					</a>
			<?php } else { ?>
					<a href="<?php $category->permalink(); ?>" class="mdui-list-item mdui-ripple">
						<div class="mdui-list-item-content"><?php $category->name(); ?></div>
						<div class="mdui-text-color-amber-900"><?php echo CountCateOrTag($category->mid); ?></div>
					</a>
			<?php } ?>
			<?php $last=$category->levels; ?>
		<?php } ?>
			</div>
		</div>
		<?php $this->widget('Widget_Contents_Page_List')->to($tagcloud); ?>
		<?php while ($tagcloud->next()){ ?>
			<?php if ($tagcloud->template=='page-tags.php'){ ?>
		<a href="<?php $tagcloud->permalink(); ?>" class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-amber">&#xe54e;</i>
			<div class="mdui-list-item-content"><?php $tagcloud->title(); ?></div>
		</a>
			<?php } ?>
		<?php } ?>
		<div class="mdui-divider"></div>
		<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
		<?php while ($pages->next()){ ?>
			<?php if ($pages->template!='page-tags.php'){$fields=unserialize($pages->fields); ?>
		<a href="<?php $pages->permalink(); ?>" class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-green"><?php echo empty($fields['description'])?'&#xe24d;':$fields['description']; ?></i>
			<div class="mdui-list-item-content"><?php $pages->title(); ?></div>
		</a>
			<?php } ?>
		<?php } ?>
		<div class="mdui-divider"></div>
		<div class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">&#xe02f;</i>
			<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
			<div class="mdui-list-item-content">文章总数</div>
			<div class="mdui-text-color-brown-900"><?php $stat->publishedPostsNum(); ?></div>
		</div>
		<?php if ($this->options->birthday){ ?>
		<div class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">&#xe192;</i>
			<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
			<div class="mdui-list-item-content">运行天数</div>
			<div class="mdui-text-color-brown-900"><?php echo ceil((time()-strtotime($this->options->birthday))/86400); ?></div>
		</div>
		<?php } ?>
	</div>
</div>