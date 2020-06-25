<?php

namespace multilogin\server;

// Routes
class routes
{

    // Create route for login endpoint.
    public function register_loginRequest_route()
    {
        add_action('rest_api_init', function () {
            // With Parameters
            // Example: /wp-json/multilogin/v1/login_request/?username=wow&password=amazing!
            register_rest_route('multilogin/v1', 'login_request', array(
                'methods' => array('GET', 'POST'),
                'callback' => array($this, 'login_request_callback'),
            ));
        });
    }

    public function loginRequest_callback($request)
    {

        // Run a sanitization
        $request->sanitize_params();

        // Establish a returnable array
        $returnable = array();

        // Are we being passed what we expected?
        if (isset($request['username']) && isset($request['password'])) {
            $request['MESSAGE'] = 'We have the two desired parameters.';

            // Sanitize Username and Password
            $username = trim($request['username']);
            $password = trim($request['password']);

            // NATIVE WP USERS METHOD -
            $user = get_user_by('login', $username);

            $returnable['USER'] = $user;
            $permission = false; // Set to false initially.

            if ($user && wp_check_password($password, $user->data->user_pass, $user->ID)) {
                $returnable['PWD_CHECK_STATUS'] = 'Yup';
                $permission = true;
            } else {
                $returnable['PWD_CHECK_STATUS'] = 'Nope';
                $permission = false; // redundant, I suppose.
            }

            // Permission
            if ($permission === true) {
                $returnable['permission'] = 'true';
            } else {
                $returnable['permission'] = 'false';
            }

            return $returnable;
        } else {
            return 'not a valid request';
        }
    }
}
