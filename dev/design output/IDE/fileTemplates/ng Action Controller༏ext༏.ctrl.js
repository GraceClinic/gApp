
(function(){
    // todo: document new parameters as required and provide short description
    /**
     * @class ${Package_Name}_${NAME}
     * << short description >>
     *
     * @extends {App_Common_Abstracts_ActionController}
     * @param   {object}      ${DS}scope        Local angular scope for this controller
     * @param   {function}    ${DS}controller   AngularJS service responsible for instantiating controllers
     * @this    ${Package_Name}_${NAME}
     */
    function ${Package_Name}_${NAME}(${DS}scope,${DS}controller){
        var self = this;

		// todo:  define any private variables that serve the controller (prefix with "_" to denote as private

       /*************************************************
         * PROPERTY DECLARATIONS with GETTERS and SETTERS
         *************************************************/
        // todo: use ng_prop to create complete properties, otherwise create simply, uncontrolled properties off of self

        /****************************
         * ACTION METHODS DEFINITION
         ****************************/
        // todo: use "ng_action" live template to define all of the action methods (accessible through URL routes).
        // The ActionController superclass will execute these methods based on URL state transition

        /****************************
         * PUBLIC METHODS DEFINITION
         ****************************/
        // todo:  use "ng_method" live template to insert individual controller methods (accessible through the controller's associated view)

        /******************
         * PROTECTED METHODS
         ******************/
        /**
         * @method   _onClose
         * Closure logic to implement on termination of the controller.  The ActionController superclass runs this 
         * method against the current controller when the URL state transition dictates changing the controller. 
         *
         * @protected
         * @param    newState   {{module:string,controller:string,action:string}}    The state replacing current state
         */
        self._onClose = function(newState){
            // todo: code logic
        };
        
        /********************
         * PRIVATE FUNCTIONS
         ********************/
        // todo:  use "ng_func" live template to insert private functions 

        // First extend ActionController superclass as allowed for by AngularJS.
        // This must execute after definitions of all controller properties, setters, getters, and methods
        ${DS}controller('App_Common_Abstracts_ActionController',{${DS}scope: ${DS}scope, self: self});
 
        /*********************
         * CONSTRUCTOR LOGIC
         *********************/
        self.SysMan.Logger.entry('START ' + self.constructor.name + '.construct()', self.constructor.name);

        // todo: define constructor logic

        self.SysMan.Logger.entry('END ' + self.constructor.name + '.construct()', self.constructor.name);
    }
    
    // Explicitly define constructor
    ${Package_Name}_${NAME}.prototype.constructor = ${Package_Name}_${NAME};

    // todo: inject dependencies as required
    ${Package_Name}_${NAME}.${DS}inject = [
        '${DS}scope',
        '${DS}controller'
    ];

    angular.module('${Angular_Module_Name}').controller('${Package_Name}_${NAME}',${Package_Name}_${NAME});
})();