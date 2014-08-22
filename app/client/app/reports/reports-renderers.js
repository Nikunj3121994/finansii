define([
], function () {
    var INTGRIDRENDERER = React.createClass({displayName: 'INTGRIDRENDERER',
        render: function () {

            var data = this.props.data;

            return (
                React.DOM.table(null,
                    data.map(function (row) {
                        return (
                            React.DOM.tr(null,
                                row.map(function (col) {
                                    return (
                                        React.DOM.td(null, col)
                                        );
                                })
                            )
                            );
//
                    })
                )
                );
        }
    });
    return INTGRIDRENDERER;
});
