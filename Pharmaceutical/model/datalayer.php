<?php

require $_SERVER['DOCUMENT_ROOT'].'/../config.php';

class datalayer
{
    private $_dbh;

    /**
     * This constructor connects to the database using passed in credentials.
     * If successful a PDO object will be created, if not an error will occur.
     */
    function __construct()
    {
        try {
            //Instantiate a PDO database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo "Yay!";
        } catch (PDOException $e) {
            echo "Error connecting to database " . $e->getMessage();
        }
    }
    public function insertUser(User $user): string
    {
        $sql = "INSERT INTO user (username, password)
                VALUES (:username, :password)";

        $statement = false;
        try {
            $statement = $this->_dbh->prepare($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        $params = array(
            ':username'   => $user->getUsername(),
            ':password'   => $user->getPassword()
        );

        try {
            $statement->execute($params);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        return $statement->fetch();
    }


    /**
     * grabs the user based on the user's username
     * @param string $user_username
     * @return array|false
     */
    public function getUserByUsername($user_username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";

        $statement = false;
        try {
            $statement = $this->_dbh->prepare($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        $params = array(':username' => $user_username);
        try {
            $statement->execute($params);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        return $statement->fetch();
    }

   






}