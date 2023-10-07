<?php

namespace App\Auth;



use App\Storage\DB;
use PDO;
use PDOException;

class Users
{
    public DB $db;
    public function __construct()
    {
        $this->db = new DB();
    }
    public function registration($formData)
    {
        try {
            $name = $formData['name'];
            $email = $formData['email'];
            $password = $formData['password'];
            $role = 'customer';
            $checkEmailSql = "SELECT * FROM users WHERE email = :email";
            $checkEmailStmt = $this->db->conn->prepare($checkEmailSql);
            $checkEmailStmt->bindParam(':email', $email, PDO::PARAM_STR);
            $checkEmailStmt->execute();
            if ($checkEmailStmt->rowCount() > 0) {
                //header("Location:index.php? error=email_exists");
                echo "Email Already Exists ";
                //echo "Email Exists";
                exit();
            } else if (strlen($password) < 6) {
                // Password is too short, handle the error (e.g., redirect to registration page with an error message)
                // header("Location: registration_form.php?error=password_length");
                echo "Password is too short, handle the error";
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                //! INSER STATEMENT HERE 
                $sql = "INSERT INTO users (name,email,password,role) VALUES('$name','$email','$password','$role')";
                $stmt = $this->db->conn->prepare($sql);

                $stmt->execute();
                echo "Data Register";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function loginUser($formData)
    {
        try {
            $email = $formData['email'];
            $password = $formData['password'];
            $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify password
            if (
                $user && password_verify($password, $user['password'])
            ) {
                // Password is correct, login successful
                echo "Login successful!";
                // You can redirect the user to another page here
            } else {
                // Invalid email or password, handle the error (e.g., redirect back to the login page with an error message)
                header("Location: login.html?error=invalid_login");
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
