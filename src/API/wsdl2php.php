<?php
// +------------------------------------------------------------------------+
// | wsdl2php                                                               |
// +------------------------------------------------------------------------+
// | Copyright (C) 2005 Knut Urdalen <knut.urdalen@telio.no>                |
// +------------------------------------------------------------------------+
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS    |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT      |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR  |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT   |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,  |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT       | 
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,  |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY  |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT    |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE  |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.   |
// +------------------------------------------------------------------------+
// | This software is licensed under the LGPL license. For more information |
// | see http://www.urdalen.no/wsdl2php                                     |
// +------------------------------------------------------------------------+

ini_set('soap.wsdl_cache_enabled', 0); // disable WSDL cache

if( $_SERVER['argc'] != 2 ) {
  die("usage: wsdl2php <wsdl-file>\n");
}

$wsdl = $_SERVER['argv'][1];

try {
  $client = new SoapClient($wsdl);
} catch(SoapFault $e) {
  die($e);
}

$dom = DOMDocument::load($wsdl);

// get documentation
$nodes = $dom->getElementsByTagName('documentation');
$doc = array('service' => '',
	     'operations' => array());
foreach($nodes as $node) {
  if( $node->parentNode->localName == 'service' ) {
    $doc['service'] = trim($node->parentNode->nodeValue);
  } else if( $node->parentNode->localName == 'operation' ) {
    $operation = $node->parentNode->getAttribute('name');
    //$parameterOrder = $node->parentNode->getAttribute('parameterOrder');
    $doc['operations'][$operation] = trim($node->nodeValue);
  }
}

// get targetNamespace
$targetNamespace = '';
$nodes = $dom->getElementsByTagName('definitions');
foreach($nodes as $node) {
  $targetNamespace = $node->getAttribute('targetNamespace');
}

// declare service
$service = array('class' => $dom->getElementsByTagNameNS('*', 'service')->item(0)->getAttribute('name'),
		 'wsdl' => $wsdl,
		 'doc' => $doc['service'],
		 'functions' => array());

// PHP keywords - can not be used as constants, class names or function names!
$keywords = array('and', 'or', 'xor', 'as', 'break', 'case', 'cfunction', 'class', 'continue', 'declare', 'const', 'default', 'do', 'else', 'elseif', 'enddeclare', 'endfor', 'endforeach', 'endif', 'endswitch', 'endwhile', 'eval', 'extends', 'for', 'foreach', 'function', 'global', 'if', 'new', 'old_function', 'static', 'switch', 'use', 'var', 'while', 'array', 'die', 'echo', 'empty', 'exit', 'include', 'include_once', 'isset', 'list', 'print', 'require', 'require_once', 'return', 'unset', '__file__', '__line__', '__function__', '__class__', 'abstract');

// ensure legal class name (I don't think using . and whitespaces is allowed in terms of the SOAP standard, should check this out and may throw and exception instead...)
$service['class'] = str_replace(' ', '_', $service['class']);
$service['class'] = str_replace('.', '_', $service['class']);
$service['class'] = str_replace('-', '_', $service['class']);

if(in_array(strtolower($service['class']), $keywords)) {
  $service['class'] .= 'Service';
}

// verify that the name of the service is named as a defined class
if(class_exists($service['class'])) {
  throw new Exception("Class '".$service['class']."' already exists");
}

/*if(function_exists($service['class'])) {
  throw new Exception("Class '".$service['class']."' can't be used, a function with that name already exists");
}*/

// get operations
$operations = $client->__getFunctions();
foreach($operations as $operation) {

  /*
   This is broken, need to handle
   GetAllByBGName_Response_t GetAllByBGName(string $Name)
   list(int $pcode, string $city, string $area, string $adm_center) GetByBGName(string $Name)

   finding the last '(' should be ok
   */
  //list($call, $params) = explode('(', $operation); // broken
  
  //if($call == 'list') { // a list is returned
  //}
  
  /*$call = array();
  preg_match('/^(list\(.*\)) (.*)\((.*)\)$/', $operation, $call);
  if(sizeof($call) == 3) { // found list()
    
  } else {
    preg_match('/^(.*) (.*)\((.*)\)$/', $operation, $call);
    if(sizeof($call) == 3) {
      
    }
  }*/

  $matches = array();
  if(preg_match('/^(\w[\w\d_]*) (\w[\w\d_]*)\(([\w\$\d,_ ]*)\)$/', $operation, $matches)) {
    $returns = $matches[1];
    $call = $matches[2];
    $params = $matches[3];
  } else if(preg_match('/^(list\([\w\$\d,_ ]*\)) (\w[\w\d_]*)\(([\w\$\d,_ ]*)\)$/', $operation, $matches)) {
    $returns = $matches[1];
    $call = $matches[2];
    $params = $matches[3];
  } else { // invalid function call
    throw new Exception('Invalid function call: '.$function);
  }

  $params = explode(', ', $params);

  $paramsArr = array();
  foreach($params as $param) {
    $paramsArr[] = explode(' ', $param);
  }
  //  $call = explode(' ', $call);
  $function = array('name' => $call,
		    'method' => $call,
		    'return' => $returns,
		    'doc' => $doc['operations'][$call],
		    'params' => $paramsArr);

  // ensure legal function name
  if(in_array(strtolower($function['method']), $keywords)) {
    $function['name'] = '_'.$function['method'];
  }

  // ensure that the method we are adding has not the same name as the constructor
  if(strtolower($service['class']) == strtolower($function['method'])) {
    $function['name'] = '_'.$function['method'];
  }

  // ensure that there's no method that already exists with this name
  // this is most likely a Soap vs HttpGet vs HttpPost problem in WSDL
  // I assume for now that Soap is the one listed first and just skip the rest
  // this should be improved by actually verifying that it's a Soap operation that's in the WSDL file
  // QUICK FIX: just skip function if it already exists
  $add = true;
  foreach($service['functions'] as $func) {
    if($func['name'] == $function['name']) {
      $add = false;
    }
  }
  if($add) {
    $service['functions'][] = $function;
  }
}

$types = $client->__getTypes();

$primitive_types = array('string', 'int', 'long', 'float', 'boolean', 'dateTime', 'double', 'short', 'UNKNOWN', 'base64Binary'); // TODO: dateTime is special, maybe use PEAR::Date or similar
$service['types'] = array();
foreach($types as $type) {
  $parts = explode("\n", $type);
  $class = explode(" ", $parts[0]);
  $class = $class[1];
  
  if( substr($class, -2, 2) == '[]' ) { // array skipping
    continue;
  }

  if( substr($class, 0, 7) == 'ArrayOf' ) { // skip 'ArrayOf*' types (from MS.NET, Axis etc.)
    continue;
  }


  $members = array();
  for($i=1; $i<count($parts)-1; $i++) {
    $parts[$i] = trim($parts[$i]);
    list($type, $member) = explode(" ", substr($parts[$i], 0, strlen($parts[$i])-1) );

    // check syntax
    if(preg_match('/^$\w[\w\d_]*$/', $member)) {
      throw new Exception('illegal syntax for member variable: '.$member);
      continue;
    }

    // IMPORTANT: Need to filter out namespace on member if presented
    if(strpos($member, ':')) { // keep the last part
      list($tmp, $member) = explode(':', $member);
    }

    // OBS: Skip member if already presented (this shouldn't happen, but I've actually seen it in a WSDL-file)
    // "It's better to be safe than sorry" (ref Morten Harket) 
    $add = true;
    foreach($members as $mem) {
      if($mem['member'] == $member) {
	$add = false;
      }
    }
    if($add) {
      $members[] = array('member' => $member, 'type' => $type);
    }
  }

  $service['types'][] = array('class' => $class, 'members' => $members);
}


// add types
foreach($service['types'] as $type) {
  $code = "/**\n";
  $code .= " * ".$type['doc']."\n";
  $code .= " * @author    Emmanuel NINET\n";
  $code .= " * @copyright 2014 inWebo Technologies\n";
  $code .= " * @package   PHP API Samples\n";
  $code .= " */\n";
  $code .= "namespace API;\n\n";
  $code .= "class ".$type['class']." {\n";
  foreach($type['members'] as $member) {
    $code .= "  /* ".$member['type']." */\n";
    $code .= "  public \$".$member['member'].";\n";
  }
  $code .= "}\n\n";

  print "Writing ".$type['class'].".php...";
  $filename = $type['class'].".php";
  $fp = fopen($filename, 'w');
  fwrite($fp, "<?php\n".$code);
  fclose($fp);
  print "ok\n";
}

// add service

// page level docblock
$code = "/**\n";
$code .= " * ".$service['class']." class file\n";
$code .= " * \n";
$code .= " * @author    Emmanuel NINET\n";
$code .= " * @copyright 2014 inWebo Technologies\n";
$code .= " * @package   PHP API Samples\n";
$code .= " */\n\n";
$code .= "namespace API;\n\n";

// require types
foreach($service['types'] as $type) {
  $code .= "/**\n";
  $code .= " * ".$type['class']." class\n";
  $code .= " */\n";
  $code .= "require_once 'API/".$type['class'].".php';\n";
}

$code .= "\n";

// class level docblock

$code .= "class ".$service['class']." extends \SoapClient {\n\n";
//$code .= "  private \$client;\n\n";
//$code .= "  private \$wsdl = \"".$service['wsdl']."\";\n\n";
$code .= "  public function ".$service['class']."(\$wsdl = \"".$service['wsdl']."\", \$options = array()) {\n";
//$code .= "    if(\$wsdl != null) {\n";
//$code .= "      \$this->wsdl = \"\$wsdl\";\n";
//$code .= "    };\n";
//$code .= "    \$this->client = new SoapClient(\$this->wsdl, array('trace' => 0, 'exceptions' => 1));\n";
$code .= "    parent::__construct(\$wsdl, \$options);\n";
$code .= "  }\n\n";

foreach($service['functions'] as $function) {
  $code .= "  /**\n";
  $code .= parse_doc("   * ", $function['doc']);
  $code .= "   *\n";

  $signature = array(); // used for function signature
  $para = array(); // just variable names
  foreach($function['params'] as $param) {
    $code .= "   * @param ".$param[0]." ".$param[1]."\n";
    /*$typehint = false;
    foreach($service['types'] as $type) {
      if($type['class'] == $param[0]) {
	$typehint = true;
      }
    }
    $signature[] = ($typehint) ? implode(' ', $param) : $param[1];*/
    $signature[] = (in_array($param[0], $primitive_types)) ? $param[1] : implode(' ', $param);
    $para[] = $param[1];
  }
  $code .= "   * @return ".$function['return']."\n";
  $code .= "   */\n";
  $code .= "  public function ".$function['name']."(".implode(', ', $signature).") {\n";
  //  $code .= "    return \$this->client->".$function['name']."(".implode(', ', $para).");\n";
  $code .= "    return \$this->__call('".$function['method']."', array(";
  $params = array();
  if(!in_array('', $signature)) { // no arguments!
    foreach($signature as $param) {
      if(strpos($param, ' ')) { // slice 
	$param = array_pop(explode(' ', $param));
      }
      $params[] = "      new \SoapParam(".$param.", '".substr($param, 1, strlen($param))."')";
    }
    $code .= "\n      ";
    $code .= implode(",\n      ", $params);
    $code .= "\n      ),\n";
  } else {
    $code .= "),\n";
  }
  $code .= "      array(\n";
  $code .= "            'uri' => '".$targetNamespace."',\n";
  $code .= "            'soapaction' => ''\n";
  $code .= "           )\n";
  $code .= "      );\n";
  $code .= "  }\n\n";
}
$code .= "}\n\n";

print "Writing ".$service['class'].".php...";
$fp = fopen($service['class'].".php", 'w');
fwrite($fp, "<?php\n".$code);
fclose($fp);
print "ok\n";

function parse_doc($prefix, $doc) {
  $code = "";
  $words = split(' ', $doc);
  $line = $prefix;
  foreach($words as $word) {
    $line .= $word.' ';
    if( strlen($line) > 90 ) { // new line
      $code .= $line."\n";
      $line = $prefix;
    }
  }
  $code .= $line."\n";
  return $code;
}

?>