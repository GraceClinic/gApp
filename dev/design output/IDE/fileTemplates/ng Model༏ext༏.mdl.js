(function() {

    // todo: Add other dependencies passed as parameters to the Factory
    // If the parameters passed are constructors document as {function(new:<Model_Name>)}.
    // If the parameters passes are singletons document as {<Model_Name>}
    /**
     * Model factory returning the <singleton or constructor> for the Model ${NAME}
     *
     * @param {${Super_class}}   ${Super_class}
     * @returns {${Package_name}${NAME}}   
     */
    function ${Package_name}${NAME}Factory(${Super_class}){
        /**
         * @class       ${Package_name}${NAME}
         * todo: provide short description of model
         *
         * @extends     ${Super_class}  
         * @param       {Object}     [data]            - optional data object for setting properties during instantiation
         * @this        ${Package_name}${NAME}          
         * @returns     {${Package_name}${NAME}}
         */
        function ${Package_name}${NAME}(data){
            // proxy the "this" keyword to avoid scope resolution issues
            var self = this;
                       
            /****************************************
             * MODEL PROPERTIES / GETTERS and SETTERS
             ****************************************/
            // todo: use "ng_prop" live template to inject more model properties

            /*****************************************
             * MODEL METHODS declaration / definition
             *****************************************/
 			// todo:  use "ng_method" live template to insert individual model methods 
 
             /******************
             * PRIVATE FUNCTIONS
             *******************/
 			// todo:  create any private functions that reside within the constructor 

            /*******************
             * CONSTRUCTOR LOGIC
             *******************/
            self.log('START ' + self.constructor.name+'.construct()');
            // extend from the super class, execute constructor and copy all properties therein to this class
            ${Super_class}.call(self, data);
             
            // todo: set the URL address serving as backend api data source
            self._rootURL = '';

            // todo:  determine if model properties defined on the frontend should be excluded from backend
            self.excludeFromPost([
                
            ]);

            self.log('END ' + self.constructor.name+'.construct()');
           
           // most models return itself for daisy chaining
           return self;
        }
        // setup the inheritance chain
        ${Package_name}${NAME}.prototype = Object.create(${Super_class}.prototype);
        ${Package_name}${NAME}.prototype.constructor = ${Package_name}${NAME};

        /*********************
         * PROTOTYPE CONSTANTS
         *********************/
        // todo: use the "ng_const" live template to insert new constants on the prototype, use ALL_CAPS_WITH_UNDERSCORE for name

        /***************************************************
         * PROTOTYPE PUBLIC PROPERTIES / SETTERS and GETTERS
         ***************************************************/
        // todo: use the "ng_pprop" live template to insert prototype properties

        /*************************************************
         * PROTOTYPE PUBLIC METHODS DECLARATION/DEFINITION
         *************************************************/
         // todo: use the "ng_pmethod" live template to insert prototype methods
         // todo:  use "ng_relay" to insert methods you wish to relay to the backend and service thereafter
         /* todo: Largely the basic save(), find(), delete(), and relay() methods do not change.  When they do and you only wish
          * to extend the logic, use "${Super_class}.prototype.<<methodName>>.call(this)" to execute parent method.*/

        /**
         * @method   _postFind
         * Logic executed after find event returns
         *
         * @protected
         * @return   {boolean}
         */
        ${Package_name}${NAME}.prototype._postFind = function(){
            // todo: determine if running logic after execution of the find() method
            return true;
        };

        /**
         * @method   _postSave
         * Processing executed after results return from a save operation.
         *
         * @protected
         * @return   {boolean}
         */
        ${Package_name}${NAME}.prototype._postSave = function(){
            // todo: determine if _postSave() logic required, otherwise delete
            return true;
        };
        
                
        /*******************************************
         * PRIVATE FUNCTIONS shared at Factory level
         *******************************************/
         // todo: create private functions shared amongst all class instances

        // return constructor for dependency injection and extension of class, prefix with "new" if it should be a singleton
        return ${Package_name}${NAME};
    }

    // todo: inject dependencies
    ${Package_name}${NAME}Factory.${DS}inject = [
        '${Super_class}'
    ];

    // register model with Angularjs application
    angular.module('${Angular_module_name}').factory('${Package_name}${NAME}', ${Package_name}${NAME}Factory);
})();
