# Laravel API Response
### For Restful API's

Laravel does a great job formatting our responses into JSON and kicking them out appropriatly with application/json content types, but it does not help with any type of standard output format such as having a "status", or "messages" in the response. This class allows us to standardize all of our restful responses making our frontend friends much happier. Also helps with unit testing by having a true/false for each response.

Feature List:

 * Standardized responses for all requests.
 * Ability to log debug messages to response for easier debugging


##### Install
````
$ composer require xbld/laravel-api-response
````

##### Setup
Open config\app.php and add this to the providers array:
````
XBLD\ApiResponse\ApiResponseServiceProvider::class,
````
Dont forget to dump the autoload
````
$ composer dump-autoload
````

##### Usage

This is intended to be used inside your controllers on a per method basis. Add the following to the top of your controller:
````
use XBLD\ApiResponse\APIResponse;
````

Example Method
````php
public function store(Request $request)
{
	$return = new APIResponse();
    
    // If something fails on execution, Maybe a query does not
    // return anything...
    $return->status = false;
    $return->addMessage("Model Not Found");
    
    
    // Add the payload. Can be any array and will return JSON
    $return->payload = [
    	'foo'	=> 'bar',
        'bar'	=> true
    ];
    
    // Return the response.
    return $return->response();
}
````

Example Output:
````javascript
{
	"status": false,
    "messages": [
    	"Model Not Found"
    ],
    "data": {
    	[
        	"foo": "bar",
            "bar": true
        ]
    },
    "completed_at": "2016-06-06 12:06:33"
}
````
