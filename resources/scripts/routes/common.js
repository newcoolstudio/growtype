import "../autoload/bootstrap.js";

import {headerScroll} from "../components/header-scroll";
import {menu} from "../components/menu";
import {menuBurger} from "../components/menu-burger";
import {contentSearch} from "../components/content-search";
import {preventClicksOnEmptyLinks} from "../components/empty-links";
import {anchorLinkScroll} from "../components/anchor-link-scroll";
import {anchorLinkMainNavigation} from "../components/anchor-link-main-navigation";

import editorFrontend, {
    videoCover,
} from "../editor/gutenberg/frontend/main"

import {select} from "../plugins/chosen/select.js";
import {fancyboxGallery} from "../plugins/fancybox/fancybox.js";
import {qtranslate} from "../plugins/qtranslate/qtranslate.js";

export default {
    init() {
        select();
        headerScroll();
        menu();
        menuBurger();
        fancyboxGallery();
        qtranslate();
        preventClicksOnEmptyLinks();
        anchorLinkScroll();
        anchorLinkMainNavigation();
        contentSearch();
        editorFrontend();
    },
    finalize() {
    },
};