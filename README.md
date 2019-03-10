# typecho-theme-MDUI2333

基于[MDUI](https://mdui.org)的一款typecho主题，私用为主QAQ……若喜欢可以Star，谢谢QwQ。

作者：ZigZagK | 版本：1.1.8

## 主题特性

1. 基于[MDUI](https://www.mdui.org/)，结合PJAX。有丰富（拥挤）的侧边栏栏目比如用[tagcanvas](http://www.goat1000.com/tagcanvas.php)实现的标签云。
2. 支持文章头图设置（随机头图来源[typecho-theme-material](https://github.com/viosey/typecho-theme-material/tree/master/img/random)，侵删），评论字数限制以及评论表情，音乐播放器（By [Aplayer](https://github.com/MoePlayer/APlayer)&[Meting](https://github.com/metowolf/MetingJS)）等功能。
3. 使用[Highlight](https://highlightjs.org/)渲染代码片并资瓷行号显示，[MathJax](https://www.mathjax.org/)渲染`LaTeX`数学公式（毕竟我是个OIer嘛QAQ）以及[Fancybox](https://fancyapps.com/fancybox/3/)灯箱功能。
4. 一点都不丰富的自定义设置。~~（这哪里是特性了）~~
5. 中文最棒啦，所以不支持多语言。高版浏览器最棒啦，所以不兼容低版浏览器。~~（这完全是敷衍吧）~~

## 演示

可以参考[ZigZagK的博客](https://zigzagk.top)。

## 如何使用

1. 下载之后改名为MDUI2333放入主题目录，之后启动主题。
2. 在设置外观中设置一下主题色强调色，背景图片等。（ps：已删除网站图标设置，只需在网站根目录下放入网站图标`favicon.ico`，此方法对全站适用）
3. 友情链接页面使用方法：先安装插件[typecho-links-material](https://github.com/idawnlight/typecho-links-material)并添加友情链接。然后创建一个空页面，将模板改为友情链接页面。

## 待填坑

评论无刷新。（对这个一脸懵逼，希望有大佬指点Orz）

## 预览

![](https://raw.githubusercontent.com/ZigZagK/typecho-theme-MDUI2333/master/screenshot.png)

![](https://raw.githubusercontent.com/ZigZagK/typecho-theme-MDUI2333/master/preview.png)

## 版本更新

### 1.1.8

添加了独立页面的标签云，可在侧边栏球形标签云和独立页面标签云间按个人喜好选择。

顺便加了一些判断防止前端js报错……看到红叉叉莫名不爽QAQ。

### 1.1.7

添加了[Fancybox](https://fancyapps.com/fancybox/3/)灯箱，用于更友好的图片浏览。

学习了如何替换文章内容后就顺便把前端添加MDUI表格样式改到后端去了QAQ。

### 1.1.6

增加了评论框头像加载时的进度条，虽然这个进度条的进度功能其实是假的……

以及1.1.5(Fix)~1.1.6版本中各种各样的修修补补……

### 1.1.5(Fix)

把访问量统计去掉了，感觉华而不实……

### 1.1.5

针对移动端优化了好多样式……评论区已经完全重写了。

加入了评论表情，因为设置是纯手打的所以如果要自定义的话请加油QAQ，也可以用我的两套图片……

> 自定义评论表情：要更改`function.php`中`function convertSmilies($widget)`的内容以及`comments.php`中`<div class="mdui-dialog-content">`的内容，看我已有的配置应该可以看得懂QAQ。

评论表情是参考[ohmyga](https://ohmyga.net/)的主题的，希望Dalao不要捶我Orz。

### 1.1

什么？MDUI只要加一句话就支持移动端了？于是轻松解决了移动端问题（雾）。

优化了一下侧边栏热门文章和最新评论的显示，把`<a>`的`title`属性换掉改成了MDUI的提示框。

优化了一下文章搜索的样式（其实就是去掉了`width:25%`……），增加了下方链接的提示框。

好像不算很大的更新……不过填掉了第一个神坑，还是很开心的QAQ。