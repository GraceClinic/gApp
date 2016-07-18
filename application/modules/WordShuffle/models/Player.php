<?php

/**
 * TODO: record description
 * 
 * @package WordShuffle_Model
 * @class   WordShuffle_Model_Player
 * @property    int         id              -- Player Id
 * @property    string      name            -- Name of the player
 * @property    int         idChallenge     -- Challenge completed by a player
 * @property    string      secret          -- Players secret answer for login
 * @property    DateTime    createDate      -- New Player creation datetime
 * @property    DateTime    modifyDate      -- Player details modified datetime
 * @property    int         idNoteBook      -- NoteBook id of a player
 */
class WordShuffle_Model_Player extends Common_Abstracts_Model
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
    
    private $_name = null;
    protected function setName($value){
        $this->_name = (string) $value;
    }
    protected function getName(){
        return $this->_name;
    }

    private $_idChallenge = null;
    protected function setIdChallenge($value){
        $this->_idChallenge = (int) $value;
    }
    protected function getIdChallenge(){
        return $this->_idChallenge;
    }
    
    private $_secret = null;
    protected function setSecret($value){
        $this->_secret = (string) $value;
    }
    protected function getSecret(){
        return $this->_secret;
    }

    private $_createDate = null;
    protected function setCreateDate($value){
        $this->_createDate = $value;
    }
    protected function getCreateDate(){
        return $this->_createDate;
    }

    private $_modifyDate = null;
    protected function setModifyDate($value){
        $this->_modifyDate = $value;
    }
    protected function getModifyDate(){
        return $this->_modifyDate;
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