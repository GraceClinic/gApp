<?php

/**
 *
 * @package WordShuffle_Model
 * @class   WordShuffle_Model_Instructions
 *
 * @property    string          picture         File location of associated picture for display adjacent to instructions title
 *
 * @property    int          idGame         Primary key for game object as retrieved from the data source URL
 *
  * @property    WordShuffle_Model_Instructions_Page[]          Pages        Array of Page objects that form the game instructions
 *
 *  @property    string          title         Title to display over instructions slide show
 *
 */
class WordShuffle_Model_Instructions extends Common_Abstracts_Model
{


    /*****************************
     * CLASS CONSTANTS declaration
     *****************************/
    const   INSTRUCTIONS_ID = 1;


    /**
     * << description of init >>
     **/
    protected function init()
    {
        parent::init();



        // WordShuffle instructions indexed with known id within database
        //$this->find(self::INSTRUCTIONS_ID);
        $this->id = self::INSTRUCTIONS_ID;
    }

    /************************************
     * MODEL PROPERTIES SETTERS / GETTERS
     ************************************/
    private $_title = null;
    protected function setTitle($value){
        $this->_title = (string) $value;
    }
    protected function getTitle(){
        return (string) $this->_title;
    }
    private $_picture = null;
    protected function setPicture($value){
        $this->_picture = (string) $value;
    }
    protected function getPicture(){
        return (string) $this->_picture;
    }
    private $_Pages = array();
    protected function setPages($pages){
        $this->_Pages = $pages;
    }
    protected function getPages(){
        return $this->_Pages;
    }
    private $_idGame = null;
    protected function setIdGame($value){
        $this->_idGame = (int) $value;
    }
    protected function getIdGame(){
        return $this->_idGame;
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