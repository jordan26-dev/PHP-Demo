<?php


use Core\Authenticator;
use Http\Forms\LoginForm;


// validate the form
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);


$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

// check if there is a corresponding user email in the database
if (! $signedIn) 
{     
    $form->error(
        'email', 
        'No matching account found for that email address and password.'
    )->throw();    
} 

redirect('/');







    
    
   
    


