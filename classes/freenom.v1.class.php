<?php
namespace Freenom;

require_once(__DIR__ . '/freenom.class.php');

//
// Reviewed after: https://web.archive.org/web/20140202161459/http://www.freenom.com/en/freenom-api.html
// Note: domain search works with user, instead of email, as in specs
//

class V1 extends Main
{
    protected $blueprint;

    public function __construct($email, $password, $test_mode=0)
    {
        parent::__construct('https://api.freenom.com/v1/', $email, $password);

        // The blueprint for the api
        $this->blueprint = array(
            /**
            * Ping the service
            */
            'ping' => array(
                'url' => 'service/ping',
                'method' => 'get',
                'params' => array(),
                'required' => array()
            ),

            // Domains

            /**
            * Search for available domains
            */
            'domain_search' => array(
                'url' => 'domain/search',
                'method' => 'get',
                'params' => array(
                    'domainname' => '',

                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password'
                )
            ),

            /**
            * Register a domain
            */
            'domain_register' => array(
                'url' => 'domain/register',
                'method' => 'post',
                'params' => array(
                    'domainname' => '', //	The name of the domain	Yes	No
                    'period' => '', //	The period of registration. Defaults to 1Y if not given	No	No
                    'forward_url' => '', //	The URL the domain name should forward to	No*	No
                    'nameserver' => '', //	Nameserver to use. A minimum of 2 nameservers is required	No*	Yes
                    'owner_id' => '', //	Contact ID of domain owner	Yes	No
                    'billing_id' => '', //	Contact ID of billing contact	No	No
                    'tech_id' => '', //	Contact ID of technical contact	No	No
                    'admin_id' => '', //	Contact ID of admin contact	No	No
                    'user' => '', //	E-mail address used for authentication	Yes	No
                    'password' => '', //	Password used for authentication	Yes	No
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'owner_id',
                    'user',
                    'password'
                )
            ),

            /**
            * Renew a domain name registration
            */
            'domain_renew' => array(
                'url' => 'domain/renew',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'period' => '1Y',

                    'user' => '',
                    'password' => '',

                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password',

                    'period'
                )
            ),

            /**
            * Get info on the registered domain names
            */
            'domain_getinfo' => array(
                'url' => 'domain/getinfo',
                'method' => 'get',
                'params' => array(
                    'domainname' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password'
                )
            ),

            /**
            * Modify a domain
            */
            'dommain_modify' => array(
                'url' => 'domain/modify',
                'method' => 'post',
                'params' => array(
                    'domainname' => '', //	The name of the domain	Yes	No
                    'forward_url' => '', //	The URL the domain name should forward to	No*	No
                    'nameserver' => '', //	Nameserver to use. Minimally 2 are needed	No*	Yes
                    'owner_id' => '', //	Contact ID of domain owner	No	No
                    'admin_id' => '', //	Contact ID of administrative contact	No	No
                    'tech_id' => '', //	Contact ID of technical contact	No	No
                    'billing_id' => '', //	Contact ID of billing contact	No	No
                    'user' => '', //	E-mail address used for authentication	Yes	No
                    'password' => '', //	Password used for authentication	Yes	No
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password'
                )
            ),

            /**
            * Register or modify a nameserver glue record
            */
            'nameserver_register' => array(
                'url' => 'nameserver/register',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'hostname' => '',
                    'ipaddress' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'hostname',
                    'ipaddress',
                    'user',
                    'password'
                )
            ),

            /**
            * Deleting a nameserver glue record
            */
            'nameserver_delete' => array(
                'url' => 'nameserver/delete',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'hostname' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'hostname',
                    'user',
                    'password'
                )
            ),

            /**
            * Listing nameserver glue records under a domain
            */
            'nameserver_list' => array(
                'url' => 'nameserver/list',
                'method' => 'get',
                'params' => array(
                    'domainname' => '',

                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password'
                )
            ),

            // Contacts

            /**
            * Create or modify contact
            */
            'contact_register' => array(
                'url' => 'contact/register',
                'method' => 'post',
                'params' => array(
                    'contact_organization' => '', //	Organization name of contact	No	No
                    'contact_title' => '', //	Title of the contact	Yes	No
                    'contact_firstname' => '', //	First name of contact	Yes	No
                    'contact_middlename' => '', //	Middle name of contact	No	No
                    'contact_lastname' => '', //	Last name of contact	Yes	No
                    'contact_address' => '', //	Address of the contact	Yes	No
                    'contact_city' => '', //	City of the contact	Yes	No
                    'contact_zipcode' => '', //	Zipcode of the contact	Yes	No
                    'contact_statecode' => '', //	ISO-3166 code for state	Yes	No
                    'contact_countrycode' => '', //	ISO-3166 code for country	Yes	No
                    'contact_phone' => '', //	Phone number of contact (international format)	Yes	No
                    'contact_fax' => '', //	Fax number of contact (international format)	No	No
                    'contact_email' => '', //	Email address of contact	Yes	No
                    'contact_id' => '', //	ID of existing contact	No	No
                    'user' => '', //	E-mail address used for authentication	Yes	No
                    'password' => '', //	Password used for authentication	Yes	No
                    'test_mode' => '', // => $test_mode
                ),
                'required' => array(
                    'contact_title',
                    'contact_firstname',
                    'contact_lastname',
                    'contact_address',
                    'contact_city',
                    'contact_zipcode',
                    'contact_statecode',
                    'contact_phone',
                    'contact_email',
                    'user',
                    'password'
                )
            ),

            /**
            * Delete contact
            */
            'contact_delete' => array(
                'url' => 'contact/delete',
                'method' => 'post',
                'params' => array(
                    'contact_id' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'contact_id',
                    'user',
                    'password'
                )
            ),

            /**
            * Get info on specific contacts
            */
            'contact_getinfo' => array(
                'url' => 'contact/getinfo',
                'method' => 'get',
                'params' => array(
                    'contact_id' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'contact_id',
                    'user',
                    'password'
                )
            ),

            /**
            * List contacts under account
            */
            'contact_list' => array(
                'url' => 'contact/list',
                'method' => 'get',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'user',
                    'password'
                )
            ),

            // Transfers

            /**
            * Get price of a domain transfer
            */
            'domain_transfer_price' => array(
                'url' => 'domain/transfer/price',
                'method' => 'get',
                'params' => array(
                    'domainname' => '',
                    'authcode' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'authcode',
                    'user',
                    'password'
                )
            ),

            /**
            * Request a domain transfer
            */
            'domain_transfer_request' => array(
                'url' => 'domain/transfer/request',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'authcode' => '',
                    'period' => '',
                    'owner_id' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'authcode',
                    'period',
                    'owner_id',
                    'user',
                    'password'
                )
            ),

            /**
            * Approve a domain transfer
            */
            'domain_transfer_approve' => array(
                'url' => 'domain/transfer/approve',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'user',
                    'password'
                )
            ),

            /**
            * Decline a domain transfer
            */
            'domain_transfer_decline' => array(
                'url' => 'domain/transfer/decline',
                'method' => 'post',
                'params' => array(
                    'domainname' => '',
                    'reason' => '',
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'domainname',
                    'reason',
                    'user',
                    'password'
                )
            ),

            /**
            * List current domain transfers
            */
            'domain_transfer_list' => array(
                'url' => 'domain/transfer/list',
                'method' => 'post',
                'params' => array(
                    'user' => '',
                    'password' => '',
                    'test_mode' => $test_mode
                ),
                'required' => array(
                    'user',
                    'password'
                )
            )
        );
    }
}
