<?php
class Drug
{

        private $_hcpsc_code;
        private $_period;
        private $_short_description;
        private $_hcpcs_code_dosage;
        private $_payment_limit;
        private $_vacine_AWP_percent;
        private $_vaccine_limit;
        private $_blood_AWP_percent;
        private $_blood_limit;
        private $_clotting_Factor;
        private $_notes;

    /**
     * @param $_hcpsc_code
     * @param $_period
     * @param $_short_description
     * @param $_hcpcs_code_dosage
     * @param $_payment_limit
     * @param $_vacine_AWP_percent
     * @param $_vaccine_limit
     * @param $_blood_AWP_percent
     * @param $_blood_limit
     * @param $_clotting_Factor
     * @param $_notes
     */
    public function __construct($_hcpsc_code, $_period, $_short_description, $_hcpcs_code_dosage, $_payment_limit, $_vacine_AWP_percent, $_vaccine_limit, $_blood_AWP_percent, $_blood_limit, $_clotting_Factor, $_notes)
    {
        $this->_hcpsc_code = $_hcpsc_code;
        $this->_period = $_period;
        $this->_short_description = $_short_description;
        $this->_hcpcs_code_dosage = $_hcpcs_code_dosage;
        $this->_payment_limit = $_payment_limit;
        $this->_vacine_AWP_percent = $_vacine_AWP_percent;
        $this->_vaccine_limit = $_vaccine_limit;
        $this->_blood_AWP_percent = $_blood_AWP_percent;
        $this->_blood_limit = $_blood_limit;
        $this->_clotting_Factor = $_clotting_Factor;
        $this->_notes = $_notes;
    }

    /**
     * @return mixed
     */
    public function getHcpscCode()
    {
        return $this->_hcpsc_code;
    }

    /**
     * @param mixed $hcpsc_code
     */
    public function setHcpscCode($hcpsc_code): void
    {
        $this->_hcpsc_code = $hcpsc_code;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->_period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period): void
    {
        $this->_period = $period;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->_short_description;
    }

    /**
     * @param mixed $short_description
     */
    public function setShortDescription($short_description): void
    {
        $this->_short_description = $short_description;
    }

    /**
     * @return mixed
     */
    public function getHcpcsCodeDosage()
    {
        return $this->_hcpcs_code_dosage;
    }

    /**
     * @param mixed $hcpcs_code_dosage
     */
    public function setHcpcsCodeDosage($hcpcs_code_dosage): void
    {
        $this->_hcpcs_code_dosage = $hcpcs_code_dosage;
    }

    /**
     * @return mixed
     */
    public function getPaymentLimit()
    {
        return $this->_payment_limit;
    }

    /**
     * @param mixed $payment_limit
     */
    public function setPaymentLimit($payment_limit): void
    {
        $this->_payment_limit = $payment_limit;
    }

    /**
     * @return mixed
     */
    public function getVacineAWPPercent()
    {
        return $this->_vacine_AWP_percent;
    }

    /**
     * @param mixed $vacine_AWP_percent
     */
    public function setVacineAWPPercent($vacine_AWP_percent): void
    {
        $this->_vacine_AWP_percent = $vacine_AWP_percent;
    }

    /**
     * @return mixed
     */
    public function getVaccineLimit()
    {
        return $this->_vaccine_limit;
    }

    /**
     * @param mixed $vaccine_limit
     */
    public function setVaccineLimit($vaccine_limit): void
    {
        $this->_vaccine_limit = $vaccine_limit;
    }

    /**
     * @return mixed
     */
    public function getBloodAWPPercent()
    {
        return $this->_blood_AWP_percent;
    }

    /**
     * @param mixed $blood_AWP_percent
     */
    public function setBloodAWPPercent($blood_AWP_percent): void
    {
        $this->_blood_AWP_percent = $blood_AWP_percent;
    }

    /**
     * @return mixed
     */
    public function getBloodLimit()
    {
        return $this->_blood_limit;
    }

    /**
     * @param mixed $blood_limit
     */
    public function setBloodLimit($blood_limit): void
    {
        $this->_blood_limit = $blood_limit;
    }

    /**
     * @return mixed
     */
    public function getClottingFactor()
    {
        return $this->_clotting_Factor;
    }

    /**
     * @param mixed $clotting_Factor
     */
    public function setClottingFactor($clotting_Factor): void
    {
        $this->_clotting_Factor = $clotting_Factor;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->_notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes): void
    {
        $this->_notes = $notes;
    }



    



}