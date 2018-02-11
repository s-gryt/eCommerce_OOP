<?php


class Database
{
    private static $db = null;
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_name = 'ecom_oop';
    public $conn;

    private function __construct()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            die();
        }
    }

    public static function instance()
    {
        if (Database::$db === null) {
            Database::$db = new Database();
        }
        return Database::$db;
    }

    public function getAllProducts()
    {
        $query = "SELECT * FROM " . Product::$table_name;
        $stmt = $this->conn->query($query); // built in query method;
        $products = [];
        while ($row = $stmt->fetch()) {
            $product = new Product();
            $product->id = $row['id'];
            $product->title = $row['title'];
            $product->category_id = $row['category_id'];
            $product->price = $row['price'];
            $product->quantity = $row['quantity'];
            $product->description = $row['description'];
            $product->created = $row['created'];
            $product->modified = $row['modified'];
            array_push($products, $product);
        }
        return $products;
    }

    public function getProduct($id)
    {
        $query = "SELECT * FROM " . Product::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        $stmt->execute();
        $product = null;
        while ($row = $stmt->fetch()) {
            $product = new Product();
            $product->id = $row['id'];
            $product->title = $row['title'];
            $product->category_id = $row['category_id'];
            $product->price = $row['price'];
            $product->quantity = $row['quantity'];
            $product->description = $row['description'];
            $product->created = $row['created'];
            $product->modified = $row['modified'];
        }
        return $product;
    }

    public function addProduct($title, $category_id, $price, $quantity, $description)
    {
        $query = "INSERT INTO " . Product::$table_name . "(title, category_id, price, quantity, description) VALUES(?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('sifis', $title, $category_id, $price, $quantity, $description);
        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . Product::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        return $stmt->execute();
    }

    //CATEGORY

    public function getAllCategories()
    {
        $query = "SELECT * FROM " . Category::$table_name;
        $stmt = $this->conn->query($query); // built in query method;
        $categories = [];
        while ($row = $stmt->fetch()) {
            $category = new Category();
            $category->id = $row['id'];
            $category->title = $row['title'];
            array_push($categories, $category);
        }
        return $categories;
    }

    public function getCategory($id)
    {
        $query = "SELECT * FROM " . Category::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        $stmt->execute();
        $category = null;
        while ($row = $stmt->fetch()) {
            $category = new category();
            $category->id = $row['id'];
            $category->title = $row['title'];
        }
        return $category;
    }

    public function addCategory($title)
    {
        $query = "INSERT INTO " . Category::$table_name . "(title) VALUES(?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('s', $title);
        return $stmt->execute();
    }

    public function deleteCategory($id)
    {
        $query = "DELETE FROM " . Category::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        return $stmt->execute();
    }

    //USER

    public function getAllUsers()
    {
        $query = "SELECT * FROM " . User::$table_name;
        $stmt = $this->conn->query($query); // built in query method;
        $users = [];
        while ($row = $stmt->fetch()) {
            $user = new User();
            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->email = $row['email'];
            $user->image = $row['image'];
            array_push($users, $user);
        }
        return $users;
    }

    public function getUser($id)
    {
        $query = "SELECT * FROM " . User::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        $stmt->execute();
        $user = null;
        while ($row = $stmt->fetch()) {
            $user = new User();
            $user->id = $row['id'];
            $user->username = $row['username'];
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->password = $row['password'];
            $user->role = $row['role'];
            $user->email = $row['email'];
            $user->image = $row['image'];
        }
        return $user;
    }

    public function addUser($username, $firstname, $lastname, $password, $email, $image, $role = 'subscriber')
    {
        $query = "INSERT INTO " . User::$table_name . "(username, firstname, lastname, `password`, email, image, role) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('sssssss', $username, $firstname, $lastname, $password, $email, $image, $role);
        return $stmt->execute();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM " . User::$table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('i', $id);
        return $stmt->execute();
    }

}

