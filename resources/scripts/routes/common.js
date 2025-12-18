import "../autoload/bootstrap.js";

import {headerFixed} from "../components/header-fixed";
import {panel} from "../components/panel";
import {notice} from "../components/notice";
import {menu} from "../components/menu";
import {sidebar} from "../components/sidebar";
import {menuBurger} from "../components/menu-burger";
import {preventClicksOnEmptyLinks} from "../components/empty-links";
import {anchorLinkScroll} from "../components/anchor-link-scroll";
import {anchorLinkMainNavigation} from "../components/anchor-link-main-navigation";

import editorFrontend, {
    videoCover,
} from "../editor/gutenberg/frontend/main"

import {select} from "../plugins/chosen/select.js";
import {infoWindow} from "../components/infoWindow";

export default {
    init() {
        select();
        headerFixed();
        panel();
        notice();
        menu();
        sidebar();
        menuBurger();
        preventClicksOnEmptyLinks();
        anchorLinkScroll();
        anchorLinkMainNavigation();
        editorFrontend();
        infoWindow();
    }
};
