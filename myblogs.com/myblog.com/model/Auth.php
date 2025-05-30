<?php 
require_once('koneksi.php');

class Auth extends koneksi {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function login($email, $password) {
        if (strpos($email, '@') === false) {
            $email .= '@gmail.com';
        }

        $stmt = $this->conn->prepare("SELECT * FROM auth WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $query = $stmt->get_result();

        if ($query->num_rows > 0) {
            $row = $query->fetch_array(MYSQLI_ASSOC);

            if (password_verify($password, $row['password'])) {
                $row['nama'] = $row['nama'] ?? 'User';
                return $row;
            }
        }

        return false;
    }
}
