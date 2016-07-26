<?php
/**
 * @class WordShuffle_GameController
 *
 * @property   
 */
class WordShuffle_GameController extends Common_Abstracts_RestController
{

    // todo: define model class name proxied by this controller
    protected
        $_modelClass = 'WordShuffle_Model_Game';

    protected $BAD_REQUEST = false;         // flag the request when there is a bad request using POST

    public function init()
    {
        parent::init();
    }

    // todo:  determine if you will extend or override the abstract indexAction()

    // todo:  determine if you will extend or override the abstract getAction()

    // todo:  determine if you will extend or override the abstract putAction()

    // todo:  determine if you will extend or override the abstract postAction()
      public function postAction($model = Array(), $method = '', $args = Array(), $noModel = false)
        {
            $this->_SysMan->Logger->info(
                'START '.$this->_className.'->postAction() for method '.$method.'; arguments ='.PHP_EOL.'{'.print_r($args,true).'}',
                'WordShuffle_GameController');
            try {
                if(!$this->getRequest()->getParam('model'))
                {
                    $this->BAD_REQUEST = true;
                    $this->ERROR_INFO = 'POST Action either does not include model argument or it is invalid';
                }
                else {
                    $flag = 0;
                    foreach ($this->getRequest()->getParam('model') as $key => $value) {
                        if ($key == 'word') {
                            $flag = 1;
                            break;
                        }
                    }
                    if ($flag == 0) {
                        $this->BAD_REQUEST = true;
                        $this->ERROR_INFO = 'POST Action does not include word property within model argument';
                    }
                }
                parent::postAction($model, $method, $args, true);

                if(!$noModel){
                    $response =  json_decode($this->getResponse(),true);
                    if($response['results']['msg'] == "Success!") {
                        $response["model"] = $this->_model->toArray();
                        $this->getResponse()->clearBody();
                        $this->getResponse()->appendBody(json_encode($response));
                    }
                }
            }catch (Exception $ex){
                //$this->ERROR_INFO = 'POST Action either does not include an argument model or it has invalid properties';
            }
        }
    

    public function deleteAction($id = 0){
        if($id==0)
            $this->_SysMan->Session->__set("scoreBoard",null);
    }

    // todo:  determine if you will extend the preDispatch() method, do not override original
    
    public function postDispatch()
    {
        parent::postDispatch();
        if($this->BAD_REQUEST)
        {
            //set message when POST request does not contain valid arguments
            $this->toJSONResponse(
                array('message' => $this->ERROR_INFO), 1, self::HTTP_BAD_REQUEST
            );
        }
    }
}
