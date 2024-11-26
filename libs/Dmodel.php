<?php
interface IEntity
{
    public const USER = 9; // ROLE 1 admin toàn quyền
    public function add();
    public function renderAll(int $offset,int $limit);
    public function update();
    public function detele();
}
abstract class Dmodel{
    private $conn ;
    private $dbs = "mysql:host=s103d190-u2.interdata.vn;port=3306;dbname=Tede_Shop;charset=utf8";
    private $user = 'dichvun3';
    private $pass = '3VwORS+87-jl4d';
    protected function __construct(){
        try{
            $this->conn = new DatabaseManager($this->dbs,$this->user,$this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "ket noi ket bai!".$e->getMessage();
            die();
        }
        
    }
    protected function getConn(){return $this->conn;}
    // abstract public function check_ip(string $ip,array $session,array $cookie): Dcontroller;
}


abstract class Models extends Dmodel{

    public const RULES_REQUIRED = "required";
    public const RULES_EMAIL = "email";
    public const RULES_MIN = "min";
    public const RULES_MAX = "max";
    public const RULES_MATCH = "match";
    public const RULES_UNIQUE = "unique"; // đụng tới unique là phải seclect table, mà phải kiểm trả có field nào hay chưa đã rồi mời cho save

    public array $errors = [];


    abstract public function rules() : array;

    public function loadData($data) 
    {
        foreach($data as $key => $value)
        {
            if(property_exists($this,$key)) // trong trường hợp này intance của nó là các model con chứ ko còn là Dady Models
            {
                $this->{$key} = $value;
            }
        }
    }
    public function validate() : bool
    {
        foreach($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute}; // giá trị của thuộc tính của object hiện tại, $value = $attribute chỉ lấy ra tên key thôi ko lấy được giá trị của phần tử 
            foreach($rules as $rule)
            {
                $ruleName = $rule;
                if(!is_string($ruleName)) $ruleName = $rule[0];
                if($ruleName === self::RULES_REQUIRED && !$value) $this->addError($attribute,self::RULES_REQUIRED);
                if($ruleName === self::RULES_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL)) $this->addError($attribute,self::RULES_EMAIL);
                if($ruleName === self::RULES_MIN && strlen($value) < $rule['min']) $this->addError($attribute,self::RULES_MIN,$rule);
                if($ruleName === self::RULES_MAX && strlen($value) > $rule['max']) $this->addError($attribute,self::RULES_MAX,$rule);
                //chổ này đang sida coi lại điều kiện kiểm tra là property của class con hay là param truyền từ action class con if($ruleName === self::RULES_MATCH && $value !== $rule['match']) $this->addError($attribute,self::RULES_MATCH,$rule);
                if($ruleName === self::RULES_MATCH && $value !== $this->{$rule['match']})
                {
                    $rule['match'] = $this->getLabels($rule['match']);
                    $this->addError($attribute,self::RULES_MATCH,$rule);
                }
                if($ruleName === self::RULES_UNIQUE)
                {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::getTableName();
                    $sql = "
                        SELECT * FROM {$tableName}
                        WHERE  {$uniqueAttr} = :attr
                    ";
                    $stmt = $this->getConn()->prepare($sql);
                    $stmt->bindValue(":attr",$value);
                    $stmt->execute();
                    $record = $stmt->fetchObject(); 
                    if($record) 
                    {
                        $this->addError($attribute,self::RULES_UNIQUE,['field'=> $this->getLabels($attribute)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }


    /**
     * addError với rule đi kèm
     */
    public function  addError(string $attribute,string $rule,array $params = [] )
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach($params as $key => $value)
        {
            $message = str_replace("{{$key}}",$value,$message); // {{}} sẽ thay cho \{ \}
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * addErrorForNotRule không có rule đi kèm
     */
    public function  addErrorForNotRule(string $attribute,string $message )
    {
        $this->errors[$attribute][] = $message;
    }

    public function errorMessages() : array
    {
        return [

            self::RULES_REQUIRED => "Trường này là bắt buộc",
            self::RULES_MIN => "Độ dài tối thiểu của trường này phải là {min}",
            self::RULES_MAX => "Độ dài tối đa của trường này phải là {max}",
            self::RULES_MATCH => "Trường này phải giống như {match}",
            self::RULES_EMAIL => "Trường này phải là địa chỉ email hợp lệ",
            self::RULES_UNIQUE => "{field} này đã tồn tại mời nhập lại",
        ];
    }

    public function hasError($attribute) 
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     * @param int $index là thứ tự của phần tự trong array errors[attribute][$index]
     */
    public function getError(string $attribute,int $index = 0) 
    {
        return $this->errors[$attribute][$index] ?? false;
    }


    /**
     * là method quy định html label dưới view được overiwte ở các class con
     * có nhiệm vụ chuyển tên attribute của các table trên database thành các string Tiếng Việt, giống như là title của các attribute vậy, tên attribute được hiển thị ra
     */
    public function labels() : array 
    {
        return [];    
    }


    /**
     * để hiện dùng ở method hasError thị tên labels giống với messages error dưới Field
     * 
     */
    public function getLabels($attribute) 
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

}
abstract class DbModel extends Models
{
    public function rules() : array
    {
        return [];
    }

    abstract static public function getTableName() : string;

    // abstract public function getClassName() : string; // tại fetchObject(static::class) nên ko cần lấy được tên class,dùng class nào là do intance lúc gọi của class nào là nó tự động tìm được tên class để truyền vào , args truyền vào param tự động

    abstract static public function getAttributes() : array; 

    abstract static public function getPrimaryKey() : string; //origin nó ko phải là static method


    public function save() : bool
    {
        $tableName = $this->getTableName(); // ở đây tableName() do các class con định nghĩa nên instance ở đây đang là class User, $this->tableName() là action của class User
        $attributes = $this->getAttributes();
        $params = array_map( fn($attr)=> ":$attr" ,array_values($attributes)); // arrow function  bỏ {} thì là bằng  {return}
        
        $attribute = implode(',',$attributes);
        $param = implode(',',$params); 

        $sql = "
            INSERT INTO {$tableName}
                ({$attribute})
            VALUES
                ({$param})
        ";
        $stmt  = self::prepare($sql);
        foreach($attributes as $attribute)
        {
            $stmt->bindValue(":$attribute",$this->{$attribute}); //  $this->{$attribute} đang lấy ra tên property của class con, thế nên tên của các property của class con phải cùng tên với các attribute của table trên database
        }
        $stmt->execute();
        
        return true;
        
    }


    /**
     * prepare là static method- phương thức tỉnh của class DbModel, chứ ko phải method prepare của \PDO
     */
    public static function prepare($sql) //prepareWithOjectPdo, pdo là 1 property của class Database, (Database)db là 1 property của (Application)app
    {
        return parent::getConn()->prepare($sql);
    }


    /**
     * @param array $where nó giống $data của mvc codeniter, là 1 array k=>v mảng liên kết chứa attribute => valueAttributes 
     * origin nó ko phải là static method
     */
    public static function findOne(array $where) // ['email'=> 'useradminroot@gmail.com','ho'=>'le']
    {
        $tableName = static::getTableName(); // self::getTableName();
        //  là 1 phương thức trừu tượng (abstract method) được định nghĩa ở các class con trả về 1 string là tên của table tương ứng với model làm nhiệm vụ với table đó
        $attributes = array_keys($where);
        // select * from $tableName where email = :email AND ho = :ho;
        $strWhere = implode('AND',array_map(fn($attr) => "$attr = :$attr" , $attributes ));
        $sql = "
            SELECT * FROM {$tableName}
            WHERE {$strWhere};
        ";
        $stmt = self::prepare($sql);
        foreach($where as $key => $item)
        {
            $stmt->bindValue(":$key",$item);
        }
        $stmt->execute();
        // return $stmt->fetchObject(static::class); // tại fetchObject(static::class) nên ko cần lấy được tên class,dùng class nào là do intance lúc gọi của class nào là nó tự động tìm được tên class để truyền vào , args truyền vào param tự động
        $result = $stmt->fetchObject(static::class);
        if ($result === false) {
            return null;
        }
        return $result;
    }


}
abstract class UserModel extends DbModel
{

    abstract public function getDisplayName() : string;
}

