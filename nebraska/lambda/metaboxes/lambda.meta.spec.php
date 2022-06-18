<?php

$lambda_meta_data = new WPAlchemy_MetaBox(array
(
    'id' => UT_THEME_INITIAL . 'metapanel',
    'title' => UT_THEME_NAME . ' Meta Panel',
    'template' => get_template_directory() . '/lambda/metaboxes/lambda.metapanel.php',
    'types' => array('page', UT_PORTFOLIO_SLUG, 'post', 'product', 'tribe_events'),
    'autosave' => TRUE,
    'priority' => 'high',
    'init_action' => 'lambda_pttiny_init'
));

$slider_meta_data = new WPAlchemy_MetaBox(array
(
    'id' => UT_THEME_INITIAL . 'slider',
    'title' => __('Featured Header Settings', UT_THEME_NAME),
    'template' => get_template_directory() . '/lambda/metaboxes/lambda.slider.php',
    'types' => array('page', UT_PORTFOLIO_SLUG, 'post', 'product', 'tribe_events'),
    'autosave' => TRUE,
    'priority' => 'low'
));

$taxonomy_meta_data = new WPAlchemy_Taxonomy(array
(
    'taxonomy' => 'project-type',
    'template' => get_template_directory() . '/lambda/metaboxes/lambda.taxonomy.php'
));