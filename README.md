#Encryption & Decryption Using Open SSL 

# First Create Public Key And Private Key

openssl genrsa -aes256 -passout pass:YourPassphrase -out private_key.pem 4096

openssl rsa -in private_key.pem -pubout -out public_key.pem

#Create Config

define('PUBLIC_ITEM_KEY', DATA_REALDIR.'public_access_key.pem');
define('PRIVATE_ITEM_KEY', DATA_REALDIR.'private_access_key.pem');
define('DECRYPT_PASSPHRASE_ITEM_KEY', 'YourPassphrase');

#Call Static Function
$encryptData = "hello world";
$ret = EncrypAndDecrypt::encryptData($encryptData);

$decryptData = "hello world";
$ret = EncrypAndDecrypt::decryptData($decryptData);
