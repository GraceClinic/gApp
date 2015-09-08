<?php

/**
 * @class WordShuffle_Model_Instructions_Page
 * @package  WordShuffle_Model_Instructions
 *
 * A page of content for the instructions for a game
 *
 * @property    int         idInstructions        foreign key to the instructions
 * @property    string         body        file reference to HTML content
 * @property    int         sequence        order of page
 *
 * * @property    int         id
 **/
class WordShuffle_Model_Instructions_Page extends Common_Abstracts_Model
{

    /**
     * << description of init >>
     *
     **/
    protected function init()
    {
        parent::init();



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
    
    
    
    
    private $_idInstructions = null;
    protected function setIdInstructions($value){
        $this->_idInstructions = (int) $value;
    }
    protected function getIdInstructions(){
        return (int) $this->_idInstructions;
    }

    private $_body = null;
    protected function setBody($value){
        $this->_body = (string) $value;
    }
    protected function getBody(){
        return (string) $this->_body;
    }

    private $_sequence = null;
    protected function setSequence($value){
        $this->_sequence = (int) $value;
    }
    protected function getSequence(){
        return (int) $this->_sequence;
    }

    /**
     * << description of preInsert >>
     *
     * @return boolean  Indication to save method that preInsert succeeded; therefore, save can continue
     *
     **/
    protected function _preInsert(){
        $success = true;



        return $success;
    }

    /**
     *  << description of preUpdate >>
     *
     * @return boolean  Indication to save method that preUpdate succeeded; therefore, save can continue
     **/
    protected function _preUpdate(){
        $success = true;



        return $success;
    }

    /**
     * << description of preInsert >>
     *
     * @return boolean  Indication to save method that postSave succeeded; therefore, save can continue
     *
     **/
    protected function _postSave(){
        $success = true;



        return $success;
    }

    /**
     * Validates the result of a find operation to insure that it belongs to the requesting user and/or they are allowed
     * to see the results.
     *
     * @return bool
     */
    protected function _validateModel(){

        return true;
    }


}