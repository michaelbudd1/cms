<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Create_Page_Cms extends CI_Migration {

  public function up()
  {
    $fields = array(
      'page_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
      'page_descrip VARCHAR(255) DEFAULT NULL',
      'page_content TEXT DEFAULT NULL',
      'section_id INT(11) UNSIGNED DEFAULT NULL',
      'deleted TINYINT(1) NOT NULL DEFAULT 0'
    );

    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('page_id', TRUE);
    $this->dbforge->create_table('page_cms');
  }

  public function down()
  {
    $this->dbforge->drop_table('page_cms');
  }

}