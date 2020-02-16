<style>
	/*index.php*/
	::selection {background:#b3d4fc;text-shadow:none;}
	a {color:unset;text-decoration:unset;}
	body {background:<?php if ($this->options->backgroundPic) echo 'url('.$this->options->backgroundPic.')'; else echo '#b3d4fc'; ?>;background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;display:flex;flex-flow:column;min-height:calc(100vh - 56px);}
	@media (min-width:600px) {body {min-height:calc(100vh - 64px);}}
	@media (orientation:landscape) and (max-width:959px) {body {min-height:calc(100vh - 48px);}}
	#pjax-overlay {position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:2000;background:rgb(0,0,0,0.8);}
	#pjax-progress {top:calc(50% - 33px);display:block;height:66px;width:300px;z-index:9999;}
	#pjax-container {flex:1;}
	.pre-numbering {float:left!important;font-size:14px!important;padding:10px!important;margin:0!important;border-right:1px solid #C3CCD0!important;background:#EEE!important;text-align:right!important;color:#666!important;list-style:none!important;line-height:1.6!important;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}
	pre {padding:0!important;background:#f7f7f7!important;}
	pre code {padding:10px!important;background:#f7f7f7!important;display:block;white-space:pre;overflow-x:auto;}
	code {font-size:14px!important;line-height:1.6!important;}
	.thumbnail {height:300px;background-position:center center!important;background-size:cover!important;}
	.ins-search.show .ins-search-overlay {z-index:19260817!important;}
	.ins-search-container {z-index:19260817!important;}
	.ins-section-wrapper::-webkit-scrollbar {background:#fff!important;}
	/*comments.php*/
	div#comments ol.comment-list {padding:0!important;}
	div#comments .mdui-panel-item p img {max-height:400px;}
	div.cancel-comment-reply a:hover:before,div.cancel-comment-reply a:focus:before {display:none!important;}
	#QAQ {height:75%!important;max-height:400px!important;}
	#QAQ .mdui-dialog-content {height:calc(100% - 100px)!important;}
	#QAQ a {color:unset!important;}
	#QAQ a:hover:before,#QAQ a:focus:before {display:none!important;}
	#QAQ .mdui-dialog-content .QAQPicture .mdui-btn {min-width:unset;padding:5px;height:unset;margin-bottom:-13px;}
	div.page-navigator div {display:inline-block;margin:2px 1%;border-radius:4px;width:30px;height:30px;line-height:30px;background:<?php echo ThemeAccent(); ?>;}
	div.page-navigator div a,div.page-navigator div span{color:#fff!important;}
	div.page-navigator div a:hover:before,div.page-navigator div a:focus:before {display:none!important;}
	div.page-navigator div.next a,div.page-navigator div.prev a {line-height:28px!important;}
	div.page-navigator div.current {background:<?php echo ThemePrimary(); ?>;}
	/*post.php & page.php*/
	a.Fancybox:hover:before,a.Fancybox:focus:before {display:none!important;}
	@media (min-width:600px) {#post-tocbtn {top:80px!important;}}
	@media (orientation:landscape) and (max-width:959px) {#post-tocbtn {top:64px!important;}}
	#post-toc {width:unset!important;min-width:160px!important;}
	#post-toc ul {padding:0;margin:0;list-style:none;}
	#post-toc .index-subItem-box {display:none;}
	#post-toc .index-item,#post-toc .index-link {width:100%;display:block;color:#333333;text-decoration:none;box-sizing:border-box;}
	#post-toc .index-link {padding:4px 8px 4px 12px;cursor:pointer;-webkit-transition:background-color 0.3s,border-left-color 0.3s;-moz-transition:background-color 0.3s,border-left-color 0.3s;-o-transition:background-color 0.3s,border-left-color 0.3s;transition:background-color 0.3s,border-left-color 0.3s;border-left:3px solid transparent;word-break:break-all;}
	#post-toc .index-item.current > .index-link {background-color:rgba(0,0,0,0.1);border-left:3px solid <?php echo ThemeAccent(); ?>;}
	#post-toc .index-link:hover {background-color:rgba(0,0,0,0.1);}
	#post-toc .index-subItem-box .index-item {padding-left:1em;}
	#tag-container a {display:inline-block;}
	/*footer.php*/
	.footerlink {font-size:24px!important;}
</style>