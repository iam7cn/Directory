<!DOCTYPE html>
<?php 
header("Content-type: text/html; charset=utf-8"); 
$md_path_all = $lister->getListedPath();
$suffix_array = explode('.', $_SERVER['HTTP_HOST']."/tmp");
$suffix = end($suffix_array);
$md_path = explode($suffix, $md_path_all);
if($md_path[1] != ""){
	$md_path_last = substr($md_path[1], -1);;
	if($md_path_last != "/"){
		$md_file = ".".$md_path[1]."/README.html";
	}else{
		$md_file = ".".$md_path[1]."README.html";
	}
}
if(file_exists($md_file)){
	$md_text = file_get_contents($md_file);
}else{
	$md_text = "";
}
?>
<html>
    <head>
        <title>HX共享文件索引</title>
        <!--pwa-->
        <meta name="theme-color" content="#333" />
		<meta name="msapplication-TileColor" content="#333" /><!--状态栏颜色-->
		<meta name="msapplication-TileImage" content="resources/pwa/icon/cloud_logo192.png" />
		<meta name="mobile-web-app-capable" content="yes" /><!--删除默认的苹果工具栏和菜单栏,yes为删除-->
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" /><!--状态栏灰色半透明-->
		<meta name="apple-mobile-web-app-title" content="HX共享文件索引" />
		<!--pwa-->
        <link rel="shortcut icon" href="resources/themes/bootstrap/img/folder.png" /> <!-- 网站LOGO -->
        <link rel="stylesheet" href="resources/themes/bootstrap/css/bootstrap.min.css" /> <!-- CSS基本库 -->
        <link rel="stylesheet" href="resources/themes/bootstrap/css/font-awesome.min.css" /> <!-- 网站图标CSS式样 -->
        <link rel="stylesheet" href="resources/themes/bootstrap/css/style.css" /> <!-- 网站主要式样 -->
        <link rel="stylesheet" href="resources/themes/bootstrap/css/prism.css" /> <!-- 代码高亮式样 -->
        <link rel="stylesheet" href="resources/themes/bootstrap/css/md.css">


        <script src="resources/themes/bootstrap/js/jquery.min.js"></script> <!-- JS基本库 -->
		<script src="resources/themes/bootstrap/js/bootstrap.min.js"></script> <!-- JS基本库 -->
		<script src="resources/themes/bootstrap/js/prism.js"></script> <!-- 代码高亮JS依赖 -->

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php file_exists('analytics.inc') ? include('analytics.inc') : false; ?>
        <!--pwa-->
    	<script src="resources/pwa/js/index.js" defer></script>
    	<link rel="manifest" href="resources/pwa/manifest.webmanifest">
    	<link rel="apple-touch-icon" href="resources/pwa/icon/cloud_logo192.png">
		<!--pwa-->
    </head>
    <body>
        <div id="page-navbar" class="path-top navbar navbar-default navbar-fixed-top">
            <div class="container">
                <?php $breadcrumbs = $lister->listBreadcrumbs(); ?>
                <p class="navbar-text">
                    <?php foreach($breadcrumbs as $breadcrumb): ?>
                        <?php if ($breadcrumb != end($breadcrumbs)): ?>
                                <a href="<?php echo $breadcrumb['link']; ?>"><?php echo $breadcrumb['text']; ?></a>
                                <span class="divider">/</span>
                        <?php else: ?>
                            <?php echo $breadcrumb['text']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
        <div class="path-announcement navbar navbar-default navbar-fixed-top">
            <div class="path-announcement2 container">
		    <p><i class="fa fa-volume-down"></i><a class="add-button">点击安装本站应用&nbsp</a>仅列出公共文件&nbsp<a href="resources\/notice.html">广告与转载声明</a></p>
            </div>
        </div>
		<div class="container"  id="container_top">
		<div class="page-content container"  id="container_page">
            <?php file_exists('header.php') ? include('header.php') : include($lister->getThemePath(true) . "/default_header.php"); ?>
            <?php if($lister->getSystemMessages()): ?>
                <?php foreach ($lister->getSystemMessages() as $message): ?>
                    <div class="alert alert-<?php echo $message['type']; ?>">
                        <?php echo $message['text']; ?>
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div id="directory-list-header">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-10">文件名</div>
                    <div class="col-md-2 col-sm-2 col-xs-2 text-right">大小</div>
                    <div class="col-md-3 col-sm-4 hidden-xs text-right">修改时间</div>
                </div>
            </div>
            <ul id="directory-listing" class="nav nav-pills nav-stacked">
                <?php foreach($dirArray as $name => $fileInfo): ?>
                    <li data-name="<?php echo $name; ?>" data-href="<?php echo $fileInfo['url_path']; ?>">
                        <a href="<?php echo $fileInfo['url_path']; ?>" class="clearfix" data-name="<?php echo $name; ?>">
                            <div class="row">
                                <span class="file-name col-md-7 col-sm-6 col-xs-9">
                                    <i class="fa <?php echo $fileInfo['icon_class']; ?> fa-fw"></i>
                                    <?php echo $name; ?>
                                </span>
                                <span class="file-size col-md-2 col-sm-2 col-xs-3 text-right">
                                    <?php echo $fileInfo['file_size']; ?>
                                </span>
                                <span class="file-modified col-md-3 col-sm-4 hidden-xs text-right">
                                    <?php echo $fileInfo['mod_time']; ?>
                                </span>
                            </div>
                        </a>
                        <?php if (is_file($fileInfo['file_path'])): ?>
                        <?php else: ?>
                            <?php if ($lister->containsIndex($fileInfo['file_path'])): ?>
                                <a href="<?php echo $fileInfo['file_path']; ?>" class="web-link-button" <?php if($lister->externalLinksNewWindow()): ?>target="_blank"<?php endif; ?>>
                                    <i class="fa fa-external-link"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

		<!-- READMNE 说明 -->
		<?php
		if($md_text != "")
			echo '<div id="readme" class="my-4 order-first" style="scroll-margin-top: 8rem;"><div class="rounded-lg overflow-hidden shadow-md"><header class="flex items-center bg-blue-600 px-4 py-3 text-white dark:bg-purple-700"><i class="fa fa-book fa-lg pr-3"></i> README.md</header><article class="bg-gray-100 rounded-b-lg px-4 py-8 sm:px-6 md:px-8 lg:px-12 dark:bg-gray-900 dark:border-0 markdown" v-pre="">'.$md_text.'</article></div></div>'
		?>
		<!-- READMNE 说明 -->
        </div>
      <hr id="footer_hr" style="margin-bottom: 0;margin-top: 40px;" />
      <?php file_exists('footer.php') ? include('footer.php') : include($lister->getThemePath(true) . "/default_footer.php"); ?>
<script type="text/javascript">
window.onload=function(){  
	changeDivHeight();  
}  
window.onresize=function(){  
	changeDivHeight();  
}  
function changeDivHeight(){
	if(document.getElementById("container_readme"))
	{
		container_readme.style.marginBottom = '0';
	}
	
  	ScrollHeight_body=document.body.offsetHeight;
	InnerHeight_window=window.innerHeight;
	container_top.style.minHeight = '0';
	ClientHeight_top=container_top.clientHeight+60;
	ClientHeight_top1=ClientHeight_top+69;
	ClientHeight_top2=ClientHeight_top1-60;
	
	//console.log(ScrollHeight_body, InnerHeight_window, container_top.clientHeight, ClientHeight_top, ClientHeight_top1, ClientHeight_top2, InnerHeight_window);
	container_top.style.minHeight = '';
	
	if (ScrollHeight_body > ClientHeight_top2)
	{
		footer_hr.style.marginTop = '0';
	}
	else
	{
		footer_hr.style.marginTop = '40px';
	}
	
	if (ScrollHeight_body > InnerHeight_window)
	{
		if (ClientHeight_top > InnerHeight_window)
		{
			container_top.style.marginBottom = '0';
			container_page.style.marginBottom = '0';
			if(document.getElementById("container_readme"))
			{
				container_readme.style.marginTop = '20px';
			}
		}
		else
		{
			footer_hr.style.marginTop = '40px';
			container_top.style.marginBottom = '';
			container_page.style.marginBottom = '';
			if(document.getElementById("container_readme"))
			{
				container_readme.style.marginTop = '';
			}
		}
	}
	else
	{
		if (ScrollHeight_body < ClientHeight_top1)
		{
			container_top.style.marginBottom = '0';
			container_page.style.marginBottom = '0';
			if(document.getElementById("container_readme"))
			{
				container_readme.style.marginTop = '20px';
			}
		}
		else
		{
			footer_hr.style.marginTop = '40px';
			container_top.style.marginBottom = '';
			container_page.style.marginBottom = '';
			if(document.getElementById("container_readme"))
			{
				container_readme.style.marginTop = '';
			}
		}
	}
}
</script>
    </body>
</html>
