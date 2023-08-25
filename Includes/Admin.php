<?php

namespace CodeNestVentures\SchoolAddon;

use CodeNestVentures\SchoolAddon\Admin\Menu;
use CodeNestVentures\SchoolAddon\Admin\PostType\Footer;


class Admin {


	public function __construct() {

		if ( is_admin() ) {
//			new Menu();
		}
	}
}