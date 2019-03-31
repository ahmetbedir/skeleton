<?php 


class DB extends PDO {
    
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;
    
    public static $sql;
    public static $table;
    public static $where = '';
    
    
    public function __construct(){
        $dbConfig      = Loader::getDBConfig();
        
        $this->host     = $dbConfig['host'];
        $this->user     = $dbConfig['username'];
        $this->pass     = $dbConfig['password'];
        $this->dbname   = $dbConfig['database'];
        
        try {
            $dsn = "mysql:host=".$this->host.';dbname='.$this->dbname;
            parent::__construct($dsn, $this->user, $this->pass);
            
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public static function table($tableName = null, $column = '*'){
        if($tableName){
            self::$sql      .= "SELECT {$column} FROM {$tableName}";
            self::$table    = $tableName;
        }
        
        return new self;
    }
    
    public static function where($column = null, $operatorOrData, $value = null, $oprt = 'AND'){
        if(! empty($column)){
            $localWhere = '';
            switch ($operatorOrData) {
                case '=':
                    $localWhere .= "$column = '$value'";
                    break;
                case '!=':
                    $localWhere .= "$column != '$value'";
                    break;
                case '<>':
                    $localWhere .= " $column <> '$value'";
                    break;
                case '>':
                    $localWhere .= "$column > '$value'";
                    break;
                case '<':
                    $localWhere .= "$column < '$value'";
                    break;
                case 'LIKE':
                    $localWhere .= "$column LIKE '$value'";
                    break;
                case 'IN':
                    $value = array_map(function($v){
                       return "'$v'";
                    }, $value);
                    $value = implode(',', $value);
                    $localWhere .= "$column IN($value)";
                    break;
                default:
                    $oprt       = (strtoupper($value) == 'OR' ? 'OR' : (strtoupper($value) == 'AND' ? 'AND' : 'AND'));
                    $value      = $operatorOrData;
                    $localWhere .= "$column = '$value'";
                    break;
            }
            
            if(strlen(self::$where) > 0){
                self::$where .= " {$oprt} {$localWhere}";
            }else{
                self::$where .= "{$localWhere}";
            }
            
        }
        
        return new self;
    }
    
    public function run($singleFetch = false){
        echo '<pre>';
        print_r(self::$where);
        $sql = "";
        if(self::$where){
            $sql = self::$sql.' WHERE '.self::$where;
        }else{
            $sql = self::$sql;
        }
        
        $query = parent::query($sql);
        print_r($query);
        
        if($query){
            if($singleFetch){
                return $query->fetch(parent::FETCH_ASSOC);
            }else{
                return $query->fetchAll(parent::FETCH_ASSOC);
            }
        }
        
        return [];
    }
}