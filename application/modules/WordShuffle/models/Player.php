<?php

/**
 * TODO: record description
 * 
 * @package WordShuffle_Model
 * @class   WordShuffle_Model_Player
 *
 * @property   string      name          Player's name.  The setter for this property monitors if new value is different than previous value.  Given a new value, setter sets "saveIsPending" and clears the "secret" property.  Any change to this value must also validate player "signInState" as described in the DETAILED SPECIFICATIONS below.
 * @property   string      secret        Answer to challenge question
 * @property   int        signInState    Flags if user requires login versus playing anonymously.  The backend API closely controls this property.  The value only proxies what is stored within the session variable "signInState".  The backend API does not allow for setting this property to SIGNED_IN.  This only happens through the login() method, in which case the method will directly set the session variable "signInState" to SIGNED_IN when the user successfully authenticates.  This is to stop URL mangling at the frontend side in an attempt to bypass the login process.
 * @property   string     defaultName    Identifies default name for anonymous users.  The backend API provides this information.  Setting of this property is not allowed.
 * @property   array      challenges     Challenge question choices provided by the backend API as read from the database.  Setting of this property is not allowed.
 * @property   int       idChallenge     The primary key for the challenge question selected by the Player.  When set and Player.save executed, the backend API uses this value to store the new challenge question for the Player.
 * @property   string    challenge       Challenge question selected by the Player as read from the database.  This question displays to the user as an authentication challenge if the backend determines that the Player.name exists within the database.  If the frontend sets this value, it will not matter to the backend.  The backend only uses idChallenge to determine the value for this property.
 * @property   int      secondsPerRound  Total time in a complete round.  If the user does not have a currently active game, the backend grabs this value from the last game completed by the player.  When the Player starts a new game, this information configures that game.
 * @property   int      roundsPerGame    Number of rounds in a complete game.  If the user does not have a currently active game, the backend grabs this value from the last game completed by the player.  When the Player starts a new game, this information configures that game.
 * @property   boolean  saveIsPending    Flags if Player object requires save.
 *
 *

 */
class WordShuffle_Model_Player extends Common_Abstracts_Model
{

    /*****************************
     * CLASS CONSTANTS declaration
     *****************************/


    const   DEFAULT_PLAYER = 0;

    /**
     * << description of init >>
     * Typically, this method validates the properties with session state to determine if it is appropriate.
     * Also, this is the time for writing session information as appropriate.
     *
     **/
    protected function init()
    {
		parent::init();
		
		// todo: itemize any model properties which should be excluded from the model when sending response
		$this->excludeFromJSON(array('secret'));

        $this->_defaultName="santosh";
        $this->_challenges=array();

        //Create a Challenge Object with default property as Santosh
       //$challengeModel = new WordShuffle_Model_Player_Challenge(array('defaultName'=>'Santosh'));

        //  Get all Rows as every row has defaultName filed with Value Santosh
        //$challengesArray = $challengeModel->findAll(array('defaultName'));

        // It uses the mapper setChallenges method to get all the challenges
        $challengesArray = $this->Mapper->setChallenges(array('defaultName'));

        // If you get some results make the challenge array out of it...
        if(count($challengesArray)>0)
        {
            foreach($challengesArray as $val)
            {
                $arr=array();
                $arr['value']=$val['id'];
                $arr['Question']=$val['challenge'];
                $this->_challenges[]=$arr;
            }
        }

        // if the resulting array is zero
         else
        {
            $this->SysMan->Logger->info(" I am in the else section ");
            throw new Exception(" No Challenges Found ");
        }
    }

    /************************************
     * MODEL PROPERTIES SETTERS / GETTERS
     ************************************/

    // todo: move property docblock to top of class
    /**
     * @property    int         id
     */
    private $id = null;
    protected function setId($value){

        // checks the id is changed or not

        if($this->SysMan->Session->idPlayer!=$value)
        {
            $GLOBALS['idChanged']=1;
        }
        else
        {
            $GLOBALS['idChanged']=0;
        }


        $this->id = (int) $value;
    }
    protected function getId(){
        return $this->id;
    }


    // todo: move property docblock to top of class
    /**
     * @property   string         name
     */
    private $_name = null;
    protected function setName($value){


        // If name is equal to default name then set as Anonymous Player with a message that name is not unavailable ...
        if(strtolower($value)=='santosh'&& ($this->SysMan->Session->signInState!=20))
        {
            $this->signInState=0;
            $this->id=0;
            $this->find();
            $this->Msg=array(array("type"=>"danger","text"=>"Sorry User Name is Not Available."));
        }

        // checks the player is changed or not

        if($this->SysMan->Session->playerName!=$value)
        {
            $GLOBALS['nameChanged']=1;
        }
        else
        {
            $GLOBALS['nameChanged']=0;
        }

        $this->_name = (string) $value;
    }
    protected function getName(){
        return $this->_name;
    }


    private $_secret = null;
    protected function setSecret($value){
        if($value!="")
        {
            $this->_secret = (string)$value;
        }
    }
    protected function getSecret(){
        return $this->_secret;
    }

    private $_signInState = null;
    protected function setSignInState($value){

      // checks the signInState is changed or not
        if($this->SysMan->Session->signInState!=$value)
        {
            $GLOBALS['signInStateChanged']=1;
        }
        else
        {
            $GLOBALS['signInStateChanged']=0;
        }


        $this->_signInState =  $value;
    }
    protected function getSignInState(){
        return $this->_signInState;
    }


    // todo: move property docblock to top of class
    /**
     * @property    string        defaultName
     */
    private $_defaultName = null;
    protected function setDefaultName($value){
        $this->_defaultName = (string) $value;
    }
    protected function getDefaultName(){
        return $this->_defaultName;
    }


    // todo: move property docblock to top of class
    /**
     * @property    array         challenges
     */
    private $_challenges = null;
    protected function setChallenges($value){
        $this->_challenges = (array) $value;
    }
    protected function getChallenges(){
        return $this->_challenges;
    }

    private $_idChallenge = null;
    protected function setIdChallenge($value){

            $this->_idChallenge = (int) $value;

    }
    protected function getIdChallenge(){
        return $this->_idChallenge;
    }

    private $_challenge = null;
    protected function setChallenge($value){
        if($value!="")
        {
            $this->_challenge = (string)$value;
        }

    }
    protected function getChallenge(){
        return $this->_challenge;
    }

    private $_secondsPerRound = null;
    protected function setSecondsPerRound($value){
        $this->_secondsPerRound = (int) $value;
    }
    protected function getSecondsPerRound(){
        return $this->_secondsPerRound;
    }


    private $_roundsPerGame = null;
    protected function setRoundsPerGame($value){
        $this->_roundsPerGame = (int) $value;
    }
    protected function getRoundsPerGame(){
        return $this->_roundsPerGame;
    }
    
    // todo: move property docblock to top of class
    /**
     * @property    boolean         saveIsPending
     */
    private $_saveIsPending = null;
    protected function setSaveIsPending($value){
        $this->_saveIsPending = (boolean) $value;
    }
    protected function getSaveIsPending(){
        return $this->_saveIsPending;
    }
    



    /****************************************
     * MODEL PUBLIC METHODS declaration / definition
     ****************************************/

   // Function Meant for Login Purposes
   public function login()
   {
       /*In the login function, model is set and sent back and result array is empty and wont set anything...*/

       $this->_preLogin();
       /*  Model is already setup...now  check its signInState */
       $state = $this->signInState;

       $results=array();

       // if Name is Pending
       if($state==1)
       {
           $this->SysMan->Logger->info(" In The Name Pending Section");
           $this->SysMan->Logger->info("Before find all operation");
           // Find all Players with Given Name
           $arr=$this->findAll(array('name'));
           $this->SysMan->Logger->info("The returned array is   ",print_r($arr,true));

           //Find one existing Record
           if(count($arr)==1)
           {
               $this->SysMan->Logger->info("Success One Row ".'{'.PHP_EOL.print_r($arr,true).'}');
               $this->SysMan->Logger->info("STARTING TO PRINT ARRAY");
               $this->SysMan->Logger->info(print_r($arr[0],true));
               $this->SysMan->Logger->info("ENDING TO PRINT ARRAY");
               //Setup the Model using the resulting array
               $this->setFromArray($arr[0]);

               // Store the Model id into the session variable
               //Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('gapp','idPlayer'));
               //Zend_Auth::getInstance()->getStorage()->write($this->id);

               $this->SysMan->Session->idPlayer=$this->id;
               $this->SysMan->Logger->info(" In The Latest Section");

              // $challengeModel = new WordShuffle_Model_Player_Challenge(array('id'=>$this->idChallenge));
               //$resArray=$challengeModel->findAll(array('id'));
               $resArray = $this->Mapper->getChallengeQuestion(array('idChallenge'));

               $challenge=$resArray[0]['challenge'];

               //Sending Model instead of result Array

               $this->signInState=10;

               $this->SysMan->Session->signInState=$this->signInState;
               $this->SysMan->Session->playerName=$this->name;

               $this->Msg=array(array("type"=>"success","text"=>"Welcome back! Please answer your secret question to start playing!"));

               $this->challenge=$challenge;

               $this->excludeFromJSON(array('secondsPerRound','roundsPerGame'));


              // $results=array("Msg"=>array(array("type"=>"success","text"=>"Welcome back! Please answer your secret question to start playing!")),"signInState"=>10,"challenge"=>$challenge);
               $results= array();

               return $results ;
           }
           // If no records found
           elseif(count($arr)==0)
           {
               $this->SysMan->Logger->info("Success zero Row ");
               $this->Msg=array(array("type"=>"success","text"=>"Good news!  The user name is available, please pick your secret question to secure your new user!"));

               $this->signInState=5;

               $this->SysMan->Session->signInState=$this->signInState;
               $this->SysMan->Session->playerName=$this->name;

               //$results=array("Msg"=>array(array("type"=>"success","text"=>"Good news!  The user name is available, please pick your secret question to secure your new user!")),"signInState"=>5);
               $results= array();
               return $results;
           }

           // If more than one records found
           else
           {
               $this->SysMan->Logger->info("More Than One Row ".$arr);
               throw new Exception('More Than one Records Available');
           }

       }


       // If New Sign In
       elseif($state==5)
       {
           $this->SysMan->Logger->info(" In The Name is New Sign In Section");
           // Check for the existing record
           $arr=$this->findAll(array('name'));
           // If one Record exist..pretend as the request for login
           if(count($arr)==1)
           {
               //  Set the Model using the resulting Record...
               $this->setFromArray($arr);

               //Create a challenge Object
               //$challengeModel = new WordShuffle_Model_Player_Challenge(array('id'=>$this->idChallenge));

               // Get the Associated challenge Question Array
               $resArray = $this->getChallenge(array('idChallenge'));

              //Grab the challenge Question
               $challenge=$resArray['challenge'];

               // Store the Model id into the session variable
               $this->SysMan->Session->idPlayer=$this->id;
               $this->SysMan->Logger->info(" In The Latest Section");

               $this->Msg=array(array("type"=>"success","text"=>"Welcome back! Please answer your secret question to start playing!"));

               $this->signInState=10;

               $this->SysMan->Session->signInState=$this->signInState;

               $this->challenge=$challenge;

               $this->excludeFromJSON(array('secondsPerRound','roundsPerGame'));

               //$results=array("Msg"=>array(array("type"=>"success","text"=>"Welcome back! Please answer your secret question to start playing!")),"signInState"=>10,"challenge"=>$challenge);

               $results=array();
               return $results;
           }

           // Save the user data
           elseif(count($arr)==0)
           {
               //Make id equals to null
               $this->id=null;
               // use Mapper save method to insert an array
               $pk=$this->Mapper->save();
               if($pk!=null&&$pk>0)
               {
                   $this->SysMan->Session->idPlayer=$pk;
                   $this->SysMan->Logger->info(" In The Latest Section");
                   $this->SysMan->Session->signInState=20;

                   $this->Msg=array(array("type"=>"success","text"=>"Your new player is ready to go!  Configure your defaults and start playing!!"));

                   $this->saveIsPending=1;

                   $this->signInState=20;

                   $this->SysMan->Session->signInState=$this->signInState;

                   $this->id=$pk;

                   $this->excludeFromJSON(array('secondsPerRound','roundsPerGame'));

                  // $results=array("Msg"=>array(array("type"=>"success","text"=>"Your new player is ready to go!  Configure your defaults and start playing!!")),"saveIsPending"=>1,"signInState"=>20,"id"=>$pk,"secondsPerRound"=>"120","roundsPerGame"=>"3");
                    $results=array();
               }
               else
               {
                   $this->Msg=array(array("type"=>"danger","text"=>"Failed to save player information for some reason"));

                      $this->signInState=5;

                   $this->SysMan->Session->signInState=$this->signInState;

                     //$results=array("Msg"=>array(array("type"=>"danger","text"=>"Failed to save player information for some reason")),"signInState"=>5);
                     $results=array();
               }

             return $results;

           }

           else
           {
               $this->SysMan->Logger->info("More Than One Row ".$arr);
               throw new Exception('More Than one Records Available');
           }
       }


       //If Secret Pending
       elseif($state==10)
       {
           $this->SysMan->Logger->info(" In THE  New Secret PENDING Section");
           $this->SysMan->Logger->info("In New code");
           //Getting the Provided secret Password
           $secret=$this->_secret;

          //  Mapper Authentication function will do the Authentication for us ...
          $validate=$this->Mapper->authenticateUser($secret);

           if($validate)
           {
               // Getting the Player id from the Session variable
               $userId=$this->SysMan->Session->idPlayer;
               $this->id=$userId;
               $this->SysMan->Logger->info(" In The NEw to new Section");
               $this->SysMan->Logger->info(" I am in the Player Model");
               $this->find();

               // Setup the signInState in session variable to "SIGNED_IN"
               $signedIn=20;
               $this->SysMan->Session->signInState=$signedIn;
               $this->_saveToSession();

               $this->Msg=array(array("type"=>"success","text"=>"Secret accepted!  You are ready for play!!"));

               $this->signInState=20;

               $results=array();
               // Response Message if Authentication Successful ... send user id back for update operation ...

               //$results=array("Msg"=>array(array("type"=>"success","text"=>"Secret accepted!  You are ready for play!!")),"signInState"=>20,"id"=>$userId,"secondsPerRound"=>$this->_secondsPerRound,"roundsPerGame"=>$this->_roundsPerGame,"idChallenge"=>$this->_idChallenge);
           }
           else
           {
               // Response Message if Authentication not Successful

               $this->Msg=array(array("type"=>"danger","text"=>"Secret rejected!  Please try again!!"));
               $this->signInState=10;
               $this->SysMan->Session->signInState=$this->signInState;
               $this->excludeFromJSON(array('secondsPerRound','roundsPerGame'));
               $results=array();
               //$results=array("Msg"=>array(array("type"=>"danger","text"=>"Secret rejected!  Please try again!!")),"signInState"=>10);
               $this->SysMan->Logger->info(" In The  NEw Mapper Based else Authentication Section");
           }

           return $results;

       }

            return $results;
   }

   // Remove Function meant for logout
    public function remove()
    {
        // As the deleteAction does not allow to send model there is no way to set new configuration when th eplayer logs out...we can update the deleteAction method to do so...
        $this->SysMan->Session->idPlayer=0;
        $this->SysMan->Session->signInState=0;
        $this->SysMan->Session->idChallenge=0;
        $this->SysMan->Session->playerName='santosh';
        $this->SysMan->Session->roundsPerGame=3;
        $this->SysMan->Session->secondsPerRound=120;
        return "Log Out Successful";
    }

    /**
     * Save Function meant updating the Player info to the database
     */
    public function save()
    {
        // Read the id of the player from the session variable
        $id=$this->SysMan->Session->idPlayer;
        $signInState=$this->SysMan->Session->signInState;
        if($id>0&&$signInState==20)
        {
            // when the Player name is different from the Anonymous Play..and i am doing name check here instead at setter because save function will anyways run,,we can do in that way also but some flag has to be generated at the setter side and should be used in the save function
            if (strtolower($this->name) != "santosh") {
                // Find a Record using the Provided Name..
                $arr = $this->findAll(array('name'));
                $this->SysMan->Logger->info("Array Found " . "{{" . PHP_EOL . print_r($arr, true) . "}}");

                // If one record found ...Then amy be same name or already taken name is sent for updation
                if (count($arr) == 1) {
                    // If same name is sent then simply update
                    if ($arr[0]['id'] == $id) {
                        $this->SysMan->Logger->info("I am in Same Name Section");
                        $this->Mapper->save();

                        $this->_saveToSession();
                        $this->Msg = array(array("type" => "success", "text" => "Hurray !! Your Data is saved to the Database"));
                    } // If already taken name is sent than don't save the info just send the message back
                    else {
                        $this->SysMan->Logger->info("I am in Already Name Exist Section");
                        $this->Msg = array(array("type" => "danger", "text" => "Sorry Player Name is not available !!"));
                    }
                } // // Name is available...Save the data to the database with new name and other configurations...
                else {

                    $this->SysMan->Logger->info("I am in Name Available Section ");
                    $this->Mapper->save();
                    $this->_saveToSession();
                    $this->Msg = array(array("type" => "success", "text" => "Hurray !! Your Data is saved to the Database"));
                }
            } // Player trying to save Anonymous play name
            else {
                $this->Msg = array(array("type" => "danger", "text" => "Sorry Player Name is not available !!"));
            }

            /*
             *
             * parent::save();
             * */

        }
        elseif($id==0&&$signInState==0)
        {
            $this->SysMan->Session->roundsPerGame=$this->roundsPerGame;
            $this->SysMan->Session->secondsPerRound=$this->secondsPerRound;
            $this->Msg = array(array("type" => "success", "text" => "Anonymous Player...Your Data is saved"));
        }
        else
        {
            throw new Exception(" Not Able to save Data to the Database");
        }

    }

    // Function to save the player data to the Session variable
    private function _saveToSession()
    {
        $this->SysMan->Session->idChallenge=$this->getIdChallenge();
        $this->SysMan->Session->playerName=$this->getName();
        $this->SysMan->Session->secondsPerRound=$this->secondsPerRound;
        $this->SysMan->Session->roundsPerGame=$this->roundsPerGame;
        $this->SysMan->Logger->info("Save to the Session function Ran");
    }





    /************************************
     * MODEL PRIVATE FUNCTIONS definition
     ************************************/

    /**
     * << description of preInsert >>
     *
     * @return boolean  Indication to save method that preInsert succeeded; therefore, save can continue
     *
     **/
    protected function _preInsert(){
        $success = true;
        
        // todo: determine if preInsert process required prior to table inserts
        
        return $success;
    }

    /**
     *  << description of preUpdate >>
     *  This may require gathering existing data from the database as validating or maintaining as appropriate
     *
      * @return boolean  Indication to save method that preUpdate succeeded; therefore, save can continue
     **/
    protected function _preUpdate(){
         $success = true;
         
       // TODO:  determine if preUpdate process required prior to table update
        
        return $success;
    }

    /**
     * This is logic common to an insert or an update to the database
     *
     * @public
     * @return  boolean
     */
    public function _preSave()
    {
        // todo: define method
        return true;
    }
    
    /**
     * << description of preInsert >>
     *
     * @return boolean  Indication to save method that postSave succeeded; therefore, save can continue
     *
     **/
    protected function _postSave(){
         $success = true;
         
       // TODO:  determine if postSave process required after table update/insert
        
        return $success;
    }

    /**
     * Validates the result of a find operation to insure that it belongs to the requesting user and/or they are allowed
     * to see the results.
     *
     * @return bool
     */
    protected function _validateModel(){
        // todo:  validate the find return to make sure user is allowed to read record
        return true;
    }

    /**
     * Find operation is run for index action
     *
     * The Basic idea with the find is...whenever it will run either it will set up th model if user id is there and if it is signed in..or return an anonymous play...
     */
    public function find()
    {
        $this->id=$this->SysMan->Session->idPlayer;
        $this->_signInState=$this->SysMan->Session->signInState;
        /**
         * When the player sign in with correct validation user name is stored but signIn State is still 0 in session variable....simply run the find operation
         * build up the model from the database...
         */
         if($this->id>0&&$this->getSignInState()!=20)
        {
            parent::find();

        }

         // When the Player is Signed In
         else if($this->id>0&&$this->getSignInState()==20)
         {

             $this->idChallenge=$this->SysMan->Session->idChallenge;
             $this->name=$this->SysMan->Session->playerName;
             $this->secondsPerRound=$this->SysMan->Session->secondsPerRound;
             $this->roundsPerGame=$this->SysMan->Session->roundsPerGame;

           // Welcome back message... when  user reloads the page in signed in state
             $this->Msg=array();
             $this->Msg=array(array("type"=>"success","text"=>"Welcome Back  ".$this->Name." . Continue Playing Your Game"));

         }
         /**
         * ( Anonymous  Player ) Generally for a new access to the app a session variable is created which has idPlayer value stored as 0 or as null for a logged out user
         */
        else
        {
            $this->name='santosh';
            $this->roundsPerGame=$this->SysMan->Session->roundsPerGame;
            $this->secondsPerRound=$this->SysMan->Session->secondsPerRound;
            $this->defaultName='santosh';
            $this->secret='Some New Secret';
            $this->idChallenge=$this->SysMan->Session->idChallenge;
            $this->signInState=$this->SysMan->Session->signInState;
            $this->Msg=array();
            $this->Msg=array(array("type"=>"success","text"=>"Welcome Anonymous Player."),array("type"=>"success","text"=>"Enjoy the Game"));
        }


    }

    // Its pre login function which checks for Hacking Attempt and response appropriately ....
    protected function _preLogin()
    {

        $this->SysMan->Logger->info(" I am in post login");
        // Grab the signInState state stored in Session Variable
        $signInState=$this->SysMan->Session->signInState;

        $this->SysMan->Logger->info(" SignInState stored in session is ".$signInState);

        $this->SysMan->Logger->info(" provided signInState ".$this->signInState);


        //  If it was Anonymous Player
        if($signInState==0)
        {
            // if the provided signInState  is 1
            if($this->signInState=1)
            {
                // If name is equal to default name then set as Anonymous Player with a message that name is not unavailable ...
                if(strtolower($this->name)=='santosh')
                {
                    $this->id=0;
                    $this->find();
                    $this->Msg=array(array("type"=>"danger","text"=>"Sorry User Name is Not Available."));
                }
                // Do the name availability check...
                else
                {
                    // do nothing
                }
            }

            // Make the signInState as 1 and check for the name availability ...
            else
            {
                $this->signInState=1;

                // If name is equal to default name then set as Anonymous Player with a message that name is not unavailable ...
                if(strtolower($this->name)=='santosh')
                {
                    $this->id=0;
                    $this->find();
                    $this->Msg=array(array("type"=>"danger","text"=>"Sorry User Name is Not Available."));
                }
                // Do the name availability check...
                else
                {
                    // do nothing
                }
            }

        }

        // In no case session variable will store session as 1
        elseif($signInState==1)
        {
            // session is never gong to be 1 ...
        }

        // If the player was a new sign in...
        elseif($signInState==5)
        {
            if($this->signInState==5)
            {
                // If the same user uses the same name and don't alter the signInState....
                if(!$GLOBALS['nameChanged'])
                {
                    $arr=$this->findAll(array('name'));
                    // If you find a match don't do anything just send a name not available message back...
                    if(count($arr)==1)
                    {
                        $this->signInState=0;
                        $this->Msg=array(array("type"=>"danger","text"=>"Sorry User Name is Not Available."));
                    }
                }
                // If the user changes the name with signInSate 5 better
                else
                {
                    $this->signInState=1;
                }

            }
            // If the user sends something else then  simply make sign state as 1;
            else
            {
                $this->signInState=1;
            }
        }

        // if users secrets was pending...
        elseif($signInState==10)
        {
            if($this->signInState==10)
            {
                $this->SysMan->Logger->info("so the sign in state is 10");
                if(!$GLOBALS['nameChanged'])
                {
                    $this->SysMan->Logger->info(" And the NAme is not changed");
                    // do nothing
                }
                else
                {
                    $this->SysMan->Logger->info("I guess the name is changed  ");
                    $this->signInState=1;
                }
            }
            // If some other signInState is provided, it means secret should not be  accepted so just
            // make signInState as 1 and it will just check for name availability ...
            else
            {
                $this->signInState=1;
            }

        }

        // If user was signed in and try to run login function it will simply act as as if you reloaded the page again....
        elseif($signInState==20)
        {
            // It really doesn't  matter what data it comes with, its gonna act like page is reloaded....
             $this->find();
        }


    }



}