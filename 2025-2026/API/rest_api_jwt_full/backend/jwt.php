
<?php
function b64($data){
 return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function create_jwt($payload){
 $header = b64(json_encode(['alg'=>'HS256','typ'=>'JWT']));
 $body   = b64(json_encode($payload));
 $sig    = b64(hash_hmac('sha256', "$header.$body", JWT_SECRET, true));
 return "$header.$body.$sig";
}

function verify_jwt($jwt){
 $parts = explode('.', $jwt);
 if(count($parts)!==3) return false;

 [$h,$b,$s] = $parts;
 $check = b64(hash_hmac('sha256', "$h.$b", JWT_SECRET, true));
 if(!hash_equals($check,$s)) return false;

 $payload = json_decode(base64_decode(strtr($b,'-_','+/')), true);
 if($payload['exp'] < time()) return false;

 return $payload;
}
