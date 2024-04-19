<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$db = App::resolve(Database::class);


$errors = [];   
// validate the form

if (! Validator::email($email))
{
    $errors['email'] = 'Please provide a valid email.';
}

if (! Validator::string($password, 7, 255))
{
    $errors['password'] = 'Please provide a password with at least 7 characters.';
}


if (! empty($errors))
{
    require view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


// check if the acount already exists

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();


// if yes, redirect to a login page.
if ($user)
{
    header('location: /');
    exit();
} 
else 	// if not, save one to the database, and then log the user in, and redirect.
{
    $db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    // creates the session and redirect the user
    (new Authenticator)->login($user);

    redirect('/');    
}

	
