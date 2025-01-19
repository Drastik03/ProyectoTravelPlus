<?php
require_once './model/dao/UserDao.php';
require_once './model/dto/User.php';
require_once './helpers/redirect.php';
class UserController
{
    private $model;
    public function __construct()
    {
        $this->model = new UserDAO();
    }
    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
        if (empty($page) || $page < 1 || $limit < 1) {
            header('Location: index.php?app=user&action=index&page=1');
            exit;
        }
        $totalUsers = $this->model->getTotalUsers();
        $totalPages = ceil($totalUsers / $limit);
        if ($page > $totalPages) {
            header('Location: index.php?app=user&action=index&page=' . $totalPages);
        } else {
            $offset = ($page - 1) * $limit;
            $users = $this->model->getAllUsers($limit, $offset);
        }
        require_once './view/user/user.list.php';
    }

    public function register_new()
    {
        require_once './view/user/register.php';
    }
    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            $this->redirectWithMessage(false, "Método no permitido", "El método utilizado no es permitido", "index.php?app=user&f=index");
            return;
        }
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';
        if (!empty($name) && !empty($lastName) && !empty($username) && !empty($password)) {
            $user = new User();
            $user->__set('name', $name);
            $user->__set('lastName', $lastName);
            $user->__set('username', $username);
            $user->__set('password', $password);
            $user = $this->cleandData($user);
            $hashedPassword = password_hash($user->__get('password'), PASSWORD_BCRYPT);
            $user->__set('rol_id', 1);
            $user->__set('password', $hashedPassword);
            $result = $this->model->insert($user);
            if ($result) {
                $this->redirectWithMessage(
                    true,
                    'El usuario se ha creado correctamente',
                    'No se pudo registrar al usuario',
                    'index.php?app=user&action=index'
                );
            } else {
                $this->redirectWithMessage(
                    false,
                    'No se pudo registrar al usuario',
                    'Hubo un problema al intentar registrar el usuario',
                    'index.php?app=user&action=index'
                );
            }
        }
    }
    public function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errMsg;
        $_SESSION['color'] = ($exito) ? 'primary' : 'danger';
        header("Location: $redirectUrl");
        exit();
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = isset($_POST['username']) ? htmlentities(trim($_POST['username'])) : '';
            $password = isset($_POST['password']) ? htmlentities(trim($_POST['password'])) : '';

            $user = $this->model->getUserByUsername($username);
            if ($user) {
                $storedPassword = $user->password;
                if (password_verify($password, $storedPassword)) {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['username'] = $user->username;
                    $_SESSION['id'] = $user->id;
                    $_SESSION['user_logged_in'] = true;
                    header('Location: index.php?app=index&action=index');
                    exit();
                } else {
                    $this->redirectWithMessage(false, '', 'Usuario o contraseña incorrectos', 'index.php?app=user&action=login');
                }
            } else {
                $this->redirectWithMessage(false, '', 'Usuario o contraseña incorrectos', 'index.php?app=user&action=login');
            }
        } else {
            require_once './view/user/login.php';
        }
    }


    public function cleandData($user)
    {
        $user->__set('name', htmlspecialchars(trim($user->__get('name'))));
        $user->__set('lastName', htmlspecialchars(trim($user->__get('lastName'))));
        $user->__set('username', trim($user->__get('username')));
        $user->__set('password', trim($user->__get('password')));
        return $user;
    }
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?app=user&action=login');
        exit();
    }
}
