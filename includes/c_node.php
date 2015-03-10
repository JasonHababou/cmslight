<?php

define("NODE_NONE",		0);
define("TYPE_SECTION",	1);
define("TYPE_FILE",		2);
define("TYPE_ROOT",		0xff);


abstract class node {
	private $id;
	private $nextnode;
	private $childnode;
	private $contenttype;
	private $contentid;
	private $permissions;
	private $login;

	//
	// instanciation
	//
	protected  function __construct() {}
	abstract protected function init();

	//recuperer l'id du nod par le type root.
	public static function get_root_node() {
		return self::get_node_by_sql_condition("contenttype='".TYPE_ROOT."'");
	}


	public static function get_node_by_id($id) {
		if ($id == "" || $id == NODE_NONE) {
			return NULL;
		}
		$data = sql_query_single_line("SELECT * FROM nodes WHERE id=$id");
		if (!$data) {
			return NULL;
		}
		
		switch($data['contenttype']) {
		case TYPE_SECTION:
			$n = new section();
			break;
		case TYPE_FILE:
			$n = new file();
			break;
		case TYPE_ROOT:
			$n = new root();
			break;
		default:
			die("unknown node type");
		}
		
		$n->id			= $data['id'];
		$n->nextnode	= $data['nextnode'];
		$n->childnode	= $data['childnode'];
		$n->contenttype	= $data['contenttype'];
		$n->contentid	= $data['contentid'];
		$n->permissions	= $data['permissions'];
		
		$n->login = sql_query_single_value("SELECT login FROM permissions WHERE id=$n->permissions");
		
		$n->init();
		return $n;
	}



// afficher l'id de la table Nodes par une condition.
	public static function get_node_by_sql_condition($condition) {
		return self::get_node_by_id(sql_query_single_value("SELECT id FROM nodes WHERE $condition"));
	}

	public static function addPermission($title)
	{
		$idPerm = sql_query_single_value("SELECT id FROM permissions WHERE login = '$title'");
		$idSections=sql_query_single_value("SELECT id FROM sections WHERE title ='$title'");
		$sql_req="UPDATE nodes set permissions= '$idPerm' WHERE contentid='$idSections'";
		sql_query($sql_req);
	}

	public static function passwordGenerate()
	{

		$characts    = 'abcdefghijklmnopqrstuvwxyz';
		$characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characts   .= '1234567890';
		$characts   .= '.+*:=%';
		$code_aleatoire      = '';

		for($i=0;$i < 8;$i++)    //10 est le nombre de caract�res
		{
			$code_aleatoire .= substr($characts,rand()%(strlen($characts)),1);
		}
		return $code_aleatoire;
	}

	public static function generateLogin ($title,$password)

	{
		$req_sql="INSERT INTO permissions (login, password) VALUES ('$title',md5('$password'))";
		//echo "** $req_sql ***";
		sql_query($req_sql);

	}



	//
	// navigation arborescence
	//
	public function previous_node() {
		return self::get_node_by_sql_condition("nextnode=$this->id");
	}

	public function next_node() {
		return self::get_node_by_id($this->nextnode);
	}

	public function child_node($bypass=false) {
		if (!$bypass && $this->permissions && $this->login != isset($_SESSION['login'])) {
			return null;
		}
		return self::get_node_by_id($this->childnode);
	}
	
	public function parent_node() {
		$id = $this->id;
		while ($r = sql_query_single_value("SELECT id FROM nodes WHERE nextnode=$id")) {
			$id = $r;
		}
		return node::get_node_by_id(sql_query_single_value("SELECT id FROM nodes WHERE childnode=$id"));
	}

	public function spawn_child($contenttype, $contentid) {
		global $bdd;
		sql_query("INSERT INTO nodes (contenttype, contentid) VALUES($contenttype, $contentid)");
		$child = self::get_node_by_id(mysqli_insert_id($bdd));
		if ($n = $this->child_node()) {
			while ($t = $n->next_node()) {
				$n = $t;								
			}
			$n->set_next_node($child);
		} else {
			$this->set_child_node($child);
		}
		return $child;
	}


	//
	// accesseurs
	//
	public function id() {
		return $this->id;
	}
	
	public function content_id() {
		return $this->contentid;
	}

	public function type() {
		return $this->contenttype;
	}

	public function AccessDenied() {
		return ($this->permissions && $this->login != $_SESSION['login']);
	}

	//
	// mutateurs
	//
	public function remove_node() {
		if ($this->type() == TYPE_ROOT) {
			return;
		}
		
		// destruction des enfants
		$n = $this->child_node(trye);
		while ($n) {
			$n->remove_node();
			$n = $n->next_node();
		}

		// destruction du noeud
		if ($prev = $this->previous_node()) {
			$prev->set_next_node($this->next_node());
		} else {
			$parent = self::get_node_by_sql_condition("childnode=$this->id");
			$parent->set_child_node($this->next_node());
		}
		sql_query("DELETE FROM nodes WHERE id=$this->id");
	}

	public function move_up() {
		if ($this->type() == TYPE_ROOT) {
			return;
		}
		if (!$prev = $this->previous_node()) {
			return;
		}
		$prev->set_next_node($this->next_node());
		if ($n = $prev->previous_node()) {
			$n->set_next_node($this);
		} else {
			$n = self::get_node_by_sql_condition("childnode=$prev->id");
			$n->set_child_node($this);
		}
		$this->set_next_node($prev);
	}

	public function move_down() {
		if ($this->type() == TYPE_ROOT) {
			return;
		}
		if (!$next = $this->next_node()) {
			return;
		}

		if ($prev = $this->previous_node()) {
			$prev->set_next_node($next);
		} else {
			$parent = self::get_node_by_sql_condition("childnode=$this->id");
			$parent->set_child_node($next);
		}
		$this->set_next_node($next->next_node());
		$next->set_next_node($this);
	}

	private function set_next_node($n) {
		if ($this->type() == TYPE_ROOT) {
			return;
		}

		$nextid = ($n) ? $n->id() : NODE_NONE;

		sql_query("UPDATE nodes SET nextnode=$nextid WHERE id=$this->id");
		$this->nextnode = $nextid;

		if ($this->permissions && $n) {
			$p = $this->parent_node();
			if ($p && $p->permissions) {
				sql_query(sprintf("UPDATE nodes SET permissions=%d WHERE id=%d", $this->permissions, $nextid));
			}
		}

	}
	
	private function set_child_node($n) {
		$this->childnode = ($n) ? $n->id() : NODE_NONE;
		
		sql_query("UPDATE nodes SET childnode=$this->childnode WHERE id=$this->id");
		if ($this->permissions) {
			sql_query("UPDATE nodes SET permissions=$this->permissions WHERE id=$this->childnode");
		}
	}


}

?>
