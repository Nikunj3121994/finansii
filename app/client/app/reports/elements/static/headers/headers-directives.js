define([
], function () {
    var module = angular.module("app.reports.elements.headers.directives", []);

    module.directive('reportHeader', function ($compile) {
        function link($scope,element){
            element.find('.js_company_code').text($scope.header.company_code);
            element.find('.js_company_name').text($scope.header.company_name);
            element.find('.js_title').text($scope.header.title);
            element.find('.js_subTitle').text($scope.header.subTitle);
            for(var key in $scope.header.filters){
                if(!$scope.header.filters[key].value) continue;
                element.find('.js_filters').append('<div class="print-table-row"><span class="print-table-cell"> '+$scope.header.filters[key].label
                    +'</span><strong class="print-table-cell">'+$scope.header.filters[key].value+'</strong></div>');

            }
        }
        return {
            restrict: 'EA',
            template: '<div class="report-header-container print-header">'
                          +' <div class="row">'
                    + '    <div class="col-md-2">'
                    + '                   <span class="js_company_code">{{ header.company_code }}</span>'
                    + '                   <span class="js_company_name"></span>'
                    + '                </div>'
                    + '               <div class="col-md-2 col-md-offset-8">'
                    + '                  <span></span>'
                    + '                 </div>'
                    + '             </div>'
                    + '            <div class="">'
                    + '                    <h2 class="text-uppercase text-center js_title">'
                    + '                    </h2>'
                    + '                    <div class="text-center js_subTitle">'
                    + '                     </div>'
                    + '                 </div>'
                    + '                 <div class="js_filters print-table">'
                    + '             </div>'
                    + '         </div>',
            link:link
        }
    });

    return module;
});

