<?php

class Institution
{


    private $_institution_id;
    private $_institution_name;
    private $_institution_city;
    private $_institution_state;
    private $_insitution_zip;

    /**
     * @param $_institution_id
     * @param $_institution_name
     * @param $_institution_city
     * @param $_institution_state
     * @param $_insitution_zip
     */
    public function __construct($_institution_id, $_institution_name, $_institution_city, $_institution_state, $_insitution_zip)
    {
        $this->_institution_id = $_institution_id;
        $this->_institution_name = $_institution_name;
        $this->_institution_city = $_institution_city;
        $this->_institution_state = $_institution_state;
        $this->_insitution_zip = $_insitution_zip;
    }

    /**
     * @return mixed
     */
    public function getInstitutionName()
    {
        return $this->_institution_name;
    }

    /**
     * @param mixed $institution_name
     */
    public function setInstitutionName($institution_name): void
    {
        $this->_institution_name = $institution_name;
    }

    /**
     * @return mixed
     */
    public function getInstitutionCity()
    {
        return $this->_institution_city;
    }

    /**
     * @param mixed $institution_city
     */
    public function setInstitutionCity($institution_city): void
    {
        $this->_institution_city = $institution_city;
    }

    /**
     * @return mixed
     */
    public function getInstitutionState()
    {
        return $this->_institution_state;
    }

    /**
     * @param mixed $institution_state
     */
    public function setInstitutionState($institution_state): void
    {
        $this->_institution_state = $institution_state;
    }

    /**
     * @return mixed
     */
    public function getInsitutionZip()
    {
        return $this->_insitution_zip;
    }

    /**
     * @param mixed $insitution_zip
     */
    public function setInsitutionZip($insitution_zip): void
    {
        $this->_insitution_zip = $insitution_zip;
    }







}