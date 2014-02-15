<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * comments controller
 */
class comments extends Front_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('comments_model', null, true);
		$this->lang->load('comments');
		$this->load->library('users/auth');
		$this->set_current_user();

		Assets::add_module_js('comments', 'comments.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{
        redirect('/blog');
		$records = $this->comments_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------

}