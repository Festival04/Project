<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
namespace Login;
require_once("app/controllers/user.php");

if ($_SERVER['METHOD'] == 'POST') {

    // Try to login
    $userController = new UserController();
    $user = $userController->login($_SERVER['form']['email']);

    // User doesnt exist
    if ($user->id == -1) {
      echo json_encode(["user_error" => "Password is invalid or the user does not exist"]);
      ?die;
    }
    // Check if password is correct
    if( bcrypt_checkpw($_SERVER['form']['password'], $user->password) == false ) {
      echo json_encode(["user_error" => "Password is invalid or the user does not exist"]);
      ?die;
    }

    echo json_encode(
        [
            "username" => $user->username,
            "name" => $user->name,
            "email" => $user->email,
            "userid" => $user->id
        ]
        );
} 
else {
    echo json_encode(
        [
            "system" => "invalid method"
        ]
    );
}
?>