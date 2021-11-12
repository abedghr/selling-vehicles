<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_refresh_tokens}}`.
 */
class m211027_120042_create_user_refresh_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(
            "CREATE TABLE `user_refresh_tokens` (
    	`user_refresh_tokenID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	    `urf_userID` INT(10) UNSIGNED NOT NULL,
	    `urf_token` VARCHAR(1000) NOT NULL,
	    `urf_ip` VARCHAR(50) NOT NULL,
	    `urf_user_agent` VARCHAR(1000) NOT NULL,
	    `urf_created` DATETIME NOT NULL COMMENT 'UTC',
	    PRIMARY KEY (`user_refresh_tokenID`)
    )");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_refresh_tokens}}');
    }
}
