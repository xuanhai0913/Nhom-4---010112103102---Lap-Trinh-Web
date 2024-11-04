// config.js
var server = 'production'; // local | test | production
var STRINGEE_SERVER_ADDRS;
var getTokenUrl;

if (server === 'local') {
    STRINGEE_SERVER_ADDRS = ['wss://local-huydn.stringee.com:6899/', 'wss://local-huydn.stringee.com:5899/'];
    getTokenUrl = '../token.php';
} else if (server === 'production') {
    STRINGEE_SERVER_ADDRS = ['wss://v1.stringee.com:6899/', 'wss://v2.stringee.com:6899/'];
    getTokenUrl = '../token_pro.php';
} else if (server === 'test') {
    STRINGEE_SERVER_ADDRS = ['wss://test3.stringee.com:6899/', 'wss://test3.stringee.com:6899/'];
    getTokenUrl = '../token_test.php';
}
