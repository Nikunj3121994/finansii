define([
], function () {
    var module = angular.module('app.reports.engines', ['ui.bootstrap']);

    module.directive('dynamicPages', function () {
        function link($scope, element, attrs) {
            var perfTime = new Date().getTime();

            // get the same css properties as print-viewport
            element.addClass('init-print-viewport');

            $scope.$on('allRowsRendered', function () {
                console.log('allRowsRendered in', new Date().getTime() - perfTime);
                sortIntoPages();
                console.log('finished in', new Date().getTime() - perfTime);
            });

            var printElements = {
                printContainer: $('.print-viewport').empty()[0],
                pageDiv: $('<div class="print-page"></div>'),
                pageContentDiv: $('<div class="print-page-content"></div>')
            };

            function sortIntoPages() {
                var printPageStack = [];
                var pageRowStack = [];
                var pageRowHeight = 0;
                var currentPageHeight = 0;

                initPrintElements();
                var currentPage = createPage();

                _.each(printElements.rowStack, function (row, i) {
                    var currentRowHeight = row.offsetHeight;
                    if (pageRowHeight + currentRowHeight >= currentPageHeight) {
                        pageRowHeight = 0;
                        addRowsToPage(pageRowStack);
                    }
                    pageRowHeight += currentRowHeight;
                    pageRowStack.push(row);
                });
                addRowsToPage(pageRowStack);

                function addRowsToPage(pageRowStack) {
                    _.defer(function (pageRowStack, currentPage) {
                        while (pageRowStack.length > 0) {
                            currentPage.appendChild(pageRowStack.shift());
                        }
                    }, pageRowStack, currentPage);
                    currentPage = createPage();
                }

                function createPage() {
                    pageRowStack = [];
                    var page = printElements.pageDiv.clone();

                    var pageStats = printElements.pageStats.clone().css('display', '');
                    var gridHead = printElements.gridHead.clone().css('display', '');
                    var pageContent = printElements.pageContentDiv.clone();


                    page.append(pageStats);
                    if (_.isEmpty(printPageStack))
                        page.append(printElements.printHeader);
                    page.append(gridHead);
                    page.append(pageContent);

                    printPageStack.push(page);
                    printElements.printContainer.appendChild(page[0]);
                    applyDimensions(page, pageContent);

                    return pageContent[0];
                }

                function applyDimensions(page, pageContent) {
                    var pageHeight = page.height();
                    var pageChildDivs = page.children();
                    _.each(pageChildDivs, function (div) {
                        pageHeight -= div.offsetHeight;
                    });
                    currentPageHeight = pageHeight - 10; // have a 10px error margin
                }
            }

            function initPrintElements() {
                // get print- elements from angular element DOM
                printElements.printHeader = element.find('.print-header');
                printElements.pageStats = element.find('.print-page-stats');
                printElements.gridHead = element.find('.print-grid-head');
                printElements.rowStack = element.find('.print-row');
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });


    module.directive('dynamicPages1', function () {
        function link($scope, element) {
            var perfTime = new Date().getTime();
            var dataRows = [];
            for (var i = 0; i < 10000; ++i) {
                dataRows[i] = [];
                for (var j = 0; j < 5; ++j) {
                    dataRows[i][j] = Math.random();
                }
            }
            var initContainer = $('.init-container')[0];
            React.renderComponent(
                INTGRIDRENDERER({data: dataRows}),
                initContainer
            );
            var rowStack = $(initContainer).find('tr');
            console.log('INIT Done in', new Date().getTime() - perfTime);
            renderPages();
            console.log('FINISHED in', new Date().getTime() - perfTime);
            var rowStack = $(initContainer).find('tr');
            console.log('INIT Done in', new Date().getTime() - perfTime);
            renderPages();
            console.log('FINISHED in', new Date().getTime() - perfTime);
            function renderPages() {
                var printContainer = $('.print-viewport')[0];
                var pageDiv = $('<div class="print-page">page</div>');
                var pageRowHeight = 0;
                var pageRowStack = [];
                for (var i = 0; i < rowStack.length; i++) {
                    var currentRowHeight = rowStack[i].offsetHeight;
                    if (pageRowHeight + currentRowHeight > 600) {
                        var tmpPage = pageDiv.clone()[0];
                        console.log(tmpPage);
                        React.renderComponent(
                            INTGRIDRENDERER({data: pageRowStack}),
                            tmpPage
                        );
                        pageRowStack = [];
                        printContainer.appendChild(tmpPage);
                    }
                    pageRowStack.push(dataRows[i]);
                }

            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });


    module.directive('dynamicPages2', function () {
        function link($scope, element) {

            var printConfig=function(){
                var tmp={};
                tmp.printViewport=$('.print-viewport');
                tmp.header=$('<div class="print-header">Simple header</div>');
                tmp.gridHeader=function(){

                    var gridHeader=['<div class="print-table-row">'];
                    for (var i = 0; i < 5; ++i) {
                        gridHeader.push('<div class="print-table-cell">head'+i+'</div>');
                    }
                    gridHeader.push('</div>');
                    return $(gridHeader.join(''));
                }();
                tmp.printSizes=function(){
                    var testPage=$('<div>').addClass('print-page');
                    var testTable=$('<div class="print-table"></div>');
                    var testRow=$('<div class="print-table-row"><div class="print-table-cell">test</div></div>');
                    testTable[0].appendChild(tmp.gridHeader[0]);
                    testTable[0].appendChild(testRow[0]);
                    testPage[0].appendChild(tmp.header[0]);
                    testPage[0].appendChild(testTable[0]);
                    tmp.printViewport[0].appendChild(testPage[0]);

                    var obj={
                        headerHeight:tmp.header[0].offsetHeight,
                        gridHeaderHeight:tmp.gridHeader[0].offsetHeight,
                        pageHeight:testPage[0].offsetHeight
                    };
                    obj.contentHeight=function(){
                        var height=parseInt(obj.pageHeight);

                        for(var key in obj){
                               if(key!="pageHeight"){
                                   height-=obj[key];
                               }
                        }

                        return height+22;
                    }();

                    obj.contentSize=parseInt(Math.floor(obj.contentHeight/testRow[0].offsetHeight));
                    testPage.remove();
                    return obj;
                }();
                return tmp;
            }();

            var dataRows = [];
            for (var i = 0; i < 10000; ++i) {
                dataRows[i] = {};
                for (var j = 0; j < 5; ++j) {
                    dataRows[i][j] = Math.random();
                }
            }
            console.log(printConfig);
            createPages();
            function createPages() {
                var perfTime = new Date().getTime();
                var pages = [];
                var numPage = 0;
                var numItems = 0;
                pages[numPage] = [];

                for (var i = 0; i < 100; i++) {
                    var row = ['<div class="print-table-row">'];
                    for (var col in dataRows[i]) {
                        row.push('<div class="print-table-cell">' + dataRows[i][col] + '</div>');
                    }
                    row.push('</div>');
                    pages[numPage].push(row.join(''));
                    numItems++;

                    if (numItems == printConfig.printSizes.contentSize) {
                        numItems = 0;
                        var page=$('<div>').addClass('print-page');
                        var content = $('<div class="print-table"></div>').append(printConfig.gridHeader.clone()).append(pages[numPage].join(''));
                        page.append(printConfig.header.clone()).append(content);
                        printConfig.printViewport.append(page);
                        var excludedItems = clearOverflow(content);
                        numPage++;
                        pages[numPage] = [];
                        i -= excludedItems;
                    }
                }
                if(numItems<printConfig.printSizes.contentSize){
                    var page=$('<div>').addClass('print-page');
                    var content = $('<div class="print-table"></div>').append(printConfig.gridHeader.clone()).append(pages[numPage].join(''));
                    page.append(printConfig.header.clone()).append(content);
                    printConfig.printViewport.append(page);
                }
                console.log('Done in', new Date().getTime() - perfTime);
                // print();

            }

            function clearOverflow(container) {
                var height = container[0].offsetHeight;
                if (height > printConfig.printSizes.contentHeight) {
                    container.find('.print-table-row:last').remove();
                    return 1 + clearOverflow(container);
                } else {
                    return 0;
                }
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });

    module.directive('onRowsRendered', function ($timeout) {
        function link($scope, element, attrs) {
            if ($scope.$last) {
                $timeout(function() {
                    $scope.$emit('allRowsRendered');
                });
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });

    return module;
});
