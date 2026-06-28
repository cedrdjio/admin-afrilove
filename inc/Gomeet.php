<?php
require "Connection.php";
class Gomeet
{
    private $dating;

    public function __construct($dating)
    {
        $this->dating = $dating;
    }

    public function datinglogin($username, $password, $tblname)
    {
        if ($tblname == 'admin') {
            $q = "SELECT * FROM " . $tblname . " WHERE username='" . $username . "' AND password='" . $password . "'";
        } else {
            $q = "SELECT * FROM " . $tblname . " WHERE email='" . $username . "' AND password='" . $password . "'";
        }
        return $this->dating->query($q)->num_rows;
    }

    public function datinginsertdata($field_values, $data_values, $table)
    {
        $fields = implode(', ', $field_values);
        $escaped = array_map(function($v) {
            return "'" . $this->dating->real_escape_string($v) . "'";
        }, $data_values);
        $values = implode(', ', $escaped);
        $q = "INSERT INTO `$table` ($fields) VALUES ($values)";
        return $this->dating->query($q) ? 1 : 0;
    }

    public function datingupdateData($field, $table, $where)
    {
        $set = [];
        foreach ($field as $k => $v) {
            if ($v === NULL) {
                $set[] = "`$k`=NULL";
            } else {
                $set[] = "`$k`='" . $this->dating->real_escape_string($v) . "'";
            }
        }
        $q = "UPDATE `$table` SET " . implode(', ', $set) . " $where";
        return $this->dating->query($q) ? 1 : 0;
    }

    public function datingupdateData_single($field, $table, $where)
    {
        $q = "UPDATE `$table` SET $field $where";
        return $this->dating->query($q) ? 1 : 0;
    }
}
?>
