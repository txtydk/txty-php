<?php
class Authentication
{
	private $authentication;

	public function __construct($user, $key)
	{
		$this->authentication = ['user' => $user, 'key' => $key];
	}

	/**
	 * Return user ang key informations
	 * @param array Array of user and key
	*/

	public function getAuthentication()
	{
		return $this->authentication;
	}
}

class Txty
{
	private $authentication;

	private $baseurl = 'https://login.txty.dk/api/4';
	private $useragent = 'Txty Class version 1.0';

	public function __construct(Authentication $authentication)
	{
		$this->authentication = $authentication;
	}

	/**
	 * Call remote API
	 * @param array Array of objects
	*/

	public function call($page, $query = null)
	{

		// Add user credentials
		$query = http_build_query($query ? $this->authentication->getAuthentication() + $query : $this->authentication->getAuthentication());

		// Set URL
		$url = $this->baseurl . '/' . $page . '/api.json';

		// Check if cURL is available
		if(function_exists('curl_version'))
		{

			// Start curl
			$ch = curl_init($url);

			// Set curl muligheder
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);

			// Call the API
			$result = curl_exec($ch);

			// Close the connection
			curl_close($ch);

		} else if(ini_get('allow_url_fopen')) {

			$stream = stream_context_create([
				'http' =>
				[
					'method' => 'POST',
					'header' => 'Content-type: application/x-www-form-urlencoded',
					'content' => $query
				]
			]);

			// Make connection and push informations
			$result = file_get_contents($url, false, $stream);

		} else {

			return 'Cannot continue because no PHP modules are available.';

		}

		// Decode result
		$result = json_decode($result, true);

		// Return result
		return $result;

	} // Close call function
}

class TxtyUser extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function viewUser($query = null)
	{
		return self::call('view/user', $query);
	}
}

class TxtySMS extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function sendSMS($query = null)
	{
		return self::call('sms', $query);
	}

	public function viewOutbox($query = null)
	{
		return self::call('view/outbox', $query);
	}

	public function viewInbox($query = null)
	{
		return self::call('view/inbox', $query);
	}

	public function viewCallbacks($query = null)
	{
		return self::call('view/callbacks', $query);
	}
}

class TxtyHLR extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function sendHLR($query = null)
	{
		return self::call('hlr', $query);
	}
}

class TxtyContacts extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function viewContacts($query = null)
	{
		return self::call('view/contacts', $query);
	}

	public function viewContact($query = null)
	{
		return self::call('view/contact', $query);
	}

	public function createContact($query = null)
	{
		return self::call('contact/create', $query);
	}

	public function editContact($query = null)
	{
		return self::call('contact/edit', $query);
	}

	public function deleteContact($query = null)
	{
		return self::call('contact/delete', $query);
	}

	public function addGroup($query = null)
	{
		return self::call('contact/addgroup', $query);
	}

	public function removeGroup($query = null)
	{
		return self::call('contact/removegroup', $query);
	}
}

class TxtyGroups extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function viewGroups($query = null)
	{
		return self::call('view/groups', $query);
	}

	public function viewGroup($query = null)
	{
		return self::call('view/group', $query);
	}

	public function createGroup($query = null)
	{
		return self::call('group/create', $query);
	}

	public function editGroup($query = null)
	{
		return self::call('group/edit', $query);
	}

	public function deleteGroup($query = null)
	{
		return self::call('group/delete', $query);
	}
}

class TxtyKeywords extends Txty
{
	public function __construct($authentication)
	{
		parent::__construct($authentication);
	}

	public function viewKeywords($query = null)
	{
		return self::call('view/keywords', $query);
	}

	public function viewKeyword($query = null)
	{
		return self::call('view/keyword', $query);
	}
}