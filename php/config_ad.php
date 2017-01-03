!--
 *
 * Author: Jonathan Seibt
 * Page: http://facebook.com/jonathan.seibt
 * Version: 2015/01/16
 * Copyright © 2014 - 2015 All rights reserved
 *
-->
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$ldapconfig['host'] = "172.28.0.1";
$ldapconfig['port'] = "389"; #PORTA
$domain = "cmcxs";
$username = "ponto_ad";
$password = "souomaior!";
$grupo = 'OU=Camara,DC=cmcxs,DC=gov,DC=br';
//$filtro '(|(samaccountname='.$usuario.'))'
$filtro = "(&(objectClass=User)(cn=*)(!(userAccountControl:1.2.840.113556.1.4.803:=2)))";
$ds = ldap_connect($ldapconfig['host'], $ldapconfig['port']);
ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
$bind = ldap_bind($ds, $username . '@' . $domain, $password);
