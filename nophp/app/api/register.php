<?php
// 02.2024 Artur Z (HUSKI3@GitHub)
namespace Register;
require_once("app/controllers/user.php");


if ($_SERVER['METHOD'] == 'POST') {

    // Username is empty
    if ( empty($_SERVER['form']['username']) ) { 
        echo json_encode(["username_error" => "Username can not be blank"]); 
        die();
    }
    // Email is empty
    if ( empty($_SERVER['form']['email']) ) {
        echo json_encode(["email_error" => "Email can not be blank"]); 
        die();
    }
    // Password is empty
    if ( empty($_SERVER['form']['password']) ) {
        echo json_encode(["password_error" => "Password can not be blank"]); 
        die();
    }
    // Name is empty
    if ( empty($_SERVER['form']['name']) ) { 
        echo json_encode(["name_error" => "Name can not be blank"]); 
        die();
    }
    // Check if the password and verify password match
    if ($_SERVER['form']['password'] != $_SERVER['form']['vpassword']) {
        echo json_encode(["vpassword_error" => "Passwords dont match"]);
        die();
    }

    // Hash the password
    $salt = bcrypt_gensalt(12);
    $hashed = bcrypt_hashpw($_SERVER['form']['password'], $salt);

    // Try to register
    $userController = new UserController();
    $user = $userController->register(
        $_SERVER['form']['email'], 
        $_SERVER['form']['name'], 
        $_SERVER['form']['username'], 
        $hashed
    );

    if ($user->id == -1) {
        echo json_encode(
            [
                "system" => "failed to register user. Most likely a user already exists"
            ]
        );
        die();
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