<?php

class User
{

        private $_user_first;
        private $_user_last;
        private $_user_email;
        private $_password;
        private $_user_institution_FK;

    /**
     * @param $_user_first
     * @param $_user_last
     * @param $_user_email
     * @param $_user_institution_FK
     */
    public function __construct($_user_first, $_user_last, $_user_email, $_user_institution_FK,$_password)
    {
        $this->_user_first = $_user_first;
        $this->_user_last = $_user_last;
        $this->_user_email = $_user_email;
        $this->_password = $_password;
        $this->_user_institution_FK = $_user_institution_FK;
    }

    /**
     * @return mixed
     */
    public function getUserFirst()
    {
        return $this->_user_first;
    }

    /**
     * @param mixed $user_first
     */
    public function setUserFirst($user_first): void
    {
        $this->_user_first = $user_first;
    }

    /**
     * @return mixed
     */
    public function getUserLast()
    {
        return $this->_user_last;
    }

    /**
     * @param mixed $user_last
     */
    public function setUserLast($user_last): void
    {
        $this->_user_last = $user_last;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->_user_email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->_password = $password;
    }


    /**
     * @param mixed $user_email
     */
    public function setUserEmail($user_email): void
    {
        $this->_user_email = $user_email;
    }

    /**
     * @return mixed
     */
    public function getUserInstitutionFK()
    {
        return $this->_user_institution_FK;
    }

    /**
     * @param mixed $user_institution_FK
     */
    public function setUserInstitutionFK($user_institution_FK): void
    {
        $this->_user_institution_FK = $user_institution_FK;
    }

    






}