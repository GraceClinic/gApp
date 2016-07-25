<?php
// todo:  update docBlock with class description and properties
/**
 * << class description >>
 *
 * @package WordShuffle_Model_Mapper
 *
 * @class WordShuffle_Model_Mapper_Player
 *  
 */
class WordShuffle_Model_Mapper_Player extends Common_Abstracts_Mapper
{
    protected 
        // todo:  create mapping between table fields and model properties (format is <table field> => <model prop>
        $_map = array(
            'id'            => 'id',
            'name'          => 'name',
            'idChallenge'   => 'idChallenge',
            'secret'        => 'secret',
            'createDate'    => 'createDate',
            'modifyDate'    => 'modifyDate',
            'idNoteBook'    => NULL
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
        $this->_model->name = strtolower($this->_model->name);
    }

    protected function _postSave()
    {
        // todo:  determine what you will do after a save operation, document if you include
    }
    
    /**
     * validates the secret obtained with the secret obtained from the database
     *
     * @public  validateSecret
     * @param   string  name    username
     * @param   string  secret  userpassword
     * @return array
     */
    public function validateSecret($name, $secret)
    {
        $this->_model->SysMan->Logger->info("Start of validateSecret");
        $where = "name = '$name'";
        $result = $this->getDbTable()->fetchAll($where);
        $this->_model->SysMan->Logger->info("rowset obtained from fetchAll" . print_r($result, true));
        if (count($result) == 0) {
            return array("validateSecret"=>"notFound", "result"=>[]);
        }
        else if (count($result) == 1) {
            if ($result[0]->secret == $secret) {
                return array("validateSecret"=>"found", "result"=> $result[0]);
            }
            return array("validateSecret"=>"wrongCredentials", "result"=>[]);
        }
        else {
            return array("validateSecret"=>"multipleRecords", "result"=>[]);
        }
    }
    
    /**
     * getChallenges gives you the challenge question for the player
     *
     * @public                 
     * @param   int     challengeId     challenge id from the player
     * @return string
     */
    public function getChallenges($challengeId)
    {
        $this->_model->SysMan->Logger->info("Start of getChallenges method()");
        //setting the dbTable to challenge table
        $this->setDbTable("WordShuffle_Model_DbTable_Challenge");
        $where = "id = $challengeId";
        $result = $this->getDbTable()->fetchAll($where)->toArray();
        $this->_model->challenges = $result;
        $this->setDbTable("WordShuffle_Model_DbTable_Player");
    }
}