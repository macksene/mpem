/**
* Theme: Montran Admin Template
* Author: Coderthemes
* Form wizard page
*/

!function($) {
    "use strict";
    var FormWizard = function() {};    
    FormWizard.prototype.createValidatorForm = function($form_container) {
        $form_container.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.after(error);
            }
        });
        $form_container.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
                $form_container.validate().settings.ignore = ":disabled,:hidden";
                return $form_container.valid();
            },
            onFinishing: function (event, currentIndex) {
                $form_container.validate().settings.ignore = ":disabled";
                return $form_container.valid();
            },
            onFinished: function (event, currentIndex) {
                //alert("Submitted!999999999");
				$('#wizard-validation-form').submit();
            }
        });

        return $form_container;
    },
    
    FormWizard.prototype.init = function() {
        //form with validation
        this.createValidatorForm($("#wizard-validation-form")); 
    },
    //init
    $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.FormWizard.init()
}(window.jQuery);