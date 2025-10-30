-- جدول کاربران
CREATE TABLE IF NOT EXISTS users(
    user_id INTEGER PRIMARY KEY,
    phone TEXT,
    balance INTEGER DEFAULT 0,
    ref_id INTEGER,
    joined_channel INTEGER DEFAULT 0
);

-- جدول تراکنش‌ها
CREATE TABLE IF NOT EXISTS transactions(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    type TEXT, -- refer, buy, charge
    amount INTEGER,
    description TEXT,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- تنظیمات ربات
CREATE TABLE IF NOT EXISTS settings(
    key TEXT PRIMARY KEY,
    value TEXT
);
INSERT OR IGNORE INTO settings(key,value) VALUES
('force_join','0'),
('channel_id','@v_forallbot_channel'),
('pay_cart','1'),
('pay_laqira','0');

-- کارت بانکی مدیر
CREATE TABLE IF NOT EXISTS cards(
    id INTEGER PRIMARY KEY CHECK (id=1),
    card_number TEXT,
    card_name TEXT,
    sheba TEXT,
    active INTEGER DEFAULT 1
);
