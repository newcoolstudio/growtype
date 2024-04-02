<?php

function growtype_is_home_page()
{
    return apply_filters('growtype_is_home_page', is_front_page());
}
