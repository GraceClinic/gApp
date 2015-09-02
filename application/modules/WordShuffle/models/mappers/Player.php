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
    protected $_map = array('name'=>'name',
        'secret'=>'secret',
        'idChallenge'=>'idChallenge',
        'secondsPerRound'=>'secondsPerRound',
        'roundsPerGame'=>'roundsPerGame',
        'id'=>'id'
    );




        // todo:  build find all array of foreign keys that index a group of records for this table
    protected $_findAllBy = array('name');

    protected $_model;

    // todo:  document this function if you include it
    protected function init(){
		// todo:  extend constructor logic of abstract here, do not override the parent constructor
    }




	
	// todo:  determine if you will extend or override the save() method.  Zend_Db_Adapter_Abstract::Insert() requires that the primary key field be set to null for a new insert to return the newly generated primary key

    protected function _preSave()
    {
        // todo:  determine what you will do before a save operation, document if you include
    }

    protected function _postSave()
    {
        // todo:  determine what you will do after a save operation, document if you include
    }




    /**
     *Does Some Authentication Job
     * @public
     * @param string $credential
     * @return boolean
     * @throws Exception
     */
    public function authenticateUser($credential)
    {

        $this->_model->SysMan->Logger->info(" In the player mapper");
        $arr=$this->findAll();
        if(count($arr)==1)
        {
            if(strtolower($credential)==strtolower($arr[0]["secret"]))
            {
                $this->_model->SysMan->Logger->info(" In the Authenticate User Section where it is accepted");
                return true;
            }
            else
            {
                $this->_model->SysMan->Logger->info(" In the Authenticate User Section where it is rejected");
                return false;
            }
        }
        else
        {
            throw new Exception("More than one Records Exist ");
        }



    }


    public function setChallenges()
    {


        // Table Name of the Target Challenge Table
        $tableName = 'WordShuffle_Model_Player_DbTable_Challenge';

        // Challenge table object is created...
        $table=new $tableName();

        // Gets the all challenges from the challenge table
        $challengesObject=$table->fetchAll();
        $challengesArray=$challengesObject->toArray();

        return $challengesArray;
    }


   public function getChallengeQuestion()
    {

        // Table Name of the Target Challenge Table
        $tableName = 'WordShuffle_Model_Player_DbTable_Challenge';

        // Challenge table object is created...
        $table = new $tableName();

        $value = $this->_model->idChallenge;
        $key='id';
        $where[$key.' = ?'] = $value;

       // Gets the appropriate challenges from the challenge table according to idInstruction property ...
        $challengeObject=$table->fetchRow($where);
        $challengeQuestion=$challengeObject->toArray();

        return $challengeQuestion;

    }




 
}