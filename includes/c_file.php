<?php

class file extends node {
	private $path;
	private $author;
	private $comment;

	//
	// héritage
	//
	protected function init() {
		$id = $this->content_id();
		$this->path		= sql_query_single_value("SELECT path FROM files WHERE id=$id");
		$this->author	= sql_query_single_value("SELECT author FROM files WHERE id=$id");
		$this->comment	= sql_query_single_value("SELECT comment FROM files WHERE id=$id");
	}

	public function remove_node() {
		$id = $this->content_id();
		sql_query("DELETE FROM files WHERE id=$id");
		unlink('../'.$GLOBALS['doc_root'].'/'.$this->path);
		parent::remove_node();
	}

	//
	// accesseurs
	//
	public function path() {
		return $this->path;
	}

	public function author() {
		return $this->author;
	}

	public function comment() {
		return $this->comment;
	}
	
}

?>
