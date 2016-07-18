<?php

/**
 * TODO: record description
 * 
 * @package WordShuffle_Model
 * @class   WordShuffle_Model_Round
 * @property    int         id        identifier
 * @property    int         idWSGame        id of the ws game
 * @property    int         time        roundTime
 * @property    int         points        max points
 * @property    int         wordCount        Number of Words
 * @property    string         start        start time
 * @property    string         end        end Time
 * @property    int         index        index
 * @property    int         idNoteBook        Note Book Id
 */
class WordShuffle_Model_Round extends Common_Abstracts_Model
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
    // todo:  use "php_prop" live template to insert new properties
    
    private $_id = null;
    protected function setId($value){
        $this->_id = (int) $value;
    }
    protected function getId(){
        return $this->_id;
    }

    private $_idWSGame = null;
    protected function setIdWSGame($value){
        $this->_idWSGame = (int) $value;
    }
    protected function getIdWSGame(){
        return $this->_idWSGame;
    }
    

    private $_time = null;
    protected function setTime($value){
        $this->_time = (int) $value;
    }
    protected function getTime(){
        return $this->_time;
    }

    private $_points = null;
    protected function setPoints($value){
        $this->_points = (int) $value;
    }
    protected function getPoints(){
        return $this->_points;
    }

    private $_wordCount = null;
    protected function setWordCount($value){
        $this->_wordCount = (int) $value;
    }
    protected function getWordCount(){
        return $this->_wordCount;
    }

    private $_start = null;
    protected function setStart($value){
        $this->_start =  $value;
    }
    protected function getStart(){
        return $this->_start;
    }

    private $_end = null;
    protected function setEnd($value){
        $this->_end =  $value;
    }
    protected function getEnd(){
        return $this->_end;
    }

    private $_index = null;
    protected function setIndex($value){
        $this->_index = (int) $value;
    }
    protected function getIndex(){
        return $this->_index;
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