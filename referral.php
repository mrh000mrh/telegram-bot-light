<?php
// ذخیره زیرمجموعه
function saveReferral($user_id,$ref_id){
    $db=db();
    // قبلاً معرفی نشده باشه
    $exists=$db->prepare("SELECT id FROM users WHERE user_id=?")->execute([$user_id]);
    if(!$exists->fetch()){
        $db->prepare("INSERT INTO users(user_id,ref_id,balance) VALUES (?,?,0)")->execute([$user_id,$ref_id]);
        // پاداش معرف
        $reward=10000; // ۱۰k تومان
        addBalance($ref_id,$reward);
        logTransaction($ref_id,'refer',$reward,"زیرمجموعه جدید: $user_id");
        sendMessage($ref_id,"🎉 یک نفر با لینک شما عضو شد.\n💰 ۱۰,۰۰۰ تومان به حسابتان افزوده شد.");
    }
}
// لینک دعوت کاربر
function getRefLink($user_id){
    $bot='v_forallbot'; // یوزرنیم ربات خودت
    return "https://t.me/$bot?start=$user_id";
}
