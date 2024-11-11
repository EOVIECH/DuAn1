<?php
    require_once 'config.php';
    class ConnectDB
    {
        public $PDO;
        public $SQL;
        public $Sta;

        public function __construct()
        {   
            try
            {
                $this -> PDO =  new PDO(
                    'mysql:host='. DB_HOST .';dbname=' . DB_NAME . ';charset='.DB_CHARSET, DB_USERNAME, DB_PASSWORD 
                );

                $this -> PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo 'CONNECT SUCCESS';
            }catch(PDOException $e)
            {
                echo 'ERROR '. $e->getMessage();
            }
        }

        public function setQuery($sql) {
            $this->SQL = $sql;
        }
        // hàm này sẽ làm hàm chạy câu truy vấn
        public function execute($options=array()) {
            try {
                // Chuẩn bị câu truy vấn SQL
                $this->Sta = $this->PDO->prepare($this->SQL);
    
                // Nếu có options (các giá trị để bind)
                if($options) {
                    // Lặp qua từng option
                    for($i=0;$i<count($options);$i++) {
                        // Bind tham số ở index $i+1 với giá trị tương ứng trong mảng $options
                        $this->Sta->bindParam($i+1,$options[$i]);
                    }
                }
    
                // Thực thi câu truy vấn đã chuẩn bị
                $this->Sta->execute();
    
                // Trả về câu truy vấn đã chuẩn bị
                return $this->Sta;
            } catch (PDOException $e) {
                // Xử lý ngoại lệ PDOException
                // Ở đây có thể log lỗi, thông báo cho người dùng hoặc thực hiện các hành động khác
                // Ví dụ:
                echo "Lỗi khi thực thi truy vấn: " . $e->getMessage();
                // hoặc
                // throw $e; // Chuyển ngoại lệ để xử lý ở nơi khác nếu cần
            }
        }
    //    Truy vấn
        public function loadData($options=array(),$getAllData = true) {
            try {
                // Nếu không có options được cung cấp
                if(!$options) {
                    // Thực thi truy vấn mặc định
                    if(!$result = $this->execute())
                        return false;
                }
                else {
                    // Nếu có options, thực thi truy vấn với các options đã cho
                    if(!$result = $this->execute($options))
                        return false;
                }
                if($getAllData == true){
                    // Trả về tất cả các hàng từ kết quả truy vấn dưới dạng một mảng các đối tượng
                    return $result->fetchAll(PDO::FETCH_OBJ);
                }else {
                    return $result->fetch(PDO::FETCH_OBJ);
                }
            } catch (PDOException $e) {
                // Xử lý ngoại lệ PDOException
                // Có thể log lỗi, thông báo cho người dùng hoặc thực hiện các hành động khác
                // Ví dụ:
                echo "Lỗi truy vấn: " . $e->getMessage();
                // hoặc
                // throw $e; // Chuyển ngoại lệ để xử lý ở nơi khác nếu cần
            }
        }
    
    }
?>