<?php
require 'config.php';
require 'payment.php';
require 'admin.php';
require 'wallet.php';
require 'referral.php';

$input = json_decode(file_get_contents('php://input'), 1);
if (!$input) die;

$chat_id = $input['message']['chat']['id'] ?? null;
$text    = $input['message']['text'] ?? '';
$photo   = $input['message']['photo'] ?? null;
$contact = $input['message']['contact'] ?? null;

if (!$chat_id) die;

// شروع ساده
if ($text === '/start') {
    sendMessage($chat_id, "🟢 ربات آماده است\nبرای ادامه شماره‌ت رو ارسال کن:", [
        'keyboard' => [
            [['text' => "📱 ارسال شماره‌ام", 'request_contact' => true]]
        ], 'resize_keyboard' => true
    ]);
}
