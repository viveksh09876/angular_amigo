app.directive('scrollTrigger', function($window) {
    return {
        link : function(scope, element, attrs) {
            var offset = parseInt(attrs.threshold) || 0;
            var e = jQuery(element[0]);
            var doc = jQuery(document);
            angular.element(document).bind('scroll', function() {
				
				if ($(window).scrollTop() >= $(document).height() - $(window).height() - 30) {
				  scope.$apply(attrs.scrollTrigger);
			   }
			
			
                /*if (doc.scrollTop() + $window.innerHeight + offset > e.offset().top + 600) {
                    console.log('left: ',doc.scrollTop()+ $window.innerHeight +  offset, 'right: ',e.offset().top)
					//scope.$apply(attrs.scrollTrigger);
                }*/
            });
        }
    };
});

app.directive('removeModal', ['$document', function ($document) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
		
            element.bind('click', function () {
                $document[0].body.classList.remove('modal-open');				
                    angular.element($document[0].getElementsByClassName('modal-backdrop')).remove();
                    angular.element($document[0].getElementsByClassName('modal')).remove();
                });
            }
        };
    }]);
	
	
app.directive('fileUpload', function () {
    return {
        scope: true,        //create a new scope
        link: function (scope, el, attrs) {
            el.bind('change', function (event) {
                var files = event.target.files;
                //iterate files since 'multiple' may be specified on the element
                for (var i = 0;i<files.length;i++) {
                    //emit event upward
                    scope.$emit("fileSelected", { file: files[i] });
                }                                       
            });
        }
    };
});	