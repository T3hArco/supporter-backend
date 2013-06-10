<?php

/*
 * Copyright 2013 Arnaud Coel. All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 * 
 *    1. Redistributions of source code must retain the above copyright notice, this list of
 *       conditions and the following disclaimer.
 * 
 *    2. Redistributions in binary form must reproduce the above copyright notice, this list
 *       of conditions and the following disclaimer in the documentation and/or other materials
 *       provided with the distribution.
 * 
 * THIS SOFTWARE IS PROVIDED BY ARNAUD COEL ''AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND
 * FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL ARNAUD COEL OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * 
 * The views and conclusions contained in the software and documentation are those of the
 * authors and should not be interpreted as representing official policies, either expressed
 * or implied, of ARNAUD COEL.
 */

include "db.php";

switch($_GET['act'])
{
  case 'authenticate':
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string(md5($_POST['password'])); // You don't NEED to escape when you're making MD5s, but hey. ;)

    $query = mysql_query("SELECT * FROM users where (username = '$username' AND password = '$password')");
    $row = mysql_fetch_row($query);

    if(mysql_num_rows($query) == 1)
    {
      echo "200-" . $row[4]; 
    }
    else
    {
      echo "403 - Wrong username/password!";
    }

    break;

  case 'getauthkey':
    $authkey = mysql_real_escape_string($_GET['authkey']);
    $query = mysql_query("SELECT count(*) FROM users WHERE authkey = '$authkey';");
    $row = mysql_fetch_row($query);

    echo "Your authkey is: " . $_GET['authkey'];

    if($row[0] == 1)
    {
      echo ", it's valid";
    }
    else
    {
      echo ", it's invalid.";
    }

    break;

  case 'postsupport':
    
    break;

  case 'getitemlist':
    // TODO
    break;

}

mysql_close();

?>