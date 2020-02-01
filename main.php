<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// Load Composer's autoloader
require 'autoload.php';
session_start();
/**
 *
 */
function sendmail()
{
    $address = strip_tags($_POST['D_email']);
    $fromadress = strip_tags($_POST['fromemail']);
    $message = strip_tags($_POST['Text']);
    $subject = strip_tags($_POST['subject']);
    $num = strip_tags($_POST['nrofmsgs']);
    for ($x = 0; $x < $num; $x++) {
        //settings
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = 'true';
            $mail->Port = 465;
            $mail->Username = 'literly any of your emails';
            $mail->Password = 'the password to that email'; //dw about any leaks they shouldnt happen
            $mail->SMTPSecure = 'ssl';

            //recipient stuff
            $mail->setFrom($fromadress);
            $mail->addAddress($address);
            //message content
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $message;
            //send email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

if (isset($_POST['D_email']) && isset($_POST['fromemail']) && isset($_POST['Text']) && isset($_POST['nrofmsgs'])) {
    if ($_POST['D_email'] != '' && $_POST['fromemail'] != '' && $_POST['Text'] != '' && $_POST['subject'] != '') {
        sendmail();
    }
}
?>
<html>
<head>
    <title>Mail Hawk</title>
</head>
<body bgcolor="#2a2a2a">
<marquee class="marq"></marquee>
<h1 style="font-family:consolas;text-align:center;color:white;">Please fill out the form.</h1>
<style>
    .marq {
        font-family: consolas;
        color: red;
    }

    #mainForm {
        font-family: consolas;
        color: white;
        text-align: center;
        line-height: 25px;
        transform: translate(-4%);
    }

    label {
        color: white;
        display: inline-block;
        width: 200px;
        margin-right: 30px;
        text-align: right;
    }

    errorlabel {
        center;
        text-align: center;
        color: white;
        display: inline-block;
        width: 200px;
        margin-right: 30px;
        text-align: right;
    }

    .input {
        font-family: consolas;
        background-color: #505050;
        border: none;
        color: white;
        width: 20%;
    }

    fieldset {
        border: none;
        width: 100%;
        margin: 0px auto;
    }
</style>
<form method="POST" action="main.php">
    <div id="mainForm">
        <fieldset>
            <label for="D_email">Email:</label>
            <input type="email" name="D_email" class="input" value="">
            <br>
            <label for="fromemail">From Email:</label>
            <input type="email" name="fromemail" class="input" value="">
            <br>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" class="input" value="">
            <br>
            <label for="Text">Text:</label>
            <input type="text" name="Text" class="input" value="">
            <br>
            <label for="nrofmsgs">Number of messages:</label>
            <input type="text" name="nrofmsgs" class="input" value="">
            <br>
        </fieldset>
    </div>
    <center><input type="submit" value="Submit"
                   style="background-color:#FF6A00;color:white;width:10%;border-width:1px;"></center>
</form>

<div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(204, 204, 204); box-shadow: rgba(0, 0, 0, 0.2) 2px 2px 3px; position: absolute; transition: visibility 0s linear 0.3s, opacity 0.3s linear 0s; opacity: 0; visibility: hidden; z-index: 2000000000; left: 0px; top: -10000px;">
    <div style="width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; z-index: 2000000000; background-color: rgb(255, 255, 255); opacity: 0.05;"></div>
    <div class="g-recaptcha-bubble-arrow"
         style="border: 11px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 2000000000;"></div>
    <div class="g-recaptcha-bubble-arrow"
         style="border: 10px solid transparent; width: 0px; height: 0px; position: absolute; pointer-events: none; margin-top: -10px; z-index: 2000000000;"></div>
    <div style="z-index: 2000000000; position: relative;">
        <iframe title="Zadanie reCAPTCHA"
                src="https://www.google.com/recaptcha/api2/bframe?hl=pl&amp;v=mhgGrlTs_PbFQOW4ejlxlxZn&amp;k=6LevGHsUAAAAADez2gm7v24ucN6P6dc5ipvXHI30&amp;cb=dkxc2pswhcmz"
                name="c-4aa495xhtn1t" frameborder="0" scrolling="no"
                sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"
                style="width: 100%; height: 100%;"></iframe>
    </div>
</div>