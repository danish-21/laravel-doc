<?php

namespace App\Constants;


class AppConstants
{

    const EMAIL_NOT_REGISTERED = 'Email is not registered, please Sign up first.';
    const INVALID_EMAIL = 'Please Enter a valid Email';
    const INVALID_CREDENTIALS = 'Invalid Credentials';
    const USER_NOT_ACTIVE = 'User is not active';
    const OTP_EXPIRED = 'Your OTP is expired, please request for a resend OTP';
    const INVALID_OTP = 'Invalid OTP, enter correct OTP';
    const EXPIRED_OTP = 'Your OTP has expired';


    // PAYMENT OPTION

    const PAYMENT_METHOD_COD = 'CASH_ON_DELIVERY';
    const PAYMENT_METHOD_UPI = 'UPI';
    const PAYMENT_METHOD_CARD = 'CARD';

    // Rest of your code...
    const COUPON_TYPE_FIXED = 'FIXED';
    const COUPON_TYPE_PERCENTAGE = 'PERCENTAGE';

}
