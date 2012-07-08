<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_Sub_Section extends CI_Migration {

  public function up()
  {
    $fields = array(
      'sub_section INT(11) UNSIGNED NOT NULL',
    );

    $this->dbforge->add_column('page_cms', $fields);
  }

  public function down()
  {
    $this->dbforge->drop_column('page_cms', 'sub_section');
  }

}