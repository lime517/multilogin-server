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
  private $routes;

  public function __construct() {
    $this->include_dependency('classes/routes.php');
    $this->run_routes();
  }

  private function run_routes() {
    $this->routes = new routes; // Get some routes!
    $this->routes->register_loginRequest_route(); // Register the loginRequest Route
  }

  private function include_dependency($file) {
    require_once(plugin_dir_path( __FILE__ ) . $file);
  }
}
