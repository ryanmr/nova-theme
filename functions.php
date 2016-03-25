<?php


require_once('nova/Singleton.php');
require_once('nova/TopBarWalker.php');
require_once('nova/Nova.php');
require_once('nova/Template.php');


Nova::get_instance()->initialize();
Template::get_instance()->initialize();
