
(function(){

	//todo:  reference newly injected dependencies as needed
	
    /**
     * @param {App_Common_Models_Tools_Logger}  Logger  - reference to Logger object
     * @returns {${camelCasePackageName}${NAME}}
     */
    function ${camelCasePackageName}${NAME}Provider(Logger){

        /**
         * @class ${camelCasePackageName}${NAME}
         * @returns {${camelCasePackageName}${NAME}}
         */
        function ${camelCasePackageName}${NAME}(){            
            Logger.entry('END ' + self.constructor.name + '.construct()',self.constructor.name);
            
            // todo:  define static variables, shared across any functions contained herein
            
            // todo:  define the returns from the directive as expected by AngularJS
            this.restrict = ''; 
            this.templateUrl = '';
            this.scope = {
                // todo:  define variable scope passed from HTML and document in block above
            };
            // todo:  if this directive will be exposed for control by other directive, replace this.link with this.controller 
            this.link = controller; // this.link is the intrinsic controller for a directive
            
            // todo: define each property created on the scope object
            /**
             * Provides for logic that controls aspects of the directive based on construction and / or events
             *
             * @param   {Object}    scope           - reference to angular directive scope
             * @param   {}  scope.<PROP>            - 
             * @param   {Object}    element         - the DOM element attached to directive
             * @param   {Object}    attributes      - the actual attributes values passed within the directive DOM element
             */
            function controller(scope, element, attributes){
                // proxy scope to self for consistency and use of templates for defining methods
                var self = scope;
                    
                /*************************************************
                 * PROPERTY DECLARATIONS with GETTERS and SETTERS
                 *************************************************/
                // todo: use ng_prop to create complete properties, otherwise create simply, uncontrolled properties off of self
                
                /****************************
                 * PUBLIC METHODS DEFINITION
                 ****************************/
                // todo:  use "ng_method" live template to insert individual controller methods (accessible through the controller's associated view)
                
                /********************
                 * PRIVATE FUNCTIONS
                 ********************/
                // todo:  use "ng_func" live template to insert private functions 
                
                /*******************
                 * CONSTRUCTOR LOGIC
                 *******************/
                // todo:  use element.on('destroy',...) or scope.${DS}on('destroy,...) to clean up after registered listeners
                         
            }
            
            Logger.entry('END ' + self.constructor.name + '.construct()',self.constructor.name);
            
            return this;
        }
        
        //noinspection JSPotentiallyInvalidConstructorUsage
        return new ${camelCasePackageName}${NAME};
    }

    // todo:  inject new dependencies into directive as needed
    ${camelCasePackageName}${NAME}Provider.${DS}inject = ['App_Common_Models_Tools_Logger'];

    angular.module('${App_Module_Name}').directive('${camelCasePackageName}${NAME}',${camelCasePackageName}${NAME}Provider);
})();