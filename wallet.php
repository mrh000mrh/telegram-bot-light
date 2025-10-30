<?php
// افزایش موجودی کاربر
function addBalance($user_id,$amount){
    $db=db();
    $db->prepare("UPDATE users SET balance=balance+? WHERE user_id=?")->execute([$amount,$user_id]);
}
// کم کردن موجودی
function reduceBalance($user_id,$amount){
    $db=db();
    $db->prepare("UPDATE users SET balance=balance-? WHERE user_id=?")->execute([$amount,$user_id]);
}
// گرفتن موجودی
function getBalance($user_id){
    $db=db();
    $stmt=$db->prepare("SELECT balance FROM users WHERE user_id=?");
    $stmt->execute([$user_id]);
    return (int)$stmt->fetchColumn();
}
// ثبت گردش
function logTransaction($user_id,$type,$amount,$desc=''){
    $db=db();
    $db->prepare("INSERT INTO transactions(user_id,type,amount,description,created) VALUES (?,?,?,?,datetime('now'))")
       ->execute([$user_id,$type,$amount,$desc]);
}
// خرید با موجودی
function buyWithBalance($user_id,$plan_price){
    if(getBalance($user_id)<$plan_price){
        sendMessage($user_id,"❌ موجودی کافی نیست.\n💰 موجودی فعلی: ".getBalance($user_id)." تومان");
        return false;
    }
    reduceBalance($user_id,$plan_price);
    logTransaction($user_id,'buy',$plan_price,'خرید با کیف‌پول');
    return true;
}
