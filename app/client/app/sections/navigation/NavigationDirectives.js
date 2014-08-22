define([], function() {

    /**
     * Navigation directives module
     * app.navigation.directives
     * @module
     */
    var module = angular.module('app.navigation.directives',
        [
        ]
    );

    /**
     * Main directive for side navigation
     * @function navigationDirective
     */
    module.directive('navigation', [function () {

        return {
            restrict: 'EA',
            controller: 'navigationController',
            templateUrl: 'app/sections/navigation/views/navigation.html'
        }
    }]);

    module.directive('collapseItem', ['$rootScope', '$location', function ($rootScope, $location) {
        function link($scope, element, attrs) {
            var hasSubMenu = (element.children('ul').length > 0);

            $scope.opened = isOpenedFromUrl();
            $rootScope.$on('navItemClicked', function (event) {
                $scope.opened = false;
            });

            element.children('a').on('click', function (event) {
                if (hasSubMenu) event.preventDefault();

                if (!$scope.opened) {
                    $rootScope.$emit('navItemClicked');
                }
                $scope.opened = !$scope.opened;
                $scope.$apply();
            });


            function isOpenedFromUrl() {
                var link = $scope.menuItem.link;
                var path = $location.$$path.split('/');
                return (link == path[1]);
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    }]);

    /**
     * Check if item has sub menu. Remove <ul> if not
     * so collapseNav directive can parse the menu subitems correctly
     * @function hasSubmenuDirective
     */
    module.directive('hasSubmenu', function () {
        function link($scope, element, attr) {
            if (!$scope.menuItem.subMenu) {
                element.remove();
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });


    /**
     * Directive taken from square template.
     * Used for adding a jQuery scroll to navigation
     * @function
     */
    module.directive('slimScroll', [
        function () {
            return {
                restrict: 'A',
                link: function (scope, ele, attrs) {
                    return ele.slimScroll({
                        height: attrs.scrollHeight || '100%'
                    });
                }
            };
        }
    ]);


    /* === DEPRICATED, jquery based === */
    /**
     * Directive taken from square template.
     * Used for collapsing sub menu items.
     * @function
     */
    module.directive('collapseNav', [
        function () {
            return {
                restrict: 'A',
                link: function (scope, ele, attrs) {
                    var $a, $aRest, $lists, $listsRest, app;
                    $lists = ele;

                    if ($lists.children('ul').length == 0) return;
                    $lists.append('<i class="fa fa-caret-right icon-has-ul"></i>');
                    $a = $lists.children('a');
                    $listsRest = ele.children('li').not($lists);
                    $aRest = $listsRest.children('a');
                    app = $('#app');
                    $a.on('click', function (event) {
                        var $parent, $this;
                        if (app.hasClass('nav-min')) {
                            return false;
                        }
                        $this = $(this);
                        $parent = $this.parent('li');
                        $lists.not($parent).removeClass('open').find('ul').slideUp();
                        $parent.toggleClass('open').find('ul').slideToggle();
                        return event.preventDefault();
                    });
                    $aRest.on('click', function (event) {
                        return $lists.removeClass('open').find('ul').slideUp();
                    });
                    return scope.$on('minNav:enabled', function (event) {
                        return $lists.removeClass('open').find('ul').slideUp();
                    });
                }
            };
        }
    ]);

    /**
     * Directive taken from square template.
     * Used for marking a menu item as active/selected
     * @function
     */
    module.directive('highlightActive', [
        function () {
            return {
                restrict: "A",
                controller: [
                    '$scope', '$element', '$attrs', '$location', function ($scope, $element, $attrs, $location) {
                        var highlightActive, links, path;
                        links = $element.find('a');
                        path = function () {
                            return $location.path();
                        };
                        highlightActive = function (links, path) {
                            path = '#' + path;
                            return angular.forEach(links, function (link) {
                                var $li, $link, href;
                                $link = angular.element(link);
                                $li = $link.parent('li');
                                href = $link.attr('href');
                                if ($li.hasClass('active')) {
                                    $li.removeClass('active');
                                }
                                if (path.indexOf(href) === 0) {
                                    return $li.addClass('active');
                                }
                            });
                        };
                        highlightActive(links, $location.path());
                        return $scope.$watch(path, function (newVal, oldVal) {
                            if (newVal === oldVal) {
                                return;
                            }
                            return highlightActive(links, $location.path());
                        });
                    }
                ]
            };
        }
    ]);

    /**
     * Fix for ng-repeat not being compiled when collapseNav is traversing DOM
     * Sending broadcast to collapseNav when to process the DOM
     * @function
     */
    module.directive('onRepeatDone', function () {
        function link($scope, element, attr) {
            if ($scope.$last) {
                $scope.$emit(attr["onRepeatDone"] || "repeat_done", element);
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });

    return module;
});