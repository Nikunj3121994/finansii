define([], function() {
    var module = angular.module('app.pages.reports', []);

    module.controller('reportsController', ['$scope', function ($scope) {
        $scope.pdfPrint = function () {
            var doc = new jsPDF();
            for (var i = 0; i < 100; ++i) {
                doc.setTextColor(100);
                doc.text(20, 20, 'This is gray.');
                doc.setTextColor(150);
                doc.text(20, 30, 'This is light gray.');
                doc.setTextColor(255, 0, 0);
                doc.text(20, 40, 'This is red.');
                doc.setTextColor(0, 255, 0);
                doc.text(20, 50, 'This is green.');
                doc.setTextColor(0, 0, 255);
                doc.text(20, 60, 'This is blue.');

                doc.addPage();
            }
            console.log(doc.output('dataurlstring'));
            /*
             // Blob for saving.
             var blob = new Blob([doc.output()], { type: "aplication/pdf" });
             saveAs(blob, "report.pdf");
             */
        }
    }]);

    return module;

    /*

     .directive('dynamicPrint', function ($compile) {
     function link($scope, element, attrs) {

     $scope.pages = []; // ne morat vo scope
     $scope.addPage = function () {
     var pageHtml = $('<section data-print-page>');
     pageHtml.attr('page-number', $scope.pages.length);
     var page = $compile(pageHtml)($scope);
     element.append(page);
     $scope.pages.push(page);
     };
     $scope.addPage();

     $scope.addSection = function () {
     var sectionHtml = $('<section data-print-section>');
     var section = $compile(sectionHtml)($scope);

     var currentPage = _.last($scope.pages);
     if (!currentPage.scope().canAddSection(section)) {
     $scope.addPage();
     currentPage = _.last($scope.pages);
     }

     currentPage.append(section);
     currentPage.scope().sections.push(section);
     };
     for (var i = 0; i < 100; i++) {
     $scope.addSection();
     }

     }

     return {
     restrict: 'A',
     replace: true,
     scope: true,
     link: link,
     template: '<div class="print-container"></div>'
     }
     })
     .directive('printPage', function ($compile) {
     function link($scope, element, attrs) {
     $scope.sections = []; // ne morat vo scope

     function getHeight(section) {
     $('body').append(section);
     section.css('visibility', 'hidden');
     var height = section.outerHeight();
     section.css('visibility', '');
     section.remove();
     return height;
     };

     $scope.canAddSection = function (currentSection) {
     var sectionsHeight = function () {
     return 0;
     if (_.isUndefined(currentSection)) return 0;
     return getHeight(currentSection);
     }();

     _.each($scope.sections, function (section, key) {
     sectionsHeight += section.outerHeight();
     });
     console.log(sectionsHeight, element.height());
     return sectionsHeight < element.innerHeight();
     };

     }

     return {
     restrict: 'A',
     replace: true,
     scope: true,
     link: link,
     template: '<div class="print-page"></div>'
     }
     })
     .directive('printSection', function () {
     function link($scope, element, attrs) {
     $scope.parentPage = attrs.parentPage;
     }

     return {
     restrict: 'A',
     replace: true,
     scope: true,
     link: link,
     template: '<div class="print-section">section</div>'
     }
     });
     */
});