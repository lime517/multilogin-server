<?php

// Routes

// Create route for login endpoint.
add_action('rest_api_init', function () {

  // With Parameters
  register_rest_route('multilogin/v1', 'login_request', array(
    'methods' => array('GET','POST'),
    'callback' => 'login_request',
  ));
});

// Example: /wp-json/multilogin/v1/login_request/?username=wow&password=amazing!
// Login endpoint callback
function login_request($request)
{

    // Run a sanitization
    $request->sanitize_params();

    // Establish a returnable array
    $returnable = array();

    // Are we being passed what we expected?
    if(isset($request['username']) && isset($request['password'])) {
      $request['MESSAGE'] = 'We have the two desired parameters.';

      // Check for the users table
      if(have_rows('users', 'option')) {
        while(have_rows('users', 'option')) {
          the_row();

          $username = get_sub_field('username');
          $password = get_sub_field('password');

          trigger_error($username . ' ' . $password, E_USER_NOTICE);

          if($username === $request['username'] && $password === $request['password']) {
            $permission = true;
          }
        }
      }

      // Permission
      if($permission === true) {
        $returnable['permission'] = 'true';
      } else {
        $returnable['permission'] = 'false';
      }

      return $returnable;
    } else {
      return 'not a valid request';
    }
}
