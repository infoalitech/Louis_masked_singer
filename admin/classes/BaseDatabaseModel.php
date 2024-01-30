<?php 
namespace classes;
include_once 'DatabaseManager.php'; // Adjust the path accordingly



use classes\DatabaseManager;

class BaseDatabaseModel {
    protected static $conn;

    public function __construct() {
        // Ensure the static connection is initialized
        if (!isset(self::$conn)) {
           self::connect();
        }
    }
    public static function connect() {
        // Check if the connection has already been established
        if (!isset(self::$conn)) {
            // Create a DatabaseManager instance
            $databaseManager = new DatabaseManager();
            
            // Retrieve the database connection from DatabaseManager
            self::$conn = $databaseManager->getConn();
            
            // Optionally, you might want to handle connection errors here
            if (self::$conn->connect_error) {
                die("Connection failed: " . self::$conn->connect_error);
            }
        }
    }

    public static function getAll() {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName";
        $databaseManager = new DatabaseManager();
        self::$conn = $databaseManager->getConn();
        $result = self::$conn->query($sql);
    
        if ($result->num_rows > 0) {
            $items = array();
            while ($row = $result->fetch_assoc()) {
                $item = new static(); // Create an instance of the derived class
    
                // Iterate through the database result and assign values to properties
                foreach ($row as $column => $value) {
                    $camelCaseColumn = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $column))));
                    $item->$camelCaseColumn = $value;
                }
    
                $items[] = $item;
            }
    
            return $items;
        } else {
            return array();
        }
    }
    
    
    public static function getById($id) {
        $tableName = static::$tableName; // Use the tableName attribute
        $sql = "SELECT * FROM $tableName WHERE id = ?";
        if (!self::$conn) {
            self::connect();
        }
        $stmt = self::$conn->prepare($sql);
        if (!$stmt) {
            // Print or log the SQL error
            echo "SQL Error: " . self::$conn->error;
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();


        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $item = new static(); // Create an instance of the derived class
            $row = $result->fetch_assoc();
            foreach ($row as $column => $value) {
                $camelCaseColumn = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $column))));
                $item->$camelCaseColumn = $value;
            }
            return $item;
        } else {
            return null;
        }
    }

    public static function getByColumn($columnName, $value) {
        $tableName = static::$tableName;
        $sql = "SELECT * FROM $tableName WHERE $columnName = ?";
        
        if (!self::$conn) {
            self::connect();
        }
    
        $stmt = self::$conn->prepare($sql);
    
        if (!$stmt) {
            // Print or log the SQL error
            echo "SQL Error: " . self::$conn->error;
            return false;
        }
    
        $stmt->bind_param("s", $value); // Assuming the column is of type VARCHAR, change "s" if needed
        $stmt->execute();
    
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $items = array();
    
            while ($row = $result->fetch_assoc()) {
                $item = new static(); // Create an instance of the derived class
    
                foreach ($row as $column => $columnValue) {
                    $camelCaseColumn = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $column))));
                    $item->$camelCaseColumn = $columnValue;
                }
    
                $items[] = $item;
            }
    
            return $items;
        } else {
            return array();
        }
    }
    

    public function save() {
        print("test2");;

        $tableName = static::$tableName;
        $attributes = $this->getObjectAttributes();
        print("test3");;

        if (empty($attributes)) {
            return false; // No attributes to save
        }
        print("test3");;

        $columns = implode(', ', array_keys($attributes));
        $values = "'" . implode("', '", array_values($attributes)) . "'";

        $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

        // print_r($sql);

        if (!self::$conn) {
            echo "Database connection not established.";
            return false;
        }
        $stmt = self::$conn->prepare($sql);
        print_r($sql);
        if (!$stmt) {
            // Print or log the SQL error
            echo "SQL Error: " . self::$conn->error;
            return false;
        }
        print_r($stmt);

        return $stmt->execute();
    }

    public function update($id) {
        $tableName = static::$tableName;
        $attributes = $this->getObjectAttributes();

        if (empty($attributes)) {
            return false; // No attributes to update
        }

        $updates = array();
        foreach ($attributes as $key => $value) {
            $updates[] = "$key = '$value'";
        }

        $updatesStr = implode(', ', $updates);

        $sql = "UPDATE $tableName SET $updatesStr WHERE id = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    private function getObjectAttributes() {
        $attributes = get_object_vars($this);
    
        // Exclude properties that shouldn't be saved (like the database connection and tableName)
        unset($attributes['conn']);
        unset($attributes['tableName']);
        unset($attributes['id']);
    
        // Convert camel case to snake case for database column names
        $snakeCaseAttributes = array_map(function ($key) {
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));
        }, array_keys($attributes));
    
        // Combine the original camel case properties with the corresponding snake case properties
        $combinedAttributes = array_combine($snakeCaseAttributes, $attributes);
    
        return $combinedAttributes;
    }
    public function handleImageUpload($fileInputName, $targetDirectory)
    {
        $targetPath = $targetDirectory . basename($_FILES[$fileInputName]['name']);
        $uploadOk = true;
        $error_message = '';
    
        // Check if the file already exists
        if (file_exists($targetPath)) {
            $error_message = 'Sorry, this file already exists.';
            $uploadOk = false;
            return ['success' => true,'file_path' => $targetPath, 'error_message' => $error_message];

        }
    
        // Check file size (optional)
        if ($_FILES[$fileInputName]['size'] > 500000) {
            $error_message = 'Sorry, your file is too large.';
            $uploadOk = false;
        }
    
        // Allow certain file formats (you can customize this based on your requirements)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif','webp'];
        $fileExtension = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    
        if (!in_array($fileExtension, $allowedExtensions)) {
            $error_message = 'Sorry, only JPG, JPEG, PNG, and GIF files are allowed.';
            $uploadOk = false;
        }
    
        // Check if $uploadOk is set to false by an error
        if (!$uploadOk) {
            return ['success' => false, 'error_message' => $error_message];
        } else {
            // Try to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetPath)) {
                return ['success' => true, 'file_path' => $targetPath];
            } else {
                return ['success' => false, 'error_message' => 'Sorry, there was an error uploading your file.'];
            }
        }
    }
    
    public function handleVideoUpload($fileInputName, $targetDirectory)
    {
        $targetPath = $targetDirectory . basename($_FILES[$fileInputName]['name']);
        $uploadOk = true;
        $error_message = '';

        // Check if the file already exists
        if (file_exists($targetPath)) {
            return ['success' => true, 'file_path' => $targetPath];
            $error_message = 'Sorry, this file already exists.';
            $uploadOk = false;
        }

        // Check file size (optional)
        if ($_FILES[$fileInputName]['size'] > 50000000) { // Adjust the size limit as needed
            $error_message = 'Sorry, your file is too large.';
            $uploadOk = false;
        }

        // Allow certain file formats for videos (you can customize this based on your requirements)
        $allowedExtensions = ['mp4', 'avi', 'mov', 'mkv'];
        $fileExtension = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            $error_message = 'Sorry, only MP4, AVI, MOV, and MKV files are allowed.';
            $uploadOk = false;
        }

        // Check if $uploadOk is set to false by an error
        if (!$uploadOk) {
            return ['success' => false, 'error_message' => $error_message];
        } else {
            // Try to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetPath)) {
                return ['success' => true, 'file_path' => $targetPath];
            } else {
                return ['success' => false, 'error_message' => 'Sorry, there was an error uploading your file.'];
            }
        }
    }
    public function delete($id) {
        $tableName = static::$tableName;
        $sql = "DELETE FROM $tableName WHERE id = ?";
        
        if (!self::$conn) {
            self::connect();
        }
    
        $stmt = self::$conn->prepare($sql);
    
        if (!$stmt) {
            // Print or log the SQL error
            echo "SQL Error: " . self::$conn->error;
            return false;
        }
    
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
