<?php


$context = secp256k1_context_create(SECP256K1_CONTEXT_SIGN | SECP256K1_CONTEXT_VERIFY);

$privateKey = random_bytes(32);
$verified = (bool)secp256k1_ec_seckey_verify($context, $privateKey);

/** @var resource $publicKey */
$publicKey = '';
$result = secp256k1_ec_pubkey_create($context, $publicKey, $privateKey);

$msg32 = random_bytes(32);

/** @var resource $sig */
$sig = '';
$result = secp256k1_ecdsa_sign($context, $sig, $msg32, $privateKey);
$result = secp256k1_ecdsa_verify($context, $sig, $msg32, $publicKey);

if ($result) {
    echo "Yay!";
} else {
    echo "Nah!";
}