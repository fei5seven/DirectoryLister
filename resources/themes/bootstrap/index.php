<!DOCTYPE html>
<?php 
header("Content-type: text/html; charset=utf-8"); 
$md_path_all = $lister->getListedPath();
$md_path = explode("com", $md_path_all);
if($md_path[1] != ""){
	$md_path_last = substr($md_path[1], -1);
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
        <title>DOUBI Soft <?php echo $md_path_all; ?></title>
        <link rel="shortcut icon" href="resources/themes/bootstrap/img/folder.png">
        <link rel="stylesheet" href="resources/themes/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="resources/themes/bootstrap/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="resources/themes/bootstrap/css/style.css">
        <script src="resources/themes/bootstrap/js/jquery.min.js"></script>
	<script src="resources/themes/bootstrap/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <?php file_exists('analytics.inc') ? include('analytics.inc') : false; ?>
		<script type="text/JavaScript">
// 收藏本站
		function AddFavorite(title, url) {
			try {
				window.external.addFavorite(url, title);
			}
			catch (e) {
				try {
					window.sidebar.addPanel(title, url, "");
				}
				catch (e) {
					alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
				}
			}
		}
</script>
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
                <!-- 顶部公告栏 -->
		    <p><i class="fa fa-volume-down"></i>顶部公告栏</p>
            	<!-- 顶部公告栏 -->
            </div>
        </div>
		<div class="container">
		<div class="page-content container">
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
                    <div class="col-md-7 col-sm-6 col-xs-10">文件</div>
                    <div class="col-md-2 col-sm-2 col-xs-2 text-right">大小</div>
                    <div class="col-md-3 col-sm-4 hidden-xs text-right">最后修改时间</div>
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
                            <!-- a href="javascript:void(0)" class="file-info-button">
                                <i class="fa fa-info-circle"></i>
                            </a -->
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
		if($md_text != ""){
			echo $md_text;
		}
		?>
		<!-- READMNE 说明 -->
        </div>
      <hr style="margin-bottom: 0;margin-top: 40px;" />
      <?php file_exists('footer.php') ? include('footer.php') : include($lister->getThemePath(true) . "/default_footer.php"); ?>
      </body>
  </html>
