<?php
// require the database credentials
require_once $_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php';

/**
 *
 */
class Datalayer
{
    //add a field to store the database connection object
    private  $_dbh;

    // Define a constructor
    function __construct()
    {
        try {
            // Instantiate a POD database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME,DB_PASSWORD);
//           echo "<h3>yay! connection successful</h3><br>";

        }
        catch (PDOException $e){
            echo "Error connecting to the database ".$e->getMessage();
        }

    }
//password_hash(string $password, string|int|null $algo, array $options = []): string


    function saveUser($newUser){
        // 1. Define the query

       $sql ="INSERT INTO `users`(`user_first`, `user_last`, `user_email`, `user_institution_FK`, `password`)
                           VALUES(:user_first,  :user_last,  :user_email,  :user_institution_FK, :password) ";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':user_first',$newUser->getUserFirst());
        $statement->bindParam(':user_last', $newUser->getUserLast());
        $statement->bindParam(':user_email',$newUser->getUserEmail());
        $statement->bindParam(':password',$newUser->getPassword());
        $statement->bindParam(':user_institution_FK',$newUser->getUserInstitutionFK());

        //4. Execute the query
        $statement->execute();

       // 5. process the result
        $id = $this->_dbh->lastInsertId();
//        echo "<h3>last id is </h3>".$id;
        return $id;



    }

    public function getCurrentDate()
    {
       $sql =  "SELECT quarter,year,period_id FROM periods WHERE NOW() BETWEEN from_date AND to_date";

       $statement = $this->_dbh->prepare($sql);

       $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;

    }


//    /**
//     * grabs the user based on the user's email
//     * @param string $email
//     * @return array|false
//     */
    public function getUserByUseremail($user_email)
    {
        $sql = "SELECT * FROM users WHERE user_email = :user_email";

        $statement = false;
        try {
            $statement = $this->_dbh->prepare($sql);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        $params = array(':user_email' => $user_email);
        try {
            $statement->execute($params);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }

        return $statement->fetch();
    }



    function getDrugByPeriod($period,$drugCode)
    {
        $sql = "SELECT * from drugs WHERE period = :period_id AND hcpsc_code  = :drug_code ";

        $statement = $this->_dbh->prepare($sql);

        $statement->bindParam(":period_id",$period);
        $statement->bindParam(":drug_code",$drugCode);

        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;

    }


    function getDrugPrices($drugCode,$drugCode2, $drugCode3, $drugCode4, $strQtr,$strYear,$endQtr,$endYear)
    {
        // 1. Define query
        $sql = "SELECT drugs.hcpsc_code, drugs.short_description, periods.from_date, periods.to_date, 
       periods.period_id,payment_limit, periods.quarter , periods.year , hcpcs_code_dosage FROM drugs 
        ,periods WHERE drugs.period = periods.period_id and (drugs.hcpsc_code = :drug1 OR drugs.hcpsc_code = :drug2 
        OR drugs.hcpsc_code = :drug3 OR drugs.hcpsc_code = :drug4) and (periods.period_id BETWEEN 
        (SELECT periods.period_id FROM periods WHERE periods.quarter = :strQtr and periods.year = :strYear) and 
            (SELECT periods.period_id FROM periods WHERE periods.quarter = :endQtr and periods.year = :endYear))";


//        SELECT drugs.hcpsc_code, drugs.short_description, periods.from_date, periods.to_date, periods.period_id,payment_limit, periods.quarter , periods.year
//FROM drugs ,periods
//WHERE drugs.period = periods.period_id  and drugs.hcpsc_code ='90375'
//    and  (periods.from_date
//
//BETWEEN
//(SELECT periods.from_date FROM periods WHERE periods.quarter = 3 and periods.year =2020)
//and
//(SELECT periods.to_date FROM periods WHERE periods.quarter = 2 and periods.year =2022))
//

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(":drug1",$drugCode);
        $statement->bindParam(":drug2",$drugCode2);
        $statement->bindParam(":drug3",$drugCode3);
        $statement->bindParam(":drug4",$drugCode4);
        $statement->bindParam(":strQtr",$strQtr);
        $statement->bindParam(":strYear",$strYear);
        $statement->bindParam(":endQtr",$endQtr);
        $statement->bindParam(":endYear",$endYear);

        //4. execute query
        $statement->execute();

        //5. Process results

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result;
    }



    function getPeriod($month,$year)
    {
        //1. Define the query

        $sql = "SELECT period_id FROM periods WHERE from_month = :fromMonth and year = :currentYear";

        //2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //3. Bind the parameters
        $statement->bindParam(':fromMonth',$month);
        $statement->bindParam(':currentYear',$year);

        //4. Execute the query
        $statement->execute();

        //5. proccess the result
        //$id = $this->_dbh->lastInsertId();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;


    }



  function saveDrug($newDrug)
  {
      // 1. Define the query

      $sql ="INSERT INTO `drugs`(`hcpsc_code`, `period`, `short_description`, `hcpcs_code_dosage`, `payment_limit`, `vacine_AWP_percent`, `vaccine_limit`, `blood_AWP_percent`, `blood_limit`, `clotting_Factor`, `notes`) 
                          VALUES(:hcpsc_code,  :periods,  :short_description,  :hcpcs_code_dosage,  :payment_limit,  :vacine_AWP_percent,  :vaccine_limit,  :blood_AWP_percent,  :blood_limit,  :clotting_Factor,  :notes) ";


//todo check if changing period to periods works for the second line of values

      //2. Prepare the statement
      $statement = $this->_dbh->prepare($sql);

      //3. Bind the parameters

      $statement->bindParam(':hcpsc_code', $newDrug->getHcpscCode());
      $statement->bindParam(':periods' , $newDrug->getPeriod());
      $statement->bindParam(':short_description', $newDrug->getShortDescription());
      $statement->bindParam(':hcpcs_code_dosage', $newDrug->getHcpcsCodeDosage());
      $statement->bindParam(':payment_limit', $newDrug->getPaymentLimit());
      $statement->bindParam(':vacine_AWP_percent', $newDrug->getVacineAWPPercent());
      $statement->bindParam(':vaccine_limit' , $newDrug->getVaccineLimit());
      $statement->bindParam(':blood_AWP_percent', $newDrug->getbloodAWPPercent());
      $statement->bindParam(':blood_limit', $newDrug->getbloodAWPPercent());
      $statement->bindParam(':clotting_Factor', $newDrug->getClottingFactor());
      $statement->bindParam(':notes',$newDrug->getNotes());
      

      
      //4. Execute the query
      $statement->execute();

      // 5. process the result
      $id = $this->_dbh->lastInsertId();
//      echo "<h3>last id is </h3>".$id;
      return $id;

  }

     function getMembers()
    {

//    define query
        $sql = "SELECT * FROM `users`";

        //2. prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //4. Execute the query
        $statement->execute();

        //5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}