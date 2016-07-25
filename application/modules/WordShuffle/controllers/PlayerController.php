<?php
/**
 * @class WordShuffle_Controller_PlayerController
 *
 * @property   
 */
class WordShuffle_PlayerController extends Common_Abstracts_RestController
{

    // todo: define model class name proxied by this controller
    protected
        $_modelClass = 'WordShuffle_Model_Player',
        $_unAuthorizedFlag = false,
        $_badRequest = false
        ;

    // todo:  determine extend the init(), do not override original init() function
    /**
     * extending the postAction init method
     *
     * @public
     * @param               - todo: document all parameters
     * @return void
     */
    public function init()
    {
        try {
            $contents = file_get_contents("php://input");
            if ($contents) {
                json_decode($contents);
                if (json_last_error()) {
                    throw new Exception("Invalid format passed as payload");
                }
            }
        }
        catch (Exception $e) {
            $this->SERVER_ERROR = true;
            $this->ERROR_INFO = $e->getMessage();
        }
        parent::init();
    }


    // todo:  determine if you will extend or override the abstract indexAction()

    // todo:  determine if you will extend or override the abstract getAction()

    // todo:  determine if you will extend or override the abstract putAction()
    public function putAction($model = Array()){
        $this->_SysMan->Logger->info('START '.$this->_className.'->putAction()','Common_Abstracts_RestController');
        $this->_model = new $this->_modelClass($model);
        $this->_model->excludeFromJSON(["challenges", "loginAccess"]);
        $this->_model->save();

        $response = Array(
            "model" => $this->_model->toArray(true)
        );

        $this->getResponse()->appendBody(json_encode($response));
        $this->_SysMan->Logger->info('END '.$this->_className.'->putAction()','Common_Abstracts_RestController');
    }

    // todo:  determine if you will extend or override the abstract postAction()
    /**
     * overriding postAction
     *
     * @public
     * @param               - todo: document all parameters
     * @return array
     */
    public function postAction($model = Array(), $method = '', $args = Array(), $noModel = false)
    {
        $response = array();
        $results = "";
        switch($method) {
            case "login":
                //$response = array();
                $this->_SysMan->Logger->info(
                    'START '.$this->_className.'->overridden postAction() for method '.$method.'; arguments ='.PHP_EOL.'{'.print_r($args,true).'}',
                    'Common_Abstracts_RestController');
                $this->_model = count((array)$model) ? new $this->_modelClass($model) : new $this->_modelClass();
                $this->_SysMan->Logger->info('START '.$this->_modelClass.'->'.$method.'()','Common_Abstracts_RestController');
                $results = $this->_model->$method($args);
                switch($results["validateSecret"]) {
                    case "found":
                        $this->_unAuthorizedFlag = false;
                        //$this->_SysMan::SIGNED_IN; works fine and gives the result for php >=5.3, but phpStorm flags it as incorrect usage of static(how static ??) class member
                        $sysmanReflection = new ReflectionClass("Common_Models_SysMan");
                        $this->_SysMan->Session->signInState = $sysmanReflection->getConstant("SIGNED_IN");
                        $this->_SysMan->Session->idPlayer = $this->_model->toArray(true)["Id"];
                        $this->_model->Mapper->getChallenges((int)$this->_model->toArray(true)["Id"]);
                        $response = Array(
                            "results" => true,
                            "model" => $this->_model->toArray(true)
                        );
                        break;
                    case "notFound":
                        $this->_unAuthorizedFlag = true;
                        $response = Array(
                            "message" => "The username is not found in our database"
                        );
                        break;
                    case "wrongCredentials":
                        $this->_unAuthorizedFlag = true;
                        $response = Array(
                            "message" => "the secret doesn't match"
                        );
                        break;
                    case "multipleRecords":
                        $this->_unAuthorizedFlag = true;
                        $response = Array(
                            "message" => "you have multiple records// should this be handled in as an exception?"
                        );
                        break;
                }
                break;
            case "logout":
                $this->_SysMan->Logger->info("Start of logout()");
                $this->_SysMan->Logger->info("Session before logout" . print_r($this->_SysMan->Session->toArray(), true));
                //Zend_Session::namespaceUnset("gapp");
                Zend_Session::destroy();
                //Common_Models_Session::initSession();
                $response = Array("message" => "logged out, session destroyed");
                $results = true;
                $this->_SysMan->Logger->info("Session after logout" . print_r($this->_SysMan->Session->toArray(), true));
                $this->_SysMan->Logger->info("End of logout()");
                break;
            default:
                $this->_badRequest = true;
                $response = Array(
                    "messgae" => "The method name pased is not supported, or no method passed"
                );
        }
        $this->_SysMan->Logger->info(
            'END '.$this->_className.'->postAction() for method '.$method.'; results ='.PHP_EOL.'{'.print_r($results,true).'}',
            'Common_Abstracts_RestController');

        $this->getResponse()->appendBody(json_encode($response));
    }
    
    // todo:  determine if you will extend or override the abstract deleteAction()

    // todo:  determine if you will extend the preDispatch() method, do not override original
    /**
     * extending the postDispatch method to set the unauthorized status
     *
     * @public
     * @param               - todo: document all parameters
     * @return void
     */
    public function postDispatch()
    {
        if ($this->_unAuthorizedFlag) {
            $this->getResponse()->setHttpResponseCode(self::HTTP_UNAUTHORIZED);
        }
        elseif ($this->_badRequest) {
            $this->getResponse()->setHttpResponseCode(self::HTTP_BAD_REQUEST);
        }
        else {
            parent::postDispatch();
        }
    }



    // todo:  determine if you will extend the postDispatch() method, do not override original

}
