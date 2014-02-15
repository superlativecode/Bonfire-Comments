<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * content controller
 */
class content extends Admin_Controller
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

		$this->auth->restrict('Comments.Content.View');
		$this->load->model('comments_model', null, true);
		$this->lang->load('comments');
		
		Template::set_block('sub_nav', 'content/_sub_nav');

		Assets::add_module_js('comments', array('bootstrap-markdown.js', 'comments.js'));
        Assets::add_module_css('comments', 'bootstrap-markdown.min.css');
	}

    /**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->comments_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('comments_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('comments_delete_failure') . $this->comments_model->error, 'error');
				}
			}
		}

		$records = $this->comments_model->where('deleted', 0)->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Comments');
		Template::render();
	}

	//--------------------------------------------------------------------

	/**
	 * Creates a Comments object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Comments.Content.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_comments())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('comments_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'comments');

				Template::set_message(lang('comments_create_success'), 'success');
				redirect(SITE_AREA .'/content/comments');
			}
			else
			{
				Template::set_message(lang('comments_create_failure') . $this->comments_model->error, 'error');
			}
		}
		Assets::add_module_js('comments', 'comments.js');

		Template::set('toolbar_title', lang('comments_create') . ' Comments');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Comments data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('comments_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/comments');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Comments.Content.Edit');

			if ($this->save_comments('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('comments_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'comments');

				Template::set_message(lang('comments_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('comments_edit_failure') . $this->comments_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Comments.Content.Delete');

			if ($this->comments_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('comments_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'comments');

				Template::set_message(lang('comments_delete_success'), 'success');

				redirect(SITE_AREA .'/content/comments');
			}
			else
			{
				Template::set_message(lang('comments_delete_failure') . $this->comments_model->error, 'error');
			}
		}
		Template::set('comments', $this->comments_model->find($id));
		Template::set('toolbar_title', lang('comments_edit') .' Comments');
		Template::render();
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_comments($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['text']        = $this->input->post('comments_text');
		$data['approved']    = $this->input->post('approved') ? $this->input->post('approved') : 0;

		if ($type == 'insert')
		{
			$id = $this->comments_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->comments_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}