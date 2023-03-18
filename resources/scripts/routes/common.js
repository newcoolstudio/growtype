import "../autoload/bootstrap.js";

import {headerFixed} from "../components/header-fixed";
import {panelBg} from "../components/panel-bg";
import {notice} from "../components/notice";
import {menu} from "../components/menu";
import {menuBurger} from "../components/menu-burger";
import {preventClicksOnEmptyLinks} from "../components/empty-links";
import {anchorLinkScroll} from "../components/anchor-link-scroll";
import {anchorLinkMainNavigation} from "../components/anchor-link-main-navigation";

import editorFrontend, {
    videoCover,
} from "../editor/gutenberg/frontend/main"

import {select} from "../plugins/chosen/select.js";
import {fancyboxGallery} from "../plugins/fancybox/fancybox.js";

export default {
    init() {
        select();
        headerFixed();
        panelBg();
        notice();
        menu();
        menuBurger();
        fancyboxGallery();
        preventClicksOnEmptyLinks();
        anchorLinkScroll();
        anchorLinkMainNavigation();
        editorFrontend();
    },
    finalize() {
    },
};
