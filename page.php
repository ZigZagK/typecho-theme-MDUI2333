<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="mdui-container">
	<div class="mdui-row">
		<div class="mdui-col-md-10 mdui-col-offset-md-1">
			<div class="mdui-card mdui-m-y-3">
				<div class="mdui-card-media">
					<div style="background:url(<?php ShowThumbnail($this); ?>);height:300px;background-position:center center;background-size:cover"></div>
					<div class="mdui-card-media-covered">
						<div class="mdui-card-primary">
							<div class="mdui-card-primary-title"><?php $this->title() ?></div>
						</div>
					</div>
				</div>
				<div class="mdui-card-actions">
					<div class="mdui-chip">
						<?php post_gravatar($this->author,100,'identicon'); ?>
						<span class="mdui-chip-title"><a itemprop="name" href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span>
					</div>
					<div class="mdui-chip">
						<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">date_range</i></span>
						<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>"><?php $this->date(); ?></a></span>
					</div>
						<ul class="mdui-menu" id="posttag<?php echo $this->cid(); ?>">
							<li class="mdui-menu-item mdui-ripple"><?php $this->tags('<li class="mdui-menu-item mdui-ripple">',true,''); ?></li>
						</ul>
						<div class="mdui-chip">
							<span class="mdui-chip-icon mdui-color-theme-accent"><i class="mdui-icon material-icons">comment</i></span>
							<span class="mdui-chip-title"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 条评论', '1 条评论', '%d 条评论'); ?></a></span>
						</div>
					<?php if ($this->user->hasLogin()):?>
						<a href="<?php $this->options->adminUrl(); ?>write-page.php?cid=<?php echo $this->cid;?>" target="_blank" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple mdui-float-right mdui-hidden-sm-down" mdui-tooltip="{content: '编辑该页面', position: 'right'}"><i class="mdui-icon material-icons">edit</i></a>
					<?php endif;?>
					<div class="mdui-divider mdui-m-t-1"></div>
					<div class="mdui-typo mdui-p-y-2" id="post-container" style="padding-left:4%;padding-right:4%;">
		  				<?php $this->content(); ?>
					</div>
					<div class="mdui-divider"></div>
					<?php include('comments.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var tab=document.getElementById("post-container").getElementsByTagName('table');var len=tab.length;
	for (var i=0;i<len;i++) tab[i].classList.add("mdui-table");
	for (var i=0;i<len;i++) tab[i].classList.add("mdui-table-hoverable");
	(function () {
		window.TypechoComment = {
			dom : function (id) {return document.getElementById(id);},
			create : function (tag, attr) {
				var el = document.createElement(tag);			
				for (var key in attr) {el.setAttribute(key, attr[key]);}
				return el;
			},
			reply : function (cid, coid) {
				var comment = this.dom(cid), parent = comment.parentNode,
					response = this.dom('<?php $this->respondId(); ?>'), input = this.dom('comment-parent'),
					form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
					textarea = response.getElementsByTagName('textarea')[0];
				if (null == input) {
					input = this.create('input', {
						'type' : 'hidden',
						'name' : 'parent',
						'id'   : 'comment-parent'
					});
					form.appendChild(input);
				}
				input.setAttribute('value', coid);
				if (null == this.dom('comment-form-place-holder')) {
					var holder = this.create('div', {
						'id' : 'comment-form-place-holder'
					});
					response.parentNode.insertBefore(holder, response);
				}
				comment.appendChild(response);
				this.dom('cancel-comment-reply-link').style.display = '';
				if (null != textarea && 'text' == textarea.name) {textarea.focus();}
				return false;
			},
			cancelReply : function () {
				var response = this.dom('<?php $this->respondId(); ?>'),
				holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');
				if (null != input) {input.parentNode.removeChild(input);}
				if (null == holder) {return true;}
				this.dom('cancel-comment-reply-link').style.display = 'none';
				holder.parentNode.insertBefore(response, holder);
				return false;
			}
		};
	})();
</script>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>