<?php

/**
 * TODO: record description
 * 
 * @package WordShuffle_Model
 * @class   WordShuffle_Model_Game
 * @property    int         id                      -- Id of the Game
 * @property    int         idPlayer                -- id of the Player
 * @property    int         roundsPerGame           -- Number of rounds per Game
 * @property    int         secondsPerRound         -- seconds for each round in Game
 * @property    DateTime    start                   -- dateTime when player starts the Game
 * @property    DateTime    end                     -- dateTime when player completes or abandoned the Game
 * @property    int         points                  -- total points awarded for a game
 * @property    int         roundAvg                -- average points scored in each round of a game
 * @property    string      status                  -- game status like Completed, Abandoned
 * @property    int         idNoteBook              -- NoteBook id of a Game
 */
class WordShuffle_Model_Game extends Common_Abstracts_Model
{

    /*****************************
     * CLASS CONSTANTS declaration
     *****************************/
    // todo: itemize class constants

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
		$this->excludeFromJSON(array(
		    
        ));
        
		// todo:  determine extension of constructor logic, do not override original init() function, only extend it

    }

    /************************************
     * MODEL PROPERTIES SETTERS / GETTERS
     ************************************/
    
    private $_id = null;
    protected function setId($value){
        $this->_id = (int) $value;
    }
    protected function getId(){
        return $this->_id;
    }
    
    private $_idPlayer = null;
    protected function setIdPlayer($value){
        $this->_idPlayer = (int) $value;
    }
    protected function getIdPlayer(){
        return $this->_idPlayer;
    }
    
    private $_roundsPerGame = null;
    protected function setRoundsPerGame($value){
        $this->_roundsPerGame = (int) $value;
    }
    protected function getRoundsPerGame(){
        return $this->_roundsPerGame;
    }
    
    private $_secondsPerRound = null;
    protected function setSecondsPerRound($value){
        $this->_secondsPerRound = (int) $value;
    }
    protected function getSecondsPerRound(){
        return $this->_secondsPerRound;
    }

    private $_start = null;
    protected function setStart($value){
        $this->_start = $value;
    }
    protected function getStart(){
        return $this->_start;
    }

    private $_end= null;
    protected function setEnd($value){
        $this->_end = $value;
    }
    protected function getEnd(){
        return $this->_end;
    }

    private $_points = null;
    protected function setPoints($value){
        $this->_points = (int) $value;
    }
    protected function getPoints(){
        return $this->_points;
    }

    private $_roundAvg = null;
    protected function setRoundAvg($value){
        $this->_roundAvg = (int) $value;
    }
    protected function getRoundAvg(){
        return $this->_roundAvg;
    }
    
    private $_status = null;
    protected function setStatus($value){
        $this->_status = (string) $value;
    }
    protected function getStatus(){
        return $this->_status;
    }
    
    private $_idNoteBook = null;
    protected function setIdNoteBook($value){
        $this->_idNoteBook = (int) $value;
    }
    protected function getIdNoteBook(){
        return $this->_idNoteBook;
    }
    


    /****************************************
     * MODEL PUBLIC METHODS declaration / definition
     ****************************************/
    // todo:  use "php_method" live template to insert new methods

    /************************************
     * MODEL PRIVATE FUNCTIONS definition
     ************************************/
    // todo: use "php_func" live template to insert to functions
    
    /**
     * Specific model logic that follows find function.  Override as required, otherwise ignore.
     *
     * @protected
     * @return      boolean     - flags successful execution
     */
    protected function _postFind()
    {
        return true;
    }
    
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

}