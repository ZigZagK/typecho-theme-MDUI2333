<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-xs-10 mdui-col-offset-xs-1">
			<?php $total=0; ?>
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
						<div class="mdui-chip">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">apps</i></span>
							<span class="mdui-chip-title"><?php $this->category(','); ?></span>
						</div>
						<div class="mdui-chip" mdui-menu="{target:'#posttag<?php echo $this->cid(); ?>',position:'top'}">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">local_offer</i></span>
							<span class="mdui-chip-title">查看标签</span>
						</div>
						<ul class="mdui-menu" id="posttag<?php echo $this->cid(); ?>">
							<li class="mdui-menu-item mdui-ripple"><?php $this->tags('<li class="mdui-menu-item mdui-ripple">',true,''); ?></li>
						</ul>
						<div class="mdui-chip">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">comment</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 条评论', '1 条评论', '%d 条评论'); ?></a></span>
						</div>
						<div class="mdui-chip">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">remove_red_eye</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>"><?php echo getPostViews($this); ?> 次访问</a></span>
						</div>
						<a href="<?php $this->permalink() ?>" class="mdui-btn mdui-ripple mdui-color-theme-accent mdui-float-right">阅读全文</a>
					</div>
				</div>
				<?php $total++; ?>
			<?php endwhile; ?>
			<?php if ($total){ ?>
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
			<?php } else { ?>
			<div class="mdui-typo mdui-card mdui-hoverable mdui-m-y-3">
				<div class="mdui-card-primary">
					<div class="mdui-card-primary-title">你啥也没搜索到</div>
					<div class="mdui-card-primary-subtitle">看来我做的题还是太少了Orz</div>
				</div>
				<div class="mdui-card-content">
					<p>要不重新搜索试试？</p>
					<blockquote>
						<p>早期的搜索引擎是把因特网中的资源服务器的地址收集起来，由其提供的资源的类型不同而分成不同的目录，再一层层地进行分类。人们要找自己想要的信息可按他们的分类一层层进入，就能最后到达目的地，找到自己想要的信息。这其实是最原始的方式，只适用于因特网信息并不多的时候。随着因特网信息按几何式增长，出现了真正意义上的搜索引擎，这些搜索引擎知道网站上每一页的开始，随后搜索因特网上的所有超级链接，把代表超级链接的所有词汇放入一个数据库。这就是现在搜索引擎的原型。</p>
						<p>……</p>
						<p>在百度、Google、雅虎等主流搜索引擎愈发发展成熟以外，各类不同的搜索大全也在今日的互联网逐渐兴起。搜索大全即为集各种不同类型搜索引擎，涵盖多语言于一身的搜索集合。该类搜索引擎大全的兴起，让搜索变得更加简单。几乎所有的内容都能在“一页之间”完成。比如风靡一时的百google度，谷姐，比如新近出来的sou1sou等，就是将其它的搜索引擎的结果集合在一块。</p>
						<footer>百度百科 —— 搜索（互联网技术）</footer>
					</blockquote>
					<del>在搜索页面划水也是不错的体验呢QwQ。</del>
				</div>
				<div class="mdui-card-actions">
					<a href="/" class="mdui-btn mdui-ripple mdui-color-theme-accent">返回首页</a>
					<button class="mdui-btn mdui-ripple mdui-color-theme-accent" mdui-tooltip="{content:'侧边栏的分类和标签也可以帮助你查找文章<del>（点我什么都不会发生）</del>',position:'top'}">帮助</button>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>