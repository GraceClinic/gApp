<?php
// todo:  update docBlock with class description and properties
/**
 * << class description >>
 *
 * @package WordShuffle_Model_Game_Mapper
 *
 * @class WordShuffle_Model_Game_Mapper_Game
 *  
 */
class WordShuffle_Model_Game_Mapper_Game extends Common_Abstracts_Mapper
{
    protected 
        // todo:  create mapping between table fields and model properties (format is <table field> => <model prop>
        $_map = array(
            'id'            => 'id'
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

    protected function _preSave()
    {
        // todo:  determine what you will do before a save operation, document if you include
    }

    protected function _postSave()
    {
        // todo:  determine what you will do after a save operation, document if you include
    }
 
}