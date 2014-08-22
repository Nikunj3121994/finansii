define([
    'reports/reports-renderers',
    'reports/reports-engines',

    'reports/elements/dynamic/simple-grid/simple-grid',
    'reports/elements/static/headers/headers',
    'reports/elements/static/footers/footers',

    'reports/templates/simple1/simple-report1'

], function () {
    return angular.module('app.reports', [
        'app.reports.engines',

        'app.reports.elements.simple-grid',
        'app.reports.elements.headers',
        'app.reports.elements.footers',

        'app.reports.templates.simple1'
    ]);
});