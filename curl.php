<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>

<?php 

	// /curl.php?method=p&form=y&formdata1=hi&formdata2=mynameis&dest=http://meta.ua&cookie=user_data

	// http://localhost/curl.php?method=g&form=n&dest=http://google.com&cookie=5r435435frefwe


	if( !empty( $_GET['method'] ) and $_GET['method'] == 'g' )
	{

  		if ( !empty( $_GET['dest'] ) )
  		{
  			$url = $_GET['dest'];
  		}

  		if ( !empty( $_GET['cookie'] ) )
  		{
  			$cookie = $_GET['cookie'];
  		}

  		$curl = curl_init();

  		var_dump($url);

  		curl_setopt_array(
  			$curl,
  			[
  				CURLOPT_RETURNTRANSFER => 1,
  				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0',
  				CURLOPT_URL => $url,
				CURLOPT_FOLLOWLOCATION => 1,
				
				CURLOPT_SSL_VERIFYPEER => false,
  			]
  		);

  		$resp = curl_exec($curl);

  		$info = curl_getinfo($curl);

  		curl_close($curl);

  		echo $resp;


	}
	else if( !empty( $_GET['method'] ) and $_GET['method'] == 'p' )
	{

  		if ( !empty( $_GET['form'] ) and $_GET['form'] == 'y' ) 
  		{

  			foreach ($_GET as $key => $var) 
  			{
  				$v = explode( 'formdata' , $key );
  				if( !empty( $v[1] ) ) $form[$key] = [$var];
  			}

  			$form = json_encode($form);
  			// var_dump($form);

	  		if ( !empty( $_GET['dest'] ) )
	  		{
	  			$url = $_GET['dest'];
	  		}

	  		if ( !empty( $_GET['cookie'] ) )
	  		{
	  			$cookie = $_GET['cookie'];
	  		}

	  		$curl = curl_init();

		    		/* CURLOPT_POSTFIELDS => [
		    			formdata1 => @$form1,
		    			formdata2 => @$form2, ],*/

			if( !empty( $cookie ) ) curl_setopt( $curl , CURLOPT_COOKIE , $cookie );
    		if( !empty( $session ) ) curl_setopt( $curl , CURLOPT_COOKIESESSION , $session );
 
    		



	  		curl_setopt_array(
	  			$curl,
	  			[
	  				CURLOPT_RETURNTRANSFER => 1,
	  				CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0',
	  				CURLOPT_URL => $url,
					CURLOPT_FOLLOWLOCATION => 1,
					CURLOPT_POST => true,
					CURLOPT_POSTFIELDS => $form,
					CURLOPT_SSL_VERIFYPEER => false,
	  			]
	  		);

	  		// $resp = curl_exec($curl);

	  		$curl_exec = curl_exec( $curl );

	  		print_r( $curl_exec );

	  		$info = curl_getinfo($curl);
	  		// $cookies = array();
	  		var_dump($info);

	  		curl_close($curl);

	  		var_dump( $_SESSION );
	  		var_dump( $_COOKIE );

  		}else exit('empty($_GET[form])');
		
	}