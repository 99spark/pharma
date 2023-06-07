<?php
class Controller
{
    /**
     *
     */
    private $_f3;   // F3 object

    /**
     * @param $_f3
     */
    public function __construct($_f3)
    {
        $this->_f3 = $_f3;
    }

    /**
     *
     * function home
     *
     */

    function home()
    {
        $drugCode = "";
          if($_SERVER['REQUEST_METHOD'] == 'POST')
          {
                $drugCode = $_POST["drugCode"];

                $currentDate = $GLOBALS['dataLayer']->getCurrentDate();

                $quarter = $currentDate['quarter'];
                $year = $currentDate['year'];

                $period = $currentDate["period_id"];

                $drugPrices = $GLOBALS['dataLayer']->getDrugByPeriod($period,$drugCode);

//                $strQtr = $_POST["first-quarter-select"];
//                $strYear = intval($_POST["first-year-select"]);
//                $endQtr = $_POST["first-quarter-select"];
//                $endYear = intval($_POST["first-year-select"]);

//               $twoDrugPrices = $GLOBALS['dataLayer']->getDrugPrices($drugCode,$strQtr,$strYear,$endQtr,$endYear);

               $this->_f3->set('drugPrices',$drugPrices);
               $this->_f3->set('quarter',$quarter);
               $this->_f3->set('year',$year);
               //$drugFirstPrice = $twoDrugPrices["payment_limit"];

               

          }
        $this->_f3->set('drugCode', $drugCode);

//        echo "<h1> Hello from home </h1>";
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function login()
    {
        if(!empty($_SESSION["pharmaUser"]))
        {
            $this->_f3->reroute("user");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // if there is a user email
            if (!empty($_POST['email'])) {
                global $dataLayer;
                $account = $dataLayer->getUserByUseremail($_POST['email']);
                // if there is no saved "account"
                if ($account === false) {
                    $this->_f3->set('errors["email"]', 'Could not find your Account.');
                } else {
                    // if there is a password
                    if (!empty($_POST['password'])) {
                        if ($_POST['password'] === $account['password']) {

                           // $account->login();
                        } else {
                            $this->_f3->set('errors["password"]', 'Password was wrong. Please try again.');
                        }
                    } else {
                        $this->_f3->set('errors["password"]', 'Enter a password.');
                    }
                }
            } else {
                $this->_f3->set('errors["email"]', 'Enter a email.');
            }

            if (empty($this->_f3->get('errors'))) {
                $_SESSION["pharmaUser"] = $account;
                $this->_f3->reroute('user');
            }
        }

        $this->_f3->set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $this->_f3->set('password', isset($_POST['password']) ? $_POST['password'] : "");
        $view = new Template();
        echo $view->render('views/login.html');
    }

    public function user()
    {
        if(empty($_SESSION["pharmaUser"]))
        {
            $this->_f3->reroute("userLogin");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $drug = $_POST["drug1"];
            $drug2 = $_POST["drug2"];
            $drug3 = $_POST["drug3"];
            $drug4 = $_POST["drug4"];
            $strQtr = $_POST["first-quarter-select"];
            $strYear = $_POST["first-year-select"];
            $endQtr = $_POST["second-quarter"];
            $endYear = $_POST["second-year"];

            $multipleDrugPrices = $GLOBALS['dataLayer']->getDrugPrices($drug,$drug2,$drug3,$drug4,$strQtr,$strYear,$endQtr,$endYear);

           // var_dump($multipleDrugPrices);

            $this->_f3->set("drugPrices",$multipleDrugPrices);
            $this->_f3->set("drug1",$drug);
            $this->_f3->set("drug2",$drug2);
            $this->_f3->set("drug3",$drug3);
            $this->_f3->set("drug4",$drug4);

        }



            $view = new Template();
        echo $view->render('views/user.html');

    }
    public function passwordupdate()
    {
        $view = new Template();
        echo $view->render('views/passwordupdate.html');

    }





    public function adminLogin()
    {
        if(!empty($_SESSION["adminUser"]))
        {
            $this->_f3->reroute("admin");
        }

        $user = "";
        $pass = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            require $_SERVER['DOCUMENT_ROOT'].'/../adminconfig.php';
            $user = $_POST['username'];
            $pass = $_POST['password'];

            if($user != $adminUser)
            {
                $this->_f3->set('err["adminUser"]','Username is incorrect');
            }

            if($pass != $adminPass)
            {
                $this->_f3->set('err["adminPass"]','Password is incorrect');

            }

            if (empty($this->_f3->get('err')))
            {

                $_SESSION["adminUser"] = $user;

                $this->_f3->reroute('admin');

            }


        }



        $view = new Template();
        echo $view->render('views/adminLogin.html');
    }

    public function register()
    {
        //Initialize input variables
        $fname = "";
        $lname = "";
        $email = "";
        $userInstitution = "";

        //If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {



            $fname = $_POST['name'];
            $password = $_POST['password'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $userInstitution = $_POST['userInstitution'];


            if(!Validator::validFname($fname)) {
                //$_SESSION['name']->setUserFirst($_POST['name']);
                $this->_f3->set('err["name"]','This field cannot be empty');

            }


            if(!Validator::validLname($lname))
            {
                $this->_f3->set('err["lname"]','This field cannot be empty');
            }

            if(!Validator::validEmail($email))
            {
                $this->_f3->set('err["email"]','Please enter a valid email');
            }
            else {
                if (Validator::accountExists($email)) {
                    $this->_f3->set('err["email"]', 'This email is already taken.');
                }
            }



            if(!Validator::validInstitution($userInstitution))
            {
                $this->_f3->set('err["userInstitution"]','Please enter a number that is between 0-100');
            }
            if(!Validator::validPassword($password)) {
                //Set an error
                $this->_f3->set('err["password"]', '10-64 characters, includes any letter/number or !@#$%^&* characters');
            }


//            //Validate the data
//            if (!Validator::validUsername($username)) {
//                //Set an error
//                $this->_f3->set('errors["username"]', '3-16 characters, does not start with a number');
//            }
//
//            if (!Validator::validPassword($password)) {
//                //Set an error
//                $this->_f3->set('errors["password"]', '10-64 characters, includes any letter/number or !@#$%^&* characters');
//            }

            //Redirect user to next page if there are no errors
            if (empty($this->_f3->get('err'))) {
                // global $dataLayer;
             //   $account = new User($username, $password);
              //  $account->register();

                $hashed_password =password_hash($password,PASSWORD_DEFAULT);

                $newUser = new User($fname,$lname,$email,$userInstitution,$hashed_password);

                $GLOBALS['dataLayer']->saveUser($newUser);

               // $this->_f3->reroute('confirm');

                $this->_f3->reroute('userLogin');
            }
        }

//        $this->_f3->set('username', $username);
//        $this->_f3->set('password', $password);
        $this->_f3->set('name', isset($_POST['name']) ? $_POST['name'] : "");
        $this->_f3->set('lname', isset($_POST['lname']) ? $_POST['lname'] : "");
        $this->_f3->set('email', isset($_POST['email']) ? $_POST['email'] : "");
        $this->_f3->set('password', isset($_POST['password']) ? $_POST['password'] : "");
        $this->_f3->set('userInstitution', isset($_POST['userInstitution']) ? $_POST['userInstitution'] : "");




        $view = new Template();
        echo $view->render('views/register.html');
    }

    public function confirm()
    {
        $view = new Template();
        echo $view->render('views/confirm.html');
    }

    public function adminLogout()
    {
        $_SESSION['adminUser'] = null;
        $this->_f3->reroute('admin');
    }

    public function logout()
    {
        $_SESSION["pharmaUser"] = null;
        $this->_f3->reroute('userLogin');
    }

    public function admin()

    {
        if(empty($_SESSION['adminUser']))
        {
            $this->_f3->reroute('adminLogin');
        }

        global $dataLayer;
        $member = $GLOBALS['dataLayer']->getMembers();
//        $member = $dataLayer->getMembers();
        $this->_f3->set('member',$member);

//        $database = "pharmadp_pharma";
//        $password = "1aVALZdti^f_";
//        $user = "pharmadp_admin";
//        $host = "localhost";
//
//        $cnxn = mysqli_connect($host, $user, $password, $database)
//        or die("error connecting to data base" . mysqli_connect_error());
//        echo 'connected to database!';
        if (isset($_POST['submit'])) {
            if (isset($_FILES['FilesToUpload'])) {
                $file = $_FILES['FilesToUpload'];
                // define valid file types
                $validTypes = array('text/csv');
                $dirName = 'uploads/';
                //check size - 2 mb max
                if ($_SERVER['CONTENT_LENGTH'] > 3000000) {
                    echo "<p class='error'>File is too large. max file size is 3mb. </p>";
                }//check file type
                else if (in_array($file['type'], $validTypes)) {
                    if ($file['error'] > 0) {
                        echo "<p class='error'>Return Code: {$file['error']}</p>";
                    }
                    if (file_exists($dirName . $file['name'])) {
//            echo "<p class='error'>Error uploading:“;
                        echo "<p class='error'>error uploading: ";
                        echo $file['name'] . " already exist. </p>";
                    } else {

//                    parse file
                        $lineCounter =1;
                        $handle = fopen($_FILES['FilesToUpload']['tmp_name'], "r");
                        while ($data = fgetcsv($handle)) {

                            //get date from file
                            if($lineCounter==3)
                            {
                                $mon = explode(" ",$data[0]);
                                //beginning month name
                                $bmonth = $mon[1];

//                              $bday = $mon[2];

                                // begging month year
                                $bdate = $mon[3];

                                //begging month day
                                $bday = str_replace(',', '', $mon[2]);

                                //ending month name
                                $emonth = $mon[5];

                                //ending month day
                                $eday = str_replace(',', '', $mon[6]);;

                                $edate = $mon[7];

                                //concantinate date for date function
                                $datform = $bmonth . " " . $bday . " " . $bdate;
                                $datform2 = $emonth . " " . $eday . " " . $edate;


                                //format date
                                $date = date('Y-m-d', strtotime($datform));

                                $date2 = date("Y-m-d",strtotime($datform2));

                                $period = explode("-",$date);

                                $fromMonth = $period[1];
                                $currentYear = $period[0];

                                echo "From month: " . $fromMonth;

                                echo "Current year: " . $currentYear;

                                $periodId = $GLOBALS['dataLayer']->getPeriod($fromMonth,$currentYear);

                                $newPeriodId = $periodId["period_id"];

                                echo "<p> This should be a number: $newPeriodId  </p>";

                                echo "<br>";

                                echo $bmonth . " " . $bday . " " . $bdate . " found it begining month<br> ";
                                echo $emonth . " " . $eday . " " . $bdate . " found end dates<br> ";
                                echo " date form works " . $date;
                                echo " date form ends " . $date2;
                            }

//                           echo $mon . "this is mon ";
//                            if (in_array("Effective",$mon)) {
//
//
//                            }
                            if($lineCounter>9) {

                                  $item0 = $data[0];
                                  $item1 = $data[1];
                                  $item2 = $data[2];
                                  $item3 = $data[3];
                                  $item4 = $data[4];
                                  $item5 = $data[5];
                                  $item6 = $data[6];
                                  $item7 = $data[7];
                                  $item8 = $data[8];
                                  $item9 = $data[9];

                                  $drug = new Drug($item0,$newPeriodId,$item1,$item2,$item3,$item4,$item5,$item6,$item7,$item8,$item9);

                                  $drugPeriod = $drug->getPeriod();
                                  $drug->setPeriod(intval($drugPeriod));

                                  $drugPrice = $drug->getPaymentLimit();
                                  if($drugPrice == "N/A")
                                  {
                                      $drug->setPaymentLimit(-1.00);
                                  }
                                  else
                                  {
                                    $drug->setPaymentLimit(floatval($drugPrice));
                                  }

                                  $GLOBALS["dataLayer"]->saveDrug($drug);



//                                $item0 = mysqli_real_escape_string($cnxn,$data[0]);
//                                $item1 = mysqli_real_escape_string($cnxn,$data[1]);
//                                $item2 = mysqli_real_escape_string($cnxn,$data[2]);
//                                $item3 = mysqli_real_escape_string($cnxn,$data[3]);
//                                $data[3] =  doubleval($data[3]);
                            //                            echo $item0;
//                                ('90375',10,'srt-dsc','code dosage',6.13,'vac%','vac-lim','blood%','blood-limit','clott-fact','saveDrug() working');
//                                $drug1 = new Drug($data[0],10,$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[9]);
//                                echo var_dump($drug1);
//                                $GLOBALS['Datalayer']->saveDrug($drug1);
//                                $dataLayer->saveDrug($drug1);
//                                insert file into sqldatabase
//                                $query = "INSERT into drugs2(hcpsc_code, drug_name, hcpsc_code_dosage, payment_limit)
//                                                    values( '$item0','$item1','$item2','$item3')";
//
//
//                                mysqli_query($cnxn, $query);
                            }
                            $lineCounter++;
                        }
                        fclose($handle);
                        echo "<script>alert('Import done');</script>";


                        //move file to upload dir
                        move_uploaded_file($file['tmp_name'], $dirName . $file['name']);
                        echo "<p class='success'>Uploaded {$file['name']} successfully!</p>";


                    }
                } else {
                    echo "<p class='error'>invalid file type. allowed types : csv </p>";
                }

            }
        }
            $view = new Template();
            echo $view->render("views/admin.html");


    }


} // class controller

