import Ember from 'ember';
import UnauthenticatedRouteMixin from 'ember-simple-auth/mixins/unauthenticated-route-mixin';

export default Ember.Route.extend(UnauthenticatedRouteMixin,{
    resetController(controller,isExiting)
    {
        if(isExiting){
            controller.set('errorMessage', '');
        }
    }
});
