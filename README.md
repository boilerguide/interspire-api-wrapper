# This is PHP Interspire API wrapper for mailing lists management.

## Currently supports:
* Adding a new subscriber to a mailing list

## Example usage:
    $config = array(
                'url' => 'http://example.com/interspire/xml.php',
                'username' => 'user',
                'usertoken' => 'secrettoken',
                'logger' => array(
                    'type' => 'file',
                    'location' => '/var/log/interspire/error.log'
                )
            );

            $interspireConnector = new Connector($config);
            $interspireRequest = new AddSubscriberToListRequest();
            $interspireRequest->setDetails(new Details($emailAddress, $mailingListID);
            $interspireConnector->send($interspireRequest); 
### Config parameters 
`url` - Interspire API endpoint URL  
`username` - Interspire API username  
`usertoken` - Interspire API token  
`logger` - Logger object configuration  
* `logger.type` - Defines storage type for logs. Currently supported: **file**, **wordpressDatabase**. The **wordpressDatabase** should be only used with WordPress as it requires WordpressDatabase object to be present.
* `logger.location` - path to the log file (if `logger.type` is set to **file**) or wordpress database table name (when `logger.type` is **wordpressDatabase**)

### Request parameters
#### AddSubscriberToListRequest
`$emailAddress` - subscriber's email address  
`$mailingListId` - ID of the Interspire mailing list