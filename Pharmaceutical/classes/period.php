<?php

class Period
{
private $_from_date;
private $_to_date;
private $_quarter;
private $_year;

    /**
     * @param $_from_date
     * @param $_to_date
     * @param $_quarter
     * @param $_year
     */
    public function __construct($_from_date, $_to_date , $_quarter, $_year)
    {
        $this->_from_date = $_from_date;
        $this->_to_date = $_to_date;
        $this->_quarter = $_quarter;
        $this->_year = $_year;
    }

    /**
     * @return mixed
     */
    public function getFromDate()
    {
        return $this->_from_date;
    }

    /**
     * @param mixed $from_date
     */
    public function setFromDate($from_date): void
    {
        $this->_from_date = $from_date;
    }

    /**
     * @return mixed
     */
    public function getToDate()
    {
        return $this->_to_date;
    }

    /**
     * @param mixed $to_date
     */
    public function setToDate($to_date): void
    {
        $this->_to_date = $to_date;
    }

    /**
     * @return mixed
     */
    public function getQuarter()
    {
        return $this->_quarter;
    }

    /**
     * @param mixed $quarter
     */
    public function setQuarter($quarter): void
    {
        $this->_quarter = $quarter;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->_year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->_year = $year;
    }








}