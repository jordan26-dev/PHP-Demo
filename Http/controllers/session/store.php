<?php


use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

// validate the form
if ($form->validate($email, $password))
{
    // check if there is a corresponding user email in the database
    if ((new Authenticator)->attempt($email, $password)) 
    {       
        redirect('/');
    } 

    $form->error('email', 'No matching account found for that email address and password.');
}

Session::flash('errors', $form->errors());
Session::flash('old', [
    'email' => $email
]);


redirect('/login');
    
    
   
    


