<?php
/*
   Plugin Name: Multilogin Server
   Plugin URI: https://safetyllama.com
   description:
   Version: .1
   Author: Joseph Greve
   Author URI: https://josephgreve.co
   License: GPL2
   */

namespace multilogin\server;

class multilogin_server
{
  public function __construct() {
    $this->include_dependency('routes.php');
  }

  private function include_dependency($file) {
    require_once(plugin_dir_path( __FILE__ ) . $file);
  }
}
