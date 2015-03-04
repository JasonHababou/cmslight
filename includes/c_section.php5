<?php

class section extends node {
	private $title;
	
	//
	// héritage
	//
	protected function init() {
		$this->title = sql_query_single_value('SELECT title FROM sections WHERE id=(SELECT contentid FROM nodes WHERE id='.$this->id().')');
	}
	
	public function remove_node() {
		sql_query('DELETE FROM sections WHERE id='.$this->content_id());
		parent::remove_node();
	}
	
	//
	// accesseurs
	//
	public function title() {
		return $this->title;
	}
}

?>
