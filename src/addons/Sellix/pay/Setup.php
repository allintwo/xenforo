<?php

namespace Sellix\pay;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;


    public function installStep1()
    {
        $db = \XF::db();
        $sm = $db->getSchemaManager();
        $defaultTableConfig = $sm->getTableConfigSql();
        $db->query("
CREATE TABLE IF NOT EXISTS `xf_sellix_customers` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `is_vip` tinyint(1) NOT NULL DEFAULT 0,
  `s_total_amount` int(8) NOT NULL DEFAULT 0,
  `s_customer_email` varchar(128) NOT NULL,
  `s_product_id` int(12) NOT NULL,
  `s_product_title` varchar(128) NOT NULL,
  `s_created_at` int(12) NOT NULL,
  `s_updated_at` int(12) NOT NULL,
  `s_status` varchar(32) NOT NULL,
  `expire_time` int(12) NOT NULL,
  `auto_expire` tinyint(1) NOT NULL DEFAULT 0,
  `time` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) {$defaultTableConfig}
");
    }


    public function uninstallStep1()
    {
       // $this->schemaManager()->dropTable('xf_mosteveronline');
    }


}