<?php
/**
 * ApiController class file
 * @author Joachim Werner <joachim.werner@diggin-data.de>  
 */
/**
 * ApiController 
 * 
 * @uses Controller
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @author 
 * @see http://www.gen-x-design.com/archives/making-restful-requests-in-php/
 * @license (tbd)
 */
class ApiController extends Api
{
    // {{{ *** Members ***
    /**
     * Key which has to be in HTTP USERNAME and PASSWORD headers 
     */
    Const APPLICATION_ID = 'ASCCPE';

    private $format = 'json';
    // }}} 
    // {{{ filters
    /**
     * @return array action filters
     */
    public function filters()
    {
           return array(
            'accessControl', // perform access control for CRUD operations
            array(
                'RestfullYii.filters.ERestFilter + 
                REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
        );
    } 
    
    public function actionsRestfull()
    {
        return array(
            'REST.'=>'RestfullYii.actions.ERestActionProvider',
        );
    }  
    public function actionIndex()
    {
        echo CJSON::encode(array(1, 2, 3));
    } // }}} 
    // {{{ actionList
    public function actionList()
    {
        $this->_checkAuth();
        switch($_GET['model'])
        {
            case 'posts': // {{{ 
                $models = Post::model()->findAll();
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>list</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                exit; // }}} Yii::app()->end();
        }
        if(is_null($models)) { // if(empty($models))
            $this->_sendResponse(200, sprintf(
                'No items where found for model <b>%s</b>',
                $_GET['model']) );
        } else {
            $rows = array();
            foreach($models as $model)
                $rows[] = $model->attributes;

            $this->_sendResponse(200, CJSON::encode($rows));
        }
    } // }}} 
    // {{{ actionView
    /* Shows a single item
     * 
     * @access public
     * @return void
     */
    public function actionView()
    {
        $this->_checkAuth();
        // Check if id was submitted via GET
        if(!isset($_GET['id']))
            $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );

        switch($_GET['model'])
        {
            // Find respective model    
            case 'posts': // {{{ 
                $model = Post::model()->findByPk($_GET['id']);
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf(
                    'Mode <b>view</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                exit; // }}} 
        }
        if(is_null($model)) {
            $this->_sendResponse(404, 'No Item found with id '.$_GET['id']);
        } else {
            $this->_sendResponse(200, $this->_getObjectEncoded($_GET['model'], $model->attributes));
        }
    } // }}} 
    // {{{ actionCreate
    /**
     * Creates a new item
     * 
     * @access public
     * @return void
     */
    public function actionCreate()
    {
        $this->_checkAuth();

        switch($_GET['model'])
        {
            // Get an instance of the respective model
            case 'posts': // {{{ 
                $model = new Post;                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf(
                    'Mode <b>create</b> is not implemented for model <b>%s</b>',
                    $_GET['model']) );
                exit; // }}} 
        }
        // Try to assign POST values to attributes
        foreach($_POST as $var=>$value) {
            // Does the model have this attribute?
            if($model->hasAttribute($var)) {
                $model->$var = $value;
            } else {
                // No, raise an error
                $this->_sendResponse(500, sprintf(
                    'Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_GET['model']) );
            }
        }
        // Try to save the model
        if($model->save()) {
            // Saving was OK
            $this->_sendResponse(200, $this->_getObjectEncoded($_GET['model'], $model->attributes) );
        } else {
            // Errors occurred
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error) {
                    $msg .= "<li>$attr_error</li>";
                }        
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }

        var_dump($_REQUEST);
    } // }}}     
    // {{{ actionUpdate
    /**
     * Update a single iten
     * 
     * @access public
     * @return void
     */
    public function actionUpdate()
    {
        $this->_checkAuth();

        // Get PUT parameters
        parse_str(file_get_contents('php://input'), $put_vars);

        switch($_GET['model'])
        {
            // Find respective model
            case 'posts': // {{{ 
                $model = Post::model()->findByPk($_GET['id']);                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>update</b> is not implemented for model <b>%s</b>',$_GET['model']) );
                exit; // }}} 
        }
        if(is_null($model))
            $this->_sendResponse(400, sprintf(
                "Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",$_GET['model'], $_GET['id']) );
        
        // Try to assign PUT parameters to attributes
        foreach($put_vars as $var=>$value) {
            // Does model have this attribute?
            if($model->hasAttribute($var)) {
                $model->$var = $value;
            } else {
                // No, raise error
                $this->_sendResponse(500, sprintf(
                    'Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var, $_GET['model']) );
            }
        }
        // Try to save the model
        if($model->save()) {
            $this->_sendResponse(200, sprintf(
                'The model <b>%s</b> with id <b>%s</b> has been updated.', $_GET['model'], $_GET['id']) );
        } else {
            $msg = "<h1>Error</h1>";
            $msg .= sprintf("Couldn't update model <b>%s</b>", $_GET['model']);
            $msg .= "<ul>";
            foreach($model->errors as $attribute=>$attr_errors) {
                $msg .= "<li>Attribute: $attribute</li>";
                $msg .= "<ul>";
                foreach($attr_errors as $attr_error) {
                    $msg .= "<li>$attr_error</li>";
                }        
                $msg .= "</ul>";
            }
            $msg .= "</ul>";
            $this->_sendResponse(500, $msg );
        }
    } // }}} 
    // {{{ actionDelete
    /**
     * Deletes a single item
     * 
     * @access public
     * @return void
     */
    public function actionDelete()
    {
        $this->_checkAuth();

        switch($_GET['model'])
        {
            // Load the respective model
            case 'posts': // {{{ 
                $model = Post::model()->findByPk($_GET['id']);                    
                break; // }}} 
            default: // {{{ 
                $this->_sendResponse(501, sprintf(
                    'Error: Mode <b>delete</b> is not implemented for model <b>%s</b>',$_GET['model']) );
                exit; // }}} 
        }
        // Was a model found?
        if(is_null($model)) {
            // No, raise an error
            $this->_sendResponse(400, sprintf(
                "Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",$_GET['model'], $_GET['id']) );
        }

        // Delete the model
        $num = $model->delete();
        if($num>0)
            $this->_sendResponse(200, sprintf(
                "Model <b>%s</b> with ID <b>%s</b> has been deleted.",$_GET['model'], $_GET['id']) );
        else
            $this->_sendResponse(500, sprintf(
                "Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.",$_GET['model'], $_GET['id']) );
    } // }}} 
    // }}} End Actions
    // {{{ Other Methods
    // {{{ _sendResponse
    /**
     * Sends the API response 
     * 
     * @param int $status 
     * @param string $body 
     * @param string $content_type 
     * @access private
     * @return void
     */
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        // set the status
        header($status_header);
        // set the content type
        header('Content-type: ' . $content_type);

        // pages with body are easy
        if($body != '')
        {
            // send the body
            echo $body;
            exit;
        }
        // we need to create the body if none is passed
        else
        {
            // create some body messages
            $message = '';

            // this is purely optional, but makes the pages a little nicer to read
            // for your users.  Since you won't likely send a lot of different status codes,
            // this also shouldn't be too ponderous to maintain
            switch($status)
            {
                case 401:
                    $message = 'You must be authorized to view this page.';
                    break;
                case 404:
                    $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                    break;
                case 500:
                    $message = 'The server encountered an error processing your request.';
                    break;
                case 501:
                    $message = 'The requested method is not implemented.';
                    break;
            }

            // servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
            $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

            // this should be templatized in a real-world solution
            $body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                        <html>
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
                            </head>
                            <body>
                                <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
                                <p>' . $message . '</p>
                                <hr />
                                <address>' . $signature . '</address>
                            </body>
                        </html>';

            echo $body;
            exit;
        }
    } // }}}            
    // {{{ _getStatusCodeMessage
    /**
     * Gets the message for a status code
     * 
     * @param mixed $status 
     * @access private
     * @return string
     */
    private function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );

        return (isset($codes[$status])) ? $codes[$status] : '';
    } // }}} 
    // {{{ _checkAuth
    /**
     * Checks if a request is authorized
     * 
     * @access private
     * @return void
     */
    private function _checkAuth()
    {
        // Check if we have the USERNAME and PASSWORD HTTP headers set?
        if(!(isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME']) and isset($_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD']))) {
            // Error: Unauthorized
            $this->_sendResponse(401);
        }
        $username = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_USERNAME'];
        $password = $_SERVER['HTTP_X_'.self::APPLICATION_ID.'_PASSWORD'];
        // Find the user
        $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
        if($user===null) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Name is invalid');
        } else if(!$user->validatePassword($password)) {
            // Error: Unauthorized
            $this->_sendResponse(401, 'Error: User Password is invalid');
        }
    } // }}} 
    // {{{ _getObjectEncoded
    /**
     * Returns the json or xml encoded array
     * 
     * @param mixed $model 
     * @param mixed $array Data to be encoded
     * @access private
     * @return void
     */
    private function _getObjectEncoded($model, $array)
    {
        if(isset($_GET['format']))
            $this->format = $_GET['format'];

        if($this->format=='json')
        {
            return CJSON::encode($array);
        }
        elseif($this->format=='xml')
        {
            $result = '<?xml version="1.0">';
            $result .= "\n<$model>\n";
            foreach($array as $key=>$value)
                $result .= "    <$key>".utf8_encode($value)."</$key>\n"; 
            $result .= '</'.$model.'>';
            return $result;
        }
        else
        {
            return;
        }
    } // }}} 
    // }}} End Other Methods
	
	protected function beforeSave()
	{
		// author_id may have been posted via API POST
		if(is_null($this->author_id) or $this->author_id=='')
			$this->author_id=Yii::app()->user->id;
	}	
	
}

/* vim:set ai sw=4 sts=4 et fdm=marker fdc=4: */
?>
