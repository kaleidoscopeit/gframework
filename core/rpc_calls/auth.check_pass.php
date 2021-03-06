<?php
/*
  * Check the credentials provided by the user to the authentication engine
 */

$rpc = array (array (

'user' => array (
  'type'     => 'string',
  'required' => true,
  'origin'   => array (
    'variable:$_STDIN["user"]',
)),

'pass' => array (
  'type'     => 'string',
  'required' => true,
  'origin'   => array (
    'variable:$_STDIN["pass"]',
)),

'domain' => array (
  'type'     => 'string',
  'required' => false,
  'origin'   => array (
    'variable:$_STDIN["domain"]',
)),

'auth_engine' => array (
  'type'     => 'string',
  'required' => true,
  'origin'   => array (
    'variable:$_STDIN["auth_engine"]',
    'variable:$_->settings["auth_engine"]',
))

),

/* rpc function */

function(&$_, $_STDIN, &$_STDOUT) use (&$self)
{
  $user   = $_STDIN['user'];
  $pass   = $_STDIN['pass'];
  $domain = (isset($_STDIN['domain']) ? $_STDIN['domain'] : null);

  /* check authentication  credentials */
  if(!_call("auth.engine."
              . $_STDIN["auth_engine"]
              . ".ckuser", $_STDIN)) {

    $_STDOUT = $_STDIN;
    $_STDOUT['STDERR']['call'][] = $self['name'];

    return FALSE;
  }

  return TRUE;
});

?>
