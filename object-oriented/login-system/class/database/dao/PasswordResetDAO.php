<?php
require ROOT_PATH . "/class/PasswordReset.php";

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
* Last Modified: Mar 20, 2019.
*/

class PasswordResetDAO extends DAO
{

	public function __construct($db)
	{
		parent::__construct($db);

		$this->tableName = "password_reset";
        $this->columns[] = new Column("id", "", INT, 0, false, "AUTO_INCREMENT", "PRIMARY KEY");
        $this->columns[] = new Column("reset_email", "", TEXT, 0, false, "", "");
        $this->columns[] = new Column("selector", "", TEXT, 0, false, "", "");
        $this->columns[] = new Column("token", "", LONGTEXT, -1, false, "", "");
        $this->columns[] = new Column("expire_date", "", TEXT, 0, false, "", "");
	}

	public function getColumnByName($name)
	{
		return parent::findColumn($name);
	}

	public function createTable()
	{
		parent::create();
	}

	public function dropTable()
	{
		parent::drop();
	}

	public function select($where = "")
	{
		$pass = null;
		$res = parent::select($where);

        if ($res->rowCount() > 0) {
            $pass = new PasswordReset(0, "", "", "", "");

            foreach ($res->fetchAll() as $obj) {
                $pass->setId($obj["id"]);
                $pass->setEmail($obj["reset_email"]);
                $pass->setSelector($obj["selector"]);
                $pass->setToken($obj["token"]);
                $pass->setExpireDate($obj["expire_date"]);
            }
        }

        return $pass;
	}

	public function createPasswordRecoveryRequest($passwordReset)
	{
		$email = $passwordReset->getEmail();
		$selector = $passwordReset->getSelector();
		$token = $passwordReset->getToken();
		$expireDate = $passwordReset->getExpireDate();

		$values = "";
		$values .= QT .$email. QT .COMMA. QT .$selector. QT .COMMA. QT .$token. QT .COMMA. QT .$expireDate. QT;

		parent::insert($values);
	}

	public function deletePasswordRecoveryRequest($email)
	{
		$condition1 = $this->findColumn("reset_email");
		$condition1->setValue($email);

		$where = array($condition1);

		parent::delete($where);
	}
}