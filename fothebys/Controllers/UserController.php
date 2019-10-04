<?php
namespace fothebys\Controllers;

class UserController
{
    private $userTable;
    private $get;
    private $post;

    public function __construct($userTable, array $get, array $post)
    {
        $this->userTable = $userTable;
        $this->get = $get;
        $this->post = $post;
    }

    public function loginForm($error = '')
    {
        return [
            'template' => 'loginForm.html.php',
            'variables' => ['error' => $error],
            'title' => "Fotheby's Auction House - Login"
        ];
    }

    public function loginSubmit()
    {
        if (!empty($this->post['email']) && !empty($this->post['password'])) {
            if ($user = $this->userTable->find('email', $this->post['email'])) {
                $hashed = $user[0]->password;
                if (password_verify($this->post['password'], $hashed)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['userID'] = $user[0]->id;
                    $_SESSION['usertype'] = $user[0]->status;
                    $_SESSION['approvedBuyer'] = $user[0]->buyerApprovedStatus;
                    header('location: /home');
                } else {
                    $error = 'Invalid password.';
                    return $this->loginForm($error);
                }
            } else {
                $error = 'Name or Password was Invalid';
                return $this->loginForm($error);
            }
        } else {
            $error = 'Name or Password was Empty or Invalid';
            return $this->loginForm($error);
        }
    }

    public function logout()
    {
        $_SESSION = array();
        session_destroy();
        header('location: /');
    }

    public function home()
    {
        if(isset($_SESSION['usertype'])){
        if ($_SESSION['usertype'] === 'ADMIN') {
            return [
                'template' => 'admin.home.html.php',
                'variables' => ['error' => ''],
                'title' => "Fotheby's Auction House - Admin Home"
            ];
        } else if ($_SESSION['usertype'] === 'SELLER' || $_SESSION['usertype'] === 'BUYER' || $_SESSION['usertype'] === 'JOINT') {
            return [
                'template' => 'user.home.html.php',
                'variables' => ['error' => ''],
                'title' => "Fotheby's Auction House - User Home"
            ];
        } else {
            return $this->loginForm();
        }
    } else {
        return $this->loginForm();
    }
    }

    public function editUser($errors = [])
    {
        if (isset($_GET['id'])) {
            $user = $this->userTable->find('id', $this->get['id'])[0];
        } else {
            $user = false;
        }
        return [
            'template' => 'createUserForm.html.php',
            'variables' => [
                'user' => $user,
                'errors' => $errors,
            ],
            'title' => "Fotheby's Auction House - Create Users"
        ];
    }

    public function saveUser()
    {
        if (isset($this->post['user']['password'])) {
            if ($this->post['user']['password'] === $this->post['password']['confirm_password']) {
                $this->post['user']['password'] = password_hash($this->post['user']['password'], PASSWORD_BCRYPT);
            } else {
                $errors[] = 'Please Passwords Didn\'t Match';
                $this->editUser($errors);
            }
        }
        $this->userTable->save($this->post['user']);
        header('location: /home');
    }

    public function viewUsers()
    {
        $users = $this->userTable->findAll();
        return [
            'template' => 'viewUsersForm.html.php',
            'variables' => [
                'users' => $users,
            ],
            'title' => "Fotheby's Auction House - View Users"
        ];
    }

    public function deleteUser()
    { 
        // Deletes Items
        $this->userTable->delete($this->post['id']);
        header('location: /admin/view/users');
    }
}
