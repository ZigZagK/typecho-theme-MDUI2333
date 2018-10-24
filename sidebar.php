<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

</div><!--End Of Pjax Part-->

<div class="mdui-drawer mdui-drawer-close mdui-drawer-full-height mdui-color-white" id="sidebar">
	<div class="mdui-card">
		<a href="/admin" target="_blank"><div class="mdui-card-header">
			<img class="mdui-card-header-avatar" src="https://www.gravatar.com/avatar/<?php echo HashTheMail($this->options->logoMail) ?>?s=100&r=&d=mystery"/>
			<div class="mdui-card-header-title"><?php $this->options->title(); ?></div>
			<div class="mdui-card-header-subtitle"><?php $this->options->description(); ?></div>
		</div></a>
	</div>
	<div class="mdui-list" mdui-collapse="{accordion: true}">
		<a href="/" class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">home</i>
			<div class="mdui-list-item-content">首页</div>
		</a>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">inbox</i>
				<div class="mdui-list-item-content">归档</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list">
				<?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y年n月')->parse('
					<a href="{permalink}" class="mdui-list-item mdui-ripple">
						<div class="mdui-list-item-content">{date}</div>
						<div class="mdui-text-color-blue-900">{count}</div>
					</a>
				'); ?>
			</div>
		</div>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">star</i>
				<div class="mdui-list-item-content">热门文章</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list"><?php SidebarPopPosts(); ?></div>
		</div>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">comment</i>
				<div class="mdui-list-item-content">最新评论</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list">
				<?php $this->widget('Widget_Comments_Recent','pageSize=5')->parse('
				<a href="{permalink}" title="{text}" class="mdui-list-item mdui-ripple">
					<div class="mdui-list-item-content mdui-text-truncate">{text}</div>
					<div class="mdui-text-color-blue-900">{author}</div>
				</a>
				'); ?>
			</div>
		</div>
		<div class="mdui-divider"></div>
		<?php $this->widget('Widget_Metas_Category_List')->to($category);$last=-1; ?>
		<?php while ($category->next()): ?>
			<?php if ($category->levels==0){ ?>
				<?php if ($last!=-1){ ?>
			</div>
		</div>
				<?php } ?>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-amber">apps</i>
				<div class="mdui-list-item-content"><?php $category->name(); ?></div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
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
		<?php endwhile; ?>
			</div>
		</div>
		<div class="mdui-collapse-item">
			<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
				<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-amber">local_offer</i>
				<div class="mdui-list-item-content">标签云</div>
				<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
			</div>
			<div class="mdui-collapse-item-body mdui-list">
				<div id="MyTagCloud">
					<canvas width="300" height="300" id="TagCloud" style="width:100%">
						<p>Anything in here will be replaced on browsers that support the canvas element</p>
						<ul>
							<?php $this->widget('Widget_Metas_Tag_Cloud')->to($tag); ?>
							<?php while ($tag->next()): ?>
								<li><a href="<?php $tag->permalink(); ?>"><?php $tag->name(); ?></a></li>
							<?php endwhile; ?>
						</ul>
					</canvas>
				</div>
			</div>
		</div>
		<div class="mdui-divider"></div>
		<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
		<?php while ($pages->next()): ?>
		<a href="<?php $pages->permalink() ?>" class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-green">insert_drive_file</i>
			<div class="mdui-list-item-content"><?php $pages->title() ?></div>
		</a>
		<?php endwhile; ?>
		<div class="mdui-divider"></div>
		<div class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">library_books</i>
			<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
			<div class="mdui-list-item-content">文章总数</div>
			<div class="mdui-text-color-brown-900"><?php $stat->publishedPostsNum() ?></div>
		</div>
		<div class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">access_time</i>
			<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
			<div class="mdui-list-item-content">运行天数</div>
			<div class="mdui-text-color-brown-900"><script>var BirthDay=new Date("july 29,2018");var today=new Date();var timeold=(today.getTime()-BirthDay.getTime());var sectimeold=timeold/1000;var secondsold=Math.floor(sectimeold);var msPerDay=24*60*60*1000;var e_daysold=timeold/msPerDay;var daysold=Math.floor(e_daysold);document.write(""+daysold);</script></div>
		</div>
		<div class="mdui-list-item mdui-ripple">
			<i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-brown">remove_red_eye</i>
			<?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?>
			<div class="mdui-list-item-content">访问次数</div>
			<div class="mdui-text-color-brown-900"><?php echo TotalViews();?></div>
		</div>
	</div>
</div>