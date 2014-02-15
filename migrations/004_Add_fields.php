<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Add_fields extends Migration
{
	/**
	 * The name of the database table
	 *
	 * @var String
	 */
	private $table_name = 'comments';

	/**
	 * The table's fields
	 *
	 * @var Array
	 */
	private $fields = array(
		'deleted' => array(
			'type' => 'TINYINT',
			'constraint' => 1,
			'default' => '0',
		),
		'created_on' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
		),
		'modified_on' => array(
			'type' => 'datetime',
			'default' => '0000-00-00 00:00:00',
		),
	);

	/**
	 * Install this migration
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_column($this->table_name, $this->fields);
		$this->dbforge->add_key('post_id');
		$this->dbforge->add_key('parent_id');
		$this->dbforge->add_key('user_id');
	}

	//--------------------------------------------------------------------

	/**
	 * Uninstall this migration
	 *
	 * @return void
	 */
	public function down()
	{
	    foreach($this->fields as $field)
    		$this->dbforge->drop_column($this->table_name, $field);
	}

	//--------------------------------------------------------------------

}