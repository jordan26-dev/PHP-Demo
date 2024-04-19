<?php

use Core\App;
use Core\Database;
use Core\Validator;


$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']['user_id'] ?? false;



// find the corresponding note
$note = $db->query("SELECT * FROM notes WHERE id = :id", [
    'id' => $_POST['id']
    ])->findOrFail();



// authorization that the current user can edit the note
authorize($note['user_id'] === $currentUserId);


// validate the form
$errors = [];

if(! Validator::string($_POST['body'] ?? '', 1, 1000))    
{
    $errors['body'] = "A body of no more than 1,000 characters is required.";
}


if (! empty($errors)) 
{
    view('notes/edit.view.php', [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
    
}

// if there are no errors update the record in the database table

$db->query("UPDATE notes SET body = :body WHERE id = :id ", [
    'body' => $_POST["body"],
    'id' => $_POST["id"]
]);


// redirect the user
redirect('/notes');

   

