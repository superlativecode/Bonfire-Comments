<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends BF_Model {

	protected $table_name	= "comments";
	protected $key			= "id";
	protected $soft_deletes	= true;
	protected $date_format	= "datetime";

	protected $log_user 	= FALSE;

	protected $set_created	= true;
	protected $set_modified = true;

	/*
		Customize the operations of the model without recreating the insert, update,
		etc methods by adding the method names to act as callbacks here.
	 */
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 		= array();
	protected $after_find 		= array('get_comment_user');
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	/*
		For performance reasons, you may require your model to NOT return the
		id of the last inserted row as it is a bit of a slow method. This is
		primarily helpful when running big loops over data.
	 */
	protected $return_insert_id 	= TRUE;

	// The default type of element data is returned as.
	protected $return_type 			= "object";

	// Items that are always removed from data arrays prior to
	// any inserts or updates.
	protected $protected_attributes = array();

	/*
		You may need to move certain rules (like required) into the
		$insert_validation_rules array and out of the standard validation array.
		That way it is only required during inserts, not updates which may only
		be updating a portion of the data.
	 */
	protected $validation_rules 		= array(
		array(
			"field"		=> "comments_text",
			"label"		=> "Comment",
			"rules"		=> "required|xss_clean|strip_tags|trim|max_length[1000]"
		),
		array(
			"field"		=> "approved",
			"label"		=> "Approved",
			"rules"		=> "trim"
		),
	);
	protected $insert_validation_rules 	= array();
	protected $skip_validation 			= FALSE;

	//--------------------------------------------------------------------
	
	public function get_nested($id, $is_comment=false){
	    if($is_comment){
    	    $this->db->where('parent_id', $id);
	    }else{
    	    $this->db->where('parent_id IS NULL');
    	    $this->db->where('post_id', $id);
	    }
        $comments = parent::find_all();
	    
        if(!$comments) return '';
        $html = "<ul class='comments'>";
        foreach($comments as $comment){
            $html .= $this->process_comment($comment);
        }
        $html .= "</ul>";
        return $html;
	}
	
	public function process_comment($comment){
    	$html = "<li>";
        $html .= "<blockquote class='comment'>";
        $html .= Parsedown::instance()->parse(strip_tags($comment->text));
        $html .= "<footer class='subtitle text-right'>".$comment->user->display_name."&nbsp;&nbsp;&nbsp;<span class=\"btn btn-default btn-sm reply-to\" data-id=\"{$comment->id}\">Reply</span></footer></blockquote>";
    	$html .= $this->get_nested($comment->id, true);
    	$html .= "</li>";
    	return $html;
	}
	
	public function get_comment_user($row){
    	$this->load->model('users/user_model');
    	if(is_object($row) && !empty($row->user_id)){
        	$row->user = $this->user_model->find($row->user_id);
    	}else{
        	$row['user'] = $this->user_model->find($row['user_id']);
    	}
    	return $row;
	}

}
