<?php $siteemailtoreceive = "mail@little-bridges.com";
$sitepageurl = "https://www.little-bridges.com/index.html";
$sitedomainroot = "https://www.little-bridges.com";
if ($_POST) {
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email_address = strip_tags(htmlspecialchars($_POST['email']));
    $message = strip_tags(htmlspecialchars($_POST['message']));
    $ipaddress = $_SERVER["REMOTE_ADDR"];
    $ipaddress2 = $_SERVER["HTTP_X_FORWARDED_FOR"];
    date_default_timezone_set('Asia/Manila');
    $datum = date('Y-m-d H:i:s');
    $to = $siteemailtoreceive;
    if ($_POST['name'] != '') {
        echo json_encode(array('name' => 'bot'));
        exit;
    } else {
        $subject = "📩 Little Bridges Contact Form";
        $email_body = "You have received a new message from your website.\n\r\n";
        $email_body = $email_body . "Here are the details:\n\r\n";
        $email_body = $email_body . "Email: $email_address\n\r\n";
        $email_body = $email_body . "Message:\n$message\n\n\r\n";
        $email_body = $email_body . "Server data: https://ipinfo.io/$ipaddress $ipaddress2 \n$datum\n\r\n";
        $headers = "From: $email_address\n";
        $headers .= "Reply-To: $email_address\n";
        $headers .= "Mime-Version: 1.0\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\n";
        mail($to, $subject, $email_body, $headers) or die("Error!");
        $domain_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        header("Content-type: application/json");
        header("Access-Control-Allow-Credentials: true");
        header("Access-Control-Allow-Origin: " . str_replace('.', '-', $sitedomainroot) . ".cdn.ampproject.org");
        header("AMP-Access-Control-Allow-Source-Origin: " . $domain_url);
        header("Access-Control-Expose-Headers: AMP-Access-Control-Allow-Source-Origin");
        header("Access-Control-Expose-Headers: AMP-Redirect-To, AMP-Access-Control-Allow-Source-Origin");
        echo json_encode(array('name' => 'human'));
        exit;
    }
} ?>