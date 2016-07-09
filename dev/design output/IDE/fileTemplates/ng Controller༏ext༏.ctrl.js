(function () {
	// todo: provide short description of controller and document any dependencies injected
	/**
	 * <<short description>>
	 *
	 * @constructor
     * @param   	{App_Common_Models_SysMan}  SysMan  - reference to the SysMan singleton
	 * @this        ${Package_Name}_${NAME}
	 */
	function ${Package_Name}_${NAME}(SysMan) {
		var self = this;		// required alias to address resolution to immediate scope
		
		// todo:  define any private variables that serve the controller (prefix with "_" to denote as private

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
        SysMan.Logger.entry('START ' + self.constructor.name + '.construct()',self.constructor.name);

		// todo: add constructor logic
		
        SysMan.Logger.entry('END ' + self.constructor.name + '.construct()',self.constructor.name);

	}

	// Explicitly define the constructor
	${Package_Name}_${NAME}.prototype.constructor = ${Package_Name}_${NAME};

    // todo:  inject dependencies into the controller constructor, and itemize in constructor thereafter
    ${Package_Name}_${NAME}.${DS}inject = [
		'App_Common_Models_SysMan'
	];

    angular.module('${Angular_Module_Name}').controller('${Package_Name}_${NAME}', ${Package_Name}_${NAME});
})();
