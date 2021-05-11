'use stict';

function Route(name, htmlName, defaultRoute) {
    try {
        if(!name || !htmlName) {
            throw 'error: name and htmlName params are mandatories';
        }
        this.constructor(name, htmlName, defaultRoute);
    } catch (e) {
        console.error(e);
    }
}

Route.prototype = {
    name: undefined,
    htmlName: undefined,
    default: undefined,
    constructor: function (name, htmlName, defaultRoute) {
        this.name = name;
        this.htmlName = htmlName;
        this.default = defaultRoute;
    },
    isActiveRoute: function (hashedPath) {
        // Si / passage de paramètre
        var posParam = hashedPath.indexOf('/');
        var newRoute = hashedPath;
        if(posParam > 0){
            var param = hashedPath.substring(posParam);
            newRoute = hashedPath.substring(0, posParam);
            console.log();
        }

        return newRoute.replace('#', '') === this.name; 
    }
}