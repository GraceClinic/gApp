<?php

/**
 * TODO: record description
 * 
 * @package ${Model_Package_Name}
 * @class   ${Model_Package_Name}_${NAME}
 */
class ${Model_Package_Name}_${NAME} extends Common_Abstracts_Model
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
		${DS}this->excludeFromJSON(array(
		    
        ));
        
		// todo:  determine extension of constructor logic, do not override original init() function, only extend it

    }

    /************************************
     * MODEL PROPERTIES SETTERS / GETTERS
     ************************************/
    // todo:  use "php_prop" live template to insert new properties

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
        ${DS}success = true;
        
        // todo: determine if preInsert process required prior to table inserts
        
        return ${DS}success;
    }

    /**
     *  << description of preUpdate >>
     *  This may require gathering existing data from the database as validating or maintaining as appropriate
     *
      * @return boolean  Indication to save method that preUpdate succeeded; therefore, save can continue
     **/
    protected function _preUpdate(){
         ${DS}success = true;
         
       // TODO:  determine if preUpdate process required prior to table update
        
        return ${DS}success;
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
         ${DS}success = true;
         
       // TODO:  determine if postSave process required after table update/insert
        
        return ${DS}success;
    }

}