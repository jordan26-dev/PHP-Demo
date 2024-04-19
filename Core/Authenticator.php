<?php


namespace Core;

class Authenticator {

    
    public function attempt($email, $password)
    {
        
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if ($user)
        {
            if (password_verify($password, $user['password']))
            {
                $this->login($user);

                return true;                
            }   
        }

        return false;
    }

    public function login($user)
    {
        // login the user and create a session.
        $_SESSION['user'] = [
            'email' => $user['email'],
            'user_id' => $user['id']
        ];

        session_regenerate_id(true);
    }

    public function logout()
    {
        // log the user out.
        Session::destroy();
        
    }

}