<?php
require_once __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once(get_template_directory() . '/jwt-token.php');

/** hide extra resource endpoints from /wp/v2 */
add_filter('rest_endpoints', function ($endpoints) {

    foreach ($endpoints as $route => $details) {
        // hide media endpoint
        if (strpos($route, '/wp/v2/media') === 0) {
            unset($endpoints[$route]);
        }

        // hide menu-items endpoint
        if (strpos($route, '/wp/v2/menu-items') === 0) {
            unset($endpoints[$route]);
        }

        // hide blocks endpoint
        if (strpos($route, '/wp/v2/blocks') === 0) {
            unset($endpoints[$route]);
        }

        // hide templates endpoint
        if (strpos($route, '/wp/v2/templates') === 0) {
            unset($endpoints[$route]);
        }

        // hide template-parts endpoint
        if (strpos($route, '/wp/v2/template-parts') === 0) {
            unset($endpoints[$route]);
        }

        // hide global-styles endpoint
        if (strpos($route, '/wp/v2/global-styles') === 0) {
            unset($endpoints[$route]);
        }

        // hide navigation endpoint
        if (strpos($route, '/wp/v2/navigation') === 0) {
            unset($endpoints[$route]);
        }

        // hide types endpoint
        if (strpos($route, '/wp/v2/types') === 0) {
            unset($endpoints[$route]);
        }

        // hide font-families endpoint
        if (strpos($route, '/wp/v2/font-families') === 0) {
            unset($endpoints[$route]);
        }

        // hide statuses endpoint
        if (strpos($route, '/wp/v2/statuses') === 0) {
            unset($endpoints[$route]);
        }

        // hide taxonomies endpoint
        if (strpos($route, '/wp/v2/taxonomies') === 0) {
            unset($endpoints[$route]);
        }

        // hide categories endpoint
        if (strpos($route, '/wp/v2/categories') === 0) {
            unset($endpoints[$route]);
        }

        // hide tags endpoint
        if (strpos($route, '/wp/v2/tags') === 0) {
            unset($endpoints[$route]);
        }

        // hide menus endpoint
        if (strpos($route, '/wp/v2/menus') === 0) {
            unset($endpoints[$route]);
        }

        // hide statuses endpoint
        if (strpos($route, '/wp/v2/statuses') === 0) {
            unset($endpoints[$route]);
        }

        // hide wp_pattern_category endpoint
        if (strpos($route, '/wp/v2/wp_pattern_category') === 0) {
            unset($endpoints[$route]);
        }

        // hide comments endpoint
        if (strpos($route, '/wp/v2/comments') === 0) {
            unset($endpoints[$route]);
        }

        // hide search endpoint
        if (strpos($route, '/wp/v2/search') === 0) {
            unset($endpoints[$route]);
        }

        // hide block-renderer endpoint
        if (strpos($route, '/wp/v2/block-renderer') === 0) {
            unset($endpoints[$route]);
        }

        // hide block-types endpoint
        if (strpos($route, '/wp/v2/block-types') === 0) {
            unset($endpoints[$route]);
        }

        // hide themes endpoint
        if (strpos($route, '/wp/v2/themes') === 0) {
            unset($endpoints[$route]);
        }

        // hide plugins endpoint
        if (strpos($route, '/wp/v2/plugins') === 0) {
            unset($endpoints[$route]);
        }

        // hide sidebars endpoint
        if (strpos($route, '/wp/v2/sidebars') === 0) {
            unset($endpoints[$route]);
        }

        // hide widget-types endpoint
        if (strpos($route, '/wp/v2/widget-types') === 0) {
            unset($endpoints[$route]);
        }

        // hide widgets endpoint
        if (strpos($route, '/wp/v2/widgets') === 0) {
            unset($endpoints[$route]);
        }

        // hide block-directory endpoint
        if (strpos($route, '/wp/v2/block-directory') === 0) {
            unset($endpoints[$route]);
        }

        // hide pattern-directory endpoint
        if (strpos($route, '/wp/v2/pattern-directory') === 0) {
            unset($endpoints[$route]);
        }

        // hide block-directory endpoint
        if (strpos($route, '/wp/v2/block-directory') === 0) {
            unset($endpoints[$route]);
        }

        // hide block-patterns endpoint
        if (strpos($route, '/wp/v2/block-patterns') === 0) {
            unset($endpoints[$route]);
        }

        // hide menu-locations endpoint
        if (strpos($route, '/wp/v2/menu-locations') === 0) {
            unset($endpoints[$route]);
        }

        // hide font-collections endpoint
        if (strpos($route, '/wp/v2/font-collections') === 0) {
            unset($endpoints[$route]);
        }

        // hide users endpoint
        if (strpos($route, '/wp/v2/users') === 0) {
            unset($endpoints[$route]);
        }

        // hide settings endpoint
        if (strpos($route, '/wp/v2/settings') === 0) {
            unset($endpoints[$route]);
        }

        // If it's posts routes
        if (strpos($route, '/wp/v2/posts') === 0) {
            foreach ($details as $key => $endpoint) {
                // only GET routes
                if (isset($endpoint['methods']) && $endpoint['methods'] !== 'GET') {
                    unset($endpoints[$route][$key]);
                }
                // only 2 GET route available
                if ($route !== '/wp/v2/posts' && $route !== '/wp/v2/posts/(?P<id>[\\d]+)') {
                    unset($endpoints[$route]);
                }
            }
        }
        // keep pages route[Page by ID]
        if (strpos($route, '/wp/v2/pages') === 0) {
            foreach ($details as $key => $endpoint) {
                // only GET routes
                if (isset($endpoint['methods']) && $endpoint['methods'] !== 'GET') {
                    unset($endpoints[$route][$key]);
                }
                // only 2 GET route available
                if ($route !== '/wp/v2/pages/(?P<id>[\\d]+)') {
                    unset($endpoints[$route]);
                }
            }
        }


    }

    return $endpoints;
});


/** register resource endpoint /auth/user/register */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/auth/user/register', array(
        'methods' => 'POST',
        'callback' => 'theme_user_register',
        'permission_callback' => '__return_true',
        'args' => [
            'username' => [
                'required' => 'true',
                'type' => 'string',
                'description' => 'enter your username for account'
            ],
            'email' => [
                'required' => 'true',
                'type' => 'string',
                'description' => 'enter your email for account',
                'validate_callback' => function ($param) {
                    if (is_email($param)) {
                        return true;
                    } else {
                        return false;
                    }
                }
            ],
            'password' => [
                'required' => 'true',
                'type' => 'string',
                'description' => 'enter your password for account'
            ],
        ],
    ));
});
function theme_user_register($request)
{
    $username = $request['username'];
    $email = $request['email'];
    $password = $request['password'];

    if (isset($username) && isset($email) && isset($password)) {
        if (!is_email($email)) {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'Email is invalid'
            ], 403);
        }

        if (username_exists($username) || email_exists($email)) {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'Username or email is exist'
            ], 403);
        }

        // If all validation passes, create the user
        $user_id = wp_create_user($username, $password, $email);

        // set role for new user
        if (!is_wp_error($user_id)) {
            $user = new WP_User($user_id);
            $user->set_role('subscriber');
        }

        $jwtAuth = new JWTAuth();
        $userId = $user_id;

        $accessToken = $jwtAuth->generateAccessToken($userId, $email);
        $refreshToken = $jwtAuth->generateRefreshToken($userId, $email);

        return new WP_REST_Response([
            'status' => 'success',
            'user' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'user' => $user_id
            ],
            'message' => 'User registered successfully'
        ], 200);
    } else {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Please provide all details'
        ], 403);
    }
}


/** login resource endoint /auth/user/login */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/auth/user/login', array(
        'methods' => 'POST',
        'callback' => 'theme_user_login',
        'permission_callback' => '__return_true',
        'args' => array(
            'username' => array(
                'required' => true,
                'type' => 'string',
                'description' => 'enter your username',
                'validate_callback' => function ($param) {
                    return !empty($param);
                }
            ),
            'password' => array(
                'required' => true,
                'type' => 'string',
                'description' => 'enter your password',
                'validate_callback' => function ($param) {
                    return !empty($param);
                }
            ),
        ),
    ));
});
function theme_user_login($request)
{
    $username = $request['username'];
    $password = $request['password'];

    if (isset($username) && isset($password)) {

        if (username_exists($username)) {
            $user_check = wp_authenticate_username_password(null, $username, $password);

            if (is_wp_error($user_check)) {
                // Authentication failed
                $error_message = $user_check->get_error_message();

                return new WP_REST_Response([
                    'status' => 'error',
                    'error' => $error_message,
                    'message' => 'User validation failed, Please try again!'
                ], 403);
            } else {
                // Authentication successful
                $jwtAuth = new JWTAuth();
                $userId = $user_check->ID;
                $email = $user_check->user_email;

                $accessToken = $jwtAuth->generateAccessToken($userId, $email);
                $refreshToken = $jwtAuth->generateRefreshToken($userId, $email);

                return new WP_REST_Response([
                    'status' => 'success',
                    'user' => [
                        'access_token' => $accessToken,
                        'refresh_token' => $refreshToken,
                        'user' => $userId
                    ],
                    'message' => 'User login successfully'
                ], 200);
            }

        } else {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'Username or email not exist'
            ], 403);
            exit;
        }
    } else {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Please provide all details'
        ], 403);
        exit;
    }
}

/** get user info resource: /auth/user/get-user */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/auth/user/get-user', array(
        'methods' => 'POST',
        'callback' => 'theme_get_user',
        'permission_callback' => '__return_true',
        'args' => array(
            'access_token' => array(
                'required' => true,
                'type' => 'string',
                'description' => 'user info get using access jwt token',
                'validate_callback' => function ($param) {
                    if ($param) {
                        return true;
                    } else {
                        return false;
                    }
                },
            ),
        ),
    ));
});
function theme_get_user($request)
{
    // Get Authorization header
    $auth_header = $request['access_token'];
    if (!$auth_header) {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Authorization token missing'
        ], 401);
    }

    // Remove Bearer prefix
    $token = str_replace('Bearer ', '', $auth_header);
    $secret_key = 'f02741024fda9ccc8f70eedef93692c8085a0db7'; // must match your login secret

    try {
        // Decode and validate token
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));

        // Extract user_id from token payload
        if (!isset($decoded->data->user_id)) {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'Invalid token payload'
            ], 401);
        }

        $user_id = $decoded->data->user_id;
        $user = get_user_by('id', $user_id);

        if (!$user) {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'User not found'
            ], 404);
        }

        // Return user data
        return new WP_REST_Response([
            'status' => 'success',
            'user' => [
                'id' => $user->ID,
                'username' => $user->user_login,
                'email' => $user->user_email,
                'name' => $user->display_name,
                'roles' => $user->roles,
            ]
        ], 200);

    } catch (Exception $e) {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Invalid or expired token',
            'error' => $e->getMessage()
        ], 401);
    }
}


/** get user info resource: /auth/user/get-user */
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/auth/user/refresh-token', array(
        'methods' => 'POST',
        'callback' => 'theme_refresh_token',
        'permission_callback' => '__return_true',
        'args' => array(
            'access_token' => array(
                'required' => true,
                'type' => 'string',
                'description' => 'enter access jwt token',
            ),
        ),
    ));
});
function theme_refresh_token($request)
{
    // Get Authorization header
    $auth_header = $request['access_token'];
    if (!$auth_header) {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Authorization token missing'
        ], 401);
    }

    // Remove Bearer prefix
    $token = str_replace('Bearer ', '', $auth_header);
    $secret_key = 'f02741024fda9ccc8f70eedef93692c8085a0db7'; // must match your login secret

    try {
        // Decode and validate token
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));

        // Extract user_id from token payload
        if (!isset($decoded->data->user_id)) {
            return new WP_REST_Response([
                'status' => 'failed',
                'message' => 'Invalid token payload'
            ], 401);
        }

        $user_id = $decoded->data->user_id;
        $user = get_user_by('id', $user_id);
        $user_email = $user->user_email;

        // Authentication successful
        $jwtAuth = new JWTAuth();
        $accessToken = $jwtAuth->generateAccessToken($user_id, $user_email);
        $refreshToken = $jwtAuth->generateRefreshToken($user_id, $user_email);

        return new WP_REST_Response([
            'status' => 'success',
            'user' => [
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken
            ],
            'message' => 'Token generated successfully'
        ], 200);

    } catch (Exception $e) {
        return new WP_REST_Response([
            'status' => 'failed',
            'message' => 'Invalid or expired token',
            'error' => $e->getMessage()
        ], 401);
    }
}

?>