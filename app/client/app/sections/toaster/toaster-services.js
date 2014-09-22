define([], function() {

    var module=angular.module('app.sections.toaster',[]);
    module.factory('toasterService',function(){
        var toaster={};
        toaster.container=$('.toaster-container');
        toaster.success=$('<div class="notice bg-green marker-on-right"><i class="fa fa-check"></i></div>"');
        toaster.info=$('<div class="notice bg-lightBlue marker-on-right"><i class="fa fa-info-circle"></i></div>"');
        toaster.warning=$('<div class="notice bg-amber marker-on-right"><i class="fa fa-warning"></i></div>" ');
        toaster.error=$('<div class="notice bg-darkRed marker-on-right"><i class="fa fa-times-circle"></i></div>" ');
        toaster.setSuccess=function(success){
            var notice= toaster.success.clone();
            notice.append(success);
            notice.fadeIn();
            toaster.container.append(notice);
            setTimeout(function(){
                notice.fadeOut(300, function() { $(this).remove(); });
            },2000)
        }
        toaster.setInfo=function(info){
            var notice= toaster.info.clone();
            notice.append(info);
            notice.fadeIn();
            toaster.container.append(notice);
            setTimeout(function(){
                notice.fadeOut(300, function() { $(this).remove(); });
            },2000)
        }
        toaster.setWarning=function(warning){
            var notice= toaster.warning.clone();
            notice.append(warning);
            notice.fadeIn();
            toaster.container.append(notice);
            setTimeout(function(){
                notice.fadeOut(300, function() { $(this).remove(); });
            },2000)
        }
        toaster.setError=function(error){
            var notice= toaster.error.clone();
            notice.append(error);
            notice.fadeIn();
            toaster.container.append(notice);
            setTimeout(function(){
                notice.fadeOut(300, function() { $(this).remove(); });
            },2000)
        }
        return toaster;
    });
    return module;
});