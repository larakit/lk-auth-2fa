<?php
/**
 * Created by Larakit.
 * Link: http://github.com/larakit
 * User: Alexey Berdnikov
 * Date: 19.05.17
 * Time: 7:47
 */

Route::get('!/ajax/2fa/off', function () {
    $user = \Auth::getUser();
    if($user) {
        //encrypt and then save secret
        $user->google2fa_secret = null;
        $user->save();
        
        return [
            'result'  => 'success',
            'message' => 'Режим двухфакторной авторизации отключен!',
        ];
    } else {
        return [
            'result'  => 'error',
            'message' => 'Вы не авторизованы!',
        ];
    }
});

Route::get('!/ajax/2fa/on', function () {
    $fa2         = new  \PragmaRX\Google2FA\Google2FA;
    $randomBytes = random_bytes(10);
    $secret      = \ParagonIE\ConstantTime\Base32::encodeUpper($randomBytes);
    $user        = \Auth::getUser();
    if($user) {
        //encrypt and then save secret
        $user->google2fa_secret = Crypt::encrypt($secret);
        $user->save();
        
        //generate image for QR barcode
        $imageDataUri = $fa2->getQRCodeInline(
            Request::getHttpHost(),
            $user->email,
            $secret,
            200
        );
        echo('<img src="' . $imageDataUri . '" />');
        
        return [
            'result'  => 'success',
            'message' => 'Режим двухфакторной авторизации активирован!',
            'image'   => $imageDataUri,
            'secret'  => $secret,
        ];
    } else {
        return [
            'result'  => 'error',
            'message' => 'Вы не авторизованы!',
        ];
    }
});