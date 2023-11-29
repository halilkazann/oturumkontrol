<?php
// Kullanıcı verilerini örnek olarak dizide tutalım
$users = [
    ["id" => 1, "username" => "user1"],
    ["id" => 2, "username" => "user2"],
    ["id" => 3, "username" => "user3"]
];

// İstek yönlendirmesi
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

switch ($method) {
    case 'GET':
        if ($request[0] === 'users') {
            if (isset($request[1])) {
                $userId = intval($request[1]);
                getUser($userId);
            } else {
                getUsers();
            }
        }
        break;
    case 'POST':
        if ($request[0] === 'users') {
            addUser();
        }
        break;
    case 'PUT':
        if ($request[0] === 'users' && isset($request[1])) {
            $userId = intval($request[1]);
            updateUser($userId);
        }
        break;
    case 'DELETE':
        if ($request[0] === 'users' && isset($request[1])) {
            $userId = intval($request[1]);
            deleteUser($userId);
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function getUsers() {
    global $users;
    echo json_encode($users);
}

function getUser($id) {
    global $users;
    $user = array_filter($users, function ($user) use ($id) {
        return $user['id'] === $id;
    });
    echo json_encode(array_values($user));
}

function addUser() {
    global $users;
    $data = json_decode(file_get_contents("php://input"), true);
    $newUserId = count($users) + 1;
    $newUser = ['id' => $newUserId, 'username' => $data['username']];
    $users[] = $newUser;
    echo json_encode($newUser);
}

function updateUser($id) {
    global $users;
    $data = json_decode(file_get_contents("php://input"), true);
    foreach ($users as &$user) {
        if ($user['id'] === $id) {
            $user['username'] = $data['username'];
            echo json_encode($user);
            return;
        }
    }
    header("HTTP/1.0 404 Not Found");
}

function deleteUser($id) {
    global $users;
    foreach ($users as $key => $user) {
        if ($user['id'] === $id) {
            unset($users[$key]);
            echo json_encode(['message' => 'User deleted']);
            return;
        }
    }
    header("HTTP/1.0 404 Not Found");
}
?>