<?php namespace Aliakbar\UrlShortener\Traits;


trait Authentication {

    public $id;

    public $username;

    public $passcode;

    public function login()
    {

        $user = $this->where('username', $this->username)->first();

        if(! $user )
        { return false; }

        if(! password_verify($this->passcode, $user->passcode))
        { return false; }

        session()->set('user_id', $user->id);
        session()->set('username', $user->username);

        return true;
    }

    public function hash($pass)
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }


    public function check(): bool
    {
        if(session()->exists('user_id')) {
            $user = $this->find(session()->get('user_id'));
            if( $user )
            { return true; }
            session_destroy();
        }

        return false;
    }

    public function user()
    {
        if($this->check()) {
            $user = $this->find(session()->get('user_id'));
            if( $user )
            { return $user; }
        }
        return $this;
    }


    public function logout()
    {
       if($this->check()) {
            session_destroy();
       }
    }

}
