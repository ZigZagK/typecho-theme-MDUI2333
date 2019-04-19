<style>
	/*header.php*/
	a {color:unset;text-decoration:unset;}
	body {background:<?php if ($this->options->backgroundPic) echo 'url(' . $this->options->backgroundPic . ')'; else echo '#b3d4fc'; ?>;background-position:center center;background-size:cover;background-repeat:no-repeat;background-attachment:fixed;display:flex;flex-flow:column;min-height:calc(100vh - 56px);}
	@media (min-width:600px) {body {min-height:calc(100vh - 64px);}}
	@media (orientation: landscape) and (max-width: 959px) {body {min-height:calc(100vh - 48px);}}
	::selection {background:#b3d4fc;text-shadow:none;}
	.pre-numbering {float:left!important;font-size:14px!important;padding:10px!important;margin:0!important;border-right:1px solid #C3CCD0!important;background:#EEE!important;text-align:right!important;color:#666!important;list-style:none!important;line-height:1.6!important;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}
	pre {padding:0!important;background:#f7f7f7!important;}
	pre code {padding:10px!important;background:#f7f7f7!important;display:block;white-space:pre;overflow-x:auto;}
	pre code a {color:unset!important;}
	pre code a:hover:before,.hljs a:focus:before {display:none!important;}
	code {font-size:14px!important;line-height:1.6!important;}
	.pjax-overlay {position:fixed;top:-5000px;right:-5000px;bottom:-5000px;left:-5000px;z-index:2000;visibility:hidden;background:rgba(0,0,0,.4);opacity:0;-webkit-transition-duration:.3s;transition-duration:.3s;-webkit-transition-property:opacity,visibility;transition-property:opacity,visibility;-webkit-backface-visibility:hidden;backface-visibility:hidden;will-change:opacity;}
	.pjax-overlay-show {visibility:visible;opacity:1;}
	#pjax-container {flex:1;}
	.ins-search::before {z-index:19260817!important;}
	.ins-search-container {z-index:19260817!important;}
	.ins-section-wrapper::-webkit-scrollbar {background:#fff!important;}
	/*comments.php*/
	div#comments ol.comment-list {padding:0!important;}
	span.comment-reply a:hover:before,span.comment-reply a:focus:before {display:none!important;}
	div.cancel-comment-reply a:hover:before,div.cancel-comment-reply a:focus:before {display:none!important;}
	#QAQ {height:75%!important;}
	#QAQ .mdui-dialog-content {height:calc(100% - 100px)!important;}
	#QAQ a {color:unset!important;}
	#QAQ a:hover:before,#QAQ a:focus:before {display:none!important;}
	#QAQ .mdui-dialog-content .QAQPicture .mdui-btn {min-width:unset;padding:5px;height:unset;margin-bottom:-13px;}
	div.page-navigator {list-style:none;}
	div.page-navigator li {display:inline-block;padding:0 20px;}
	div.page-navigator li.current a {color:black!important;}
	/*post.php & page.php*/
	a.Fancybox:hover:before,a.Fancybox:focus:before {display:none!important;}
	@media (min-width:600px) {#post-tocbtn {top:80px!important;}}
	@media (orientation: landscape) and (max-width: 959px) {#post-tocbtn {top:64px!important;}}
	#post-toc {width:unset!important;min-width:168px!important;}
</style>