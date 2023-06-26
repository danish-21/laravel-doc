<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <!-- CSS Reset : BEGIN -->
    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        /* table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        } */

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app  */
        /* CreateDemandRequest one of these media queries for each additional viewport size you'd like to fix */

        /* @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        } */

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary{
            background: #0d0cb5;
        }
        .bg_white{
            background: #ffffff;
        }
        .bg_light{
            background: #fafafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding-top: 1em;
        }

        /*BUTTON*/
        .btn{
            padding: 5px 15px;
            display: inline-block;
        }
        .btn.btn-primary{
            border-radius: 5px;
            background: #0d0cb5;
            color: #ffffff;
        }
        .btn.btn-white{
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }
        .btn.btn-white-outline{
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: 'arial', sans-serif;
            color: #000000;
            margin-top: 0;
        }

        body{
            font-family: 'arial', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }

        a{
            color: #0d0cb5;
        }
        .main-table>table{
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        .main-table>table th{
            background-color: #9FCA3F;
            color: white;
            font-size: 14px;
            letter-spacing: 1.16px;
        }
        .main-table>td, th {
            padding: 8px;
        }
        .main-table>table td{
            text-align: center;
            color: #808080;
        }
        .main-table>table tr:nth-child(even) {
            background-color: #F7F7F7;
        }

        .manage-btn{
            height: 48px;
            width:220px;
            background-color: #9FCA3F;
            border-radius:10px ;
            color: white;
            border: none;
            font-size: 16px;
            font-family: 'arial', sans-serif;
        }
        .add{
            text-align: left;
            letter-spacing: 1.45px;
            color: #090909;
        }
        .card{
            padding: 0.5rem;
            font-size: 12px;
            color: black;
            display: flex;
            align-items: center;
        }
        .card-img{
            height:40px;
            width: 40px;
        }

    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important;">
<center style="background-color: #f1f1f1;">
    <div style="max-width: 800px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top">
                    <table  role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td  width="50%" class="logo" style="text-align: left; padding: 1em 1.5em;">
                                <img src="{{(env('APP_URL').'/images/NCLogo.png')}}" alt="logo" style="max-width: 100px; flex-grow: 1;">
                            </td>
                            <td  width="50%" class="logo" style="text-align: right; padding: 1em 1.5em;">
                                <img src="{{(env('APP_URL').'/images/myglobalagro.png')}}" alt="logo" style="max-width: 100px; flex-grow: 1;">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->

            <tr>
                <td valign="top" bgcolor="#9FCA3F" style="background-color: #9FCA3F;">
                    <table bgcolor="#9FCA3F" role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #9FCA3F;">
                        <tr>
                            <td bgcolor="#9FCA3F" width="100%" class="logo" style="text-align: center; color:white; letter-spacing: 1.82px; padding: 1em 1.5em;font-size: 26px;font-weight: 600">
                                OTP verification for Signup
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->

            <tr>
                <td class="bg_white ">
                    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td class="bg_white email-section" style="width: 100%">
                                <div class="heading-section" style=" color:#0C0101; padding: 1.5em;">
                                    <p>Hello <b>{{$user->name}}</b>,</p>

                                    <p> Thank you for signing up on NeerCare Agro!</p>

                                    <p>In Order to verify your email and complete your account setup, we need to confirm your email address by entering a One-Time Password(OTP)</p>

                                    <p>Here is your Verification <b> OTP: {{$otp->otp}}</b></p>

                                    <p>If you did not initiate this request, please ignore this email and your account will not be created.</p>

                                    <p>Thank You for Choosing NeerCare Agro!</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="bg_white email-section" style="padding: 1.5em;">
                    <table width="100%" style="width: 100%;">
                        <tr>
                            <td colspan="2">
                                <hr>
                                <p style="text-align: center;">In Case of any assistance, please feel free to <a href="mailto:it@neercareagro.com" style="color: #034EA2;"> contact us!</a></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p>Regards,<br>NeerCare Agro Team</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <a href="https://www.facebook.com/neercareagro/"> <img src="{{(env('APP_URL').'/images/facebook.png')}}"   alt="logo" style="margin-bottom: 6px;" ></a>
                                <a href="https://instagram.com/neercareagro/"> <img src="{{(env('APP_URL').'/images/instagram.png')}}"   alt="logo" ></a>
                                <a href="https://www.linkedin.com/company/neearcareagro/"><img src="{{env('APP_URL').('/images/linkedin.png')}}"   alt="logo" ></a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end: tr -->
        </table>
    </div>
</center>
</body>
</html>
