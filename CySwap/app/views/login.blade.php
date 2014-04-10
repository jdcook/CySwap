<html>
<?php
//LDAP check goes here	
require_once(dirname(__FILE__) . "./../../resources/library/adLDAP/adLDAP.php");
try {
	//echo "Instatiating...";
    $adldap = new adLDAP();
	//var_dump($adldap);
	//$adldap->setUseTLS(true);
	$adldap->setAccountSuffix("@iastate.edu");
	$adldap->setDomainControllers(array("windc1.iastate.edu","windc2.iastate.edu","windc3.iastate.edu","windc4.iastate.edu","windc5.iastate.edu"));
	//$adldap->baseDn='dc=iastate,dc=edu';
	//echo $adldap->getAccountSuffix();
	//echo $adldap->getUseSSL();
	//var_dump($adldap->getDomainControllers());
	//echo "Instatiated... Now connecting...";
	$adldap->connect();
	$adldap->setUseTLS(true);
	//var_dump($adldap->getldapConnection());
	//echo $adldap->getldapConnection();
}
catch (adLDAPException $e) {
    echo $e;
    exit();  
}
$z=$adldap->authenticate($myusername, $mypassword);
	//LDAP ends
	if($z)
	{
		// Authentication successful
	}
	else
	{
		// Error- Invalid ISU NET-ID/Password.
	}


?>

</html>