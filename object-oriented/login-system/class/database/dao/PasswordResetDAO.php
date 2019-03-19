<?php

/**
* Class: PasswordResetDAO
* 
* Database operations related to the PasswordReset table.
*
* @package      login-system
* @subpackage   class/database/dao
* @author       Ivan Filho <ivanfilho21@gmail.com>
*
* Created: Mar 19, 2019.
* Last Modified: Mar 19, 2019.
*/

class PasswordResetDAO extends DAO
{

	public function __construct($db)
	{
		parent::__construct($db);

		$this->tableName = "password_reset";
        $this->columns[] = new Column("id", "", INT, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("reset_email", "", TEXT, false, "", "");
        $this->columns[] = new Column("reset_password", "", TEXT, false, "", "");
        $this->columns[] = new Column("selector", "", TEXT, false, "", "");
        $this->columns[] = new Column("token", "", LONGTEXT, false, "", "");
        $this->columns[] = new Column("expire_date", "", TEXT, false, "", "");
	}

	public function createTable()
	{
		parent::create();
	}

	public function dropTable()
	{
		parent::drop();
	}
}