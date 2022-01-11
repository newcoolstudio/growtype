// import local dependencies
import Router from './util/router';
import common from './routes/common';

/** Populate Router instance with DOM routes */
const routes = new Router({
    common,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());


