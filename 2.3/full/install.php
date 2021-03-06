<?php 

$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX."user_token_mob_api` ");
$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX."user_device_mob_api` ");
$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX."user_token_mob_api` (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, user_id INT NOT NULL, token VARCHAR(32) NOT NULL )");
$this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX."user_device_mob_api` (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, user_id INT NOT NULL, device_token VARCHAR(500) , os_type VARCHAR(20))");

$this->load->model('setting/setting');

	$this->model_setting_setting->editSetting('apimodule', ['apimodule_status'=>1,'version'=>1.7]);
if(VERSION == '2.0.0.0'){
    $this->load->model('tool/event');
	$this->model_tool_event->deleteEvent('apimodule');
	$this->model_tool_event->addEvent('apimodule', 'post.order.history.add', 'module/apimodule/sendNotifications');
}else{
	//$this->load->model('extension/event');
	//$this->model_extension_event->deleteEvent('apimodule');
	//$this->model_extension_event->addEvent('apimodule', 'catalog/model/checkout/order/addOrderHistory/after', 'module/apimodule/sendNotifications');
}

?>