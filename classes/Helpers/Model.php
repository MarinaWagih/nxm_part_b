<?php
namespace NXM\Helpers;
abstract class  Model
{
    private  $dbconn;
    public $tableName="";
    public function __construct()
    {
        require_once('MySQLiQuery.php');
        $configs = require_once('config.php');
        $this->dbconn = MySQLiQuery::getObject($configs['DB_HOST'],$configs['DB_USERNAME'],$configs['DB_PASSWORD'],$configs['DB_DATABASE']);
    }
    public function save($data){
        if($this->dbconn){
            $fillable=array_keys($data);
            $data=array_values($data);
            return $this->dbconn->insert($this->tableName , $fillable, $data);
        }else{
            return null;
        }
    }
}