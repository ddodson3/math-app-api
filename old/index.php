<?php 

require_once 'API.class.php';
class MyAPI extends API
{
    public $error;
    protected $db;
    protected $User;

    public function __construct($request, $origin) {

        $hostName = 'localhost';
        $userName = 'iosapp';
        $password = 'BtLfjkeXO5KH9J';
        $database = 'mathQuestions';


        $db = new mysqli($hostName, $userName, $password, $database);

        if ($db->connect_error) {
            $this->error = $db->connect_error;
        }
        parent::__construct($request);


        // Abstracted out for example
        // $APIKey = new Models\APIKey();
        // $User = new Models\User();

        // if (!array_key_exists('apiKey', $this->request)) {
        //     throw new Exception('No API Key provided');
        // } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
        //     throw new Exception('Invalid API Key');
        // } else if (array_key_exists('token', $this->request) &&
        //      !$User->get('token', $this->request['token'])) {

        //     throw new Exception('Invalid User Token');
        // }

        // $this->User = $User;
    }

    /**
     * Example of an Endpoint
     */
     protected function answer() {
        switch ($this->method) {
            case 'GET':
                if (!$this->verb && !$this->args) {
                    // $answers = $db->query
                    echo $request;
                }
                break;
            
            default:
                # code...
                break;
        }
     }


 }

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    if (!$API->error) {
       echo $API->processAPI();
    }
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}