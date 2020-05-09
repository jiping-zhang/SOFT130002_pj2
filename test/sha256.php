<?php
function SHA256Hex($str){
    $re=hash('sha256', $str,true);
    return bin2hex($re);
}
echo SHA256Hex("abcd1234");