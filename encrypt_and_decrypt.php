<?php

class EncrypAndDecrypt(){

      //Encrypt Item Data For Testing
    public static function encryptData($data){
        try {

            //Encryption Test For Public Item Token
            $publicKey = file_get_contents(PUBLIC_ITEM_KEY);
    
            // Get the public key resource
            $publicKeyResource = openssl_pkey_get_public($publicKey);
    
            // Encrypt the data
            openssl_public_encrypt($data, $encryptedData, $publicKeyResource);

            //For Base64 Data
            //$encodedData = base64_encode($encryptedData);
            //echo "<pre>";print_r($encodedData); echo "</pre>";exit()

            return $encryptedData;
        } catch (Exception $e) {

            throw new Exception("TOKEN_ENCRYPTION_FAIL_FOR_ITEM_TEST");
        }
    }

   public static function decryptData($encodedData){
        try {
            //Decryption Test For Private Item Token
            $privateKey = file_get_contents(PRIVATE_ITEM_KEY);
 
            // Check for errors
            if (!$privateKey) {
                return false;
            }

            // Get the private key resource
            $privateKeyResource = openssl_pkey_get_private($privateKey, DECRYPT_PASSPHRASE_ITEM_KEY);

            // Decode the encrypted data
            $decodedData = base64_decode($encodedData);

            // Decrypt the data
            openssl_private_decrypt($decodedData, $decryptedData, $privateKeyResource);

            // For Base64 Data
            // $decodedToken = base64_decode($decryptedData);
            //echo "<pre>";print_r($decodedToken); echo "</pre>";exit()

            return $decryptedData;

        }catch (Exception $e) {
            GC_Utils_Ex::gfPrintLog("USER_ENCRYPT_DECRYPT_CATCH_ERR => ". $e->getMessage(), GET_TOKEN_LOG);
            return false;
        }
    }
}
