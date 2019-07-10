<?
// 如果uninstall 不是从wordpress调用，退出
if (!defined("WP_UNINSTALL_PLUGIN"))
	exit();

// 删除插件创建的项目，以确保不占用数据库资源
delete_option('meng_option');
