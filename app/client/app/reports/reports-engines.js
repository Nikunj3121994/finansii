define([
], function () {
    var module = angular.module('app.reports.engines', ['ui.bootstrap','app.reports.elements.headers.directives']);

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


    module.directive('dynamicReport', function ($compile,$filter) {
        function link($scope, element) {
            var printConfig=function(config,scope){
                var tmp={};
                tmp.printViewport=$('.print-viewport').html('');
                tmp.header=function(){
                    var header=$compile('<div report-header></div>')($scope);
                    return header;
                }();
                tmp.gridHeader=function(){

                    var headerSettingsDefault={levels:1};
                    if(_.isUndefined(config.headerSettings)) config.headerSettings=headerSettingsDefault;
                    config.fieldsOrder=[];
                    function appendToHeader(fields,level,numLevels){
                        for (var i = 0; i < fields.length; ++i) {
                            if(fields[i].type=="group"){
                                gridHeader.find('tr:nth-child('+(numLevels-level+1)+')')
                                    .append('<th colspan="'+fields[i].fields.length+'">'+fields[i].label+'</th>');
                                appendToHeader(fields[i].fields,level-1,numLevels);
                            }
                            else {
                                gridHeader.find('tr:nth-child('+(numLevels-level+1)+')')
                                .append('<th rowspan="'+level+'">'+fields[i].label+'</th>');
                                config.fieldsOrder.push({name:fields[i].name,format:fields[i].format || null});
                            }
                        }
                    }
                    var gridHeader=$('<div>');
                    for(var i=0;i<config.headerSettings.levels;i++){
                        gridHeader.append('<tr></tr>');
                    }
                    appendToHeader(config.fields,config.headerSettings.levels,config.headerSettings.levels);
                    return gridHeader;
                }();
                tmp.printSizes=function(){
                    var testPage=$('<div>').addClass('print-page');
                    var testTable=$('<table></table>');
                    var testRow=$('<tr><td>test</td></tr>');
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
            }($scope.reportConfig,$scope);

            var dataRows = generateData($scope.reportData,$scope.reportConfig);

            function generateData(data,config){
                if(!config.groups || !config.sums) return data;
                var dataTmp=[];
                var groups={};
                var sums={};
                for(var i=0;i<config.groups.length;i++){
                    groups[config.groups[i].name]=null;
                    sums[config.groups[i].name]={};
                    for(var m=0;m<config.sums.length;m++){
                        sums[config.groups[i].name][config.sums[m].field]=0;
                    }
                }
                for(var k=0;k<data.length;k++){
                    for(var j=0;j<config.groups.length;j++){
                        var group=null;
                        if(config.groups[j].groupType=='number') group=Math.floor(data[k][config.groups[j].field]/Math.pow(10,config.groups[j].group));
                        else if(config.groups[j].groupType=='text') group=data[k][config.groups[j].field];
                        if(groups[config.groups[j].name]!=null){
                            var tmpRow={};
                            if(groups[config.groups[j].name]!=group){
                                var prefix=config.groups[j].groupPrefix || '';
                                var field=config.groups[j].fieldPosition || config.groups[j].field;
                                if(config.groups[j].type=='header'){
                                    tmpRow[field]=prefix+groups[config.groups[j].name];
                                }else{
                                    tmpRow[field]=prefix+groups[config.groups[j].name];
                                    tmpRow.class=config.groups[j].name;
                                    for(var n=0;n<config.sums.length;n++){
                                        tmpRow[config.sums[n].field]=sums[config.groups[j].name][config.sums[n].field].toFixed(2);
                                       // console.log(tmpRow[config.sums[n].field]=sums[config.groups[j].name],sums[config.groups[j].name][config.sums[n].field]);
                                        sums[config.groups[j].name][config.sums[n].field]=0;
                                    }
                                }
                                dataTmp.push(tmpRow);
                                groups[config.groups[j].name]=group;
                            }
                        }else{
                            var tmpRow={};
                            groups[config.groups[j].name]=group
                            if(config.groups[j].type=='header'){
                                tmpRow[config.groups[j].fieldPosition]=groups[config.groups[j].name];
                                dataTmp.push(tmpRow);
                            }

                        }
                        for(var n=0;n<config.sums.length;n++){
                            sums[config.groups[j].name][config.sums[n].field]+=parseFloat(data[k][config.sums[n].field]);

                        }
                    }
                    dataTmp.push(data[k]);
                }
                for(var j=0;j<config.groups.length;j++){
                    var prefix=config.groups[j].groupPrefix || '';
                    var field=config.groups[j].fieldPosition || config.groups[j].field;
                    if(config.groups[j].type=='header') continue;
                    tmpRow={};
                    tmpRow[field]=prefix+groups[config.groups[j].name];
                    tmpRow.class=config.groups[j].name;
                    for(var n=0;n<config.sums.length;n++){
                        tmpRow[config.sums[n].field]=sums[config.groups[j].name][config.sums[n].field].toFixed(2);
                    }
                    dataTmp.push(tmpRow);
                }

                return dataTmp;
            }
            createPages($scope.reportConfig);
            //print();
            function createPages(config) {
                var perfTime = new Date().getTime();
                var pages = [];
                var numPage = 0;
                var numItems = 0;
                pages[numPage] = [];

                for (var i = 0; i < dataRows.length; i++) {
                    var row=[]
                    if(dataRows[i].class){
                        row.push('<tr class="'+dataRows[i].class+'">');
                    }else{
                        row.push('<tr>');
                    }

                    for (var j=0;j<config.fieldsOrder.length;j++) {
                        if(config.fieldsOrder[j].format=="text")
                            row.push('<td>' + (dataRows[i][config.fieldsOrder[j].name] || '') + '</td>');
                        else{
                            row.push('<td class="align-right">' + $filter('number')(dataRows[i][config.fieldsOrder[j].name] || 0,2) + '</td>');
                        }
                    }
                    row.push('</tr>');
                    pages[numPage].push(row.join(''));
                    numItems++;

                    if (numItems == printConfig.printSizes.contentSize) {
                        numItems = 0;
                        var page=$('<div>').addClass('print-page');
                        var content = $('<table></table>').append(printConfig.gridHeader.html()).append(pages[numPage].join(''));
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
                    var content = $('<table></table>').append(printConfig.gridHeader.html()).append(pages[numPage].join(''));
                    page.append(printConfig.header.clone()).append(content);
                    printConfig.printViewport.append(page);
                }
                console.log('Done in', new Date().getTime() - perfTime);
                // print();

            }

            function clearOverflow(container) {
                var height = container[0].offsetHeight;
                if (height > printConfig.printSizes.contentHeight) {
                    container.find('tr:last').remove();
                    return 1 + clearOverflow(container);
                } else {
                    return 0;
                }
            }
        }

        return {
            restrict: 'A',
            link: link,
            scope:{
                reportConfig:"=",
                reportData:"=",
                header:"="
            }
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

