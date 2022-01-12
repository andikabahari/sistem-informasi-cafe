<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MyAuth
{
    private static $table = 'pengguna';
    private static $primary = 'id_pengguna';
    private static $passwordAlgo = PASSWORD_DEFAULT;
    private static $passwordOption = [
        'cost' => 10
    ];

    public static function id()
    {
        return Session::get(self::$primary);
    }

    public static function data()
    {
        return DB::table(self::$table)->where(self::$primary, self::id())->first();
    }

    public static function check()
    {
        return ! empty(self::data());
    }

    public static function login($username, $password)
    {
        $data = DB::table(self::$table)->where('username', $username)->first();

        if (empty($data)) {
            return false;
        }

        if ( ! self::verify($password, $data->password)) {
            return false;
        }

        Session::put(self::$primary, $data->{self::$primary});
        
        return true;
    }

    public static function logout()
    {
        Session::remove(self::$primary);
    }

    public static function hash($password)
    {
        return password_hash($password, self::$passwordAlgo, self::$passwordOption);
    }

    public static function verify($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}