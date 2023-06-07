<?php
/**
 * Validates usernames
 * @param string $username
 * @return bool
 */
class Validator{

//    /**
//     * Validates whether the account exists. Returns true if it does, false if it doesn't
//     * @param string $username
//     * @return bool true if account exists, false if it does not
//     */
    static function accountExists(string $email): bool
    {
        global $dataLayer;
        return !($dataLayer->getUserByUseremail($email) === false);
    }




    static function validFname($fname)
    {
        return !empty($fname);
    }


    static function validLname($lname)
    {
        return !empty($lname);
    }

    static function validEmail($email)
    {
        if (preg_match('/^([a-z0-9.-]+)@([\da-z.-]+).([a-z.]{2,6})$/', $email)) {
            return true;
        }
        return false;

    }

    static function validInstitution($institution):bool
    {
        return !empty($institution);
    }



    static function validUsername($username)
    {
        // is not empty, and
        // does not start with a number or whitespace, and is
        // made up of more than 3 but less than 16 letters, numbers, and dashes
        return !empty($username) && preg_match("/^[^\d\W][\w\d-]{2,16}$/", $username) === 1;
    }

    /**
     * Validates passwords
     * @param $password
     * @return bool
     */
    static function validPassword($password)
    {
        // is not empty, and
        // allows the use of letters, numbers, and specific symbols
        // no less than 10 characters, no more than 64 characters
        return !empty($password) && preg_match("/^[\w\d]{10,60}$/", $password) === 1;
        //return !empty($password) && preg_match("/^[\w\d!@#$%^&*]{10,64}$/", $password) === 1;
    }

//    static function accountExists(string $email): bool
//    {
//        global $dataLayer;
//        return !($dataLayer->getUserByUseremail($email) === false);
//    }
}
