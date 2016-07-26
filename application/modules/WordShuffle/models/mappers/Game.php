<?php
// todo:  update docBlock with class description and properties
/**
 * << class description >>
 *
 * @package WordShuffle_Model_Mapper
 *
 * @class WordShuffle_Model_Mapper_Game
 *  
 */
class WordShuffle_Model_Mapper_Game extends Common_Abstracts_Mapper
{
    protected 
        // todo:  create mapping between table fields and model properties (format is <table field> => <model prop>
        $_map = array(
            'id'                => 'id',
            'idPlayer'          => 'idPlayer',
            'roundsPerGame'     => 'roundsPerGame',
            'secondsPerRound'   => 'secondsPerRound',
            'start'             => 'start',
            'end'               => 'end',
            'points'            => 'points',
            'roundAvg'          => 'roundAvg',
            'status'            => 'status',
            'idNoteBook'        => NULL
        ),
        // todo:  build find all array of foreign keys that index a group of records for this table
        $_findAllBy = array(
        );

    
	// todo:  document this function if you include it
    protected function init(){
		// todo:  extend constructor logic of abstract here, do not override the parent constructor
    }

	// todo:  determine if you will extend or override the find() method
	
	// todo:  determine if you will extend or override the findAll() method
	
	// todo:  determine if you will extend or override the save() method.  Zend_Db_Adapter_Abstract::Insert() requires that the primary key field be set to null for a new insert to return the newly generated primary key

    // Calculate round Average for a newly created Game record before insertion.
    protected function _preSave()
    {
        $this->_model->roundAvg = $this->_model->points / $this->_model->roundsPerGame;
    }

    protected function _postSave()
    {
        // todo:  determine what you will do after a save operation, document if you include
    }

    /**
     * To validate if given word exists in database
     * @public  Game_Mapper_findWord
     * @param   $word
     * @return  boolean
     */
    public function Game_Mapper_findWord($word)
    {
        $word = $word."\r";
        $this->setDbTable("WordShuffle_Model_DbTable_WordList");
        // set the database adapter also at this time to avoid dependencies
        $this->_db = $this->getDbTable()->getAdapter();
        $this->init();
        $where = array(
            "word = '$word'"
        );
        $res = $this->getDbTable()->fetchAll($where);
        $count = count($res);
        // There should only be one record or no record
        if ($count == 1)
            $success=true;
        else
            $success=false;
        
        return $success;
    }
}