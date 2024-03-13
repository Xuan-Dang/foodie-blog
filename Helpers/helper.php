<?php
class Helper
{
    public function generatePagination($limit, $page, $numberOfPost)
    {
        $queryString = $_SERVER["QUERY_STRING"];
        parse_str($queryString, $queryArray);
        $maxRange = 3;
        $numberOfPage = ceil($numberOfPost / $limit);
        $pagination = "<div class='pagination-style mt-4'>";
        $pagination .= "<ul>";
        // Tạo nút "Prev"
        if ($page > 1) {
            $queryArray["page"] = $page - 1;
            $queryStringConverted = http_build_query($queryArray);
            $pagination .= "<li> <a href='?$queryStringConverted'><span class='fa fa-angle-double-left' aria-hidden='true'></span></a></li>";
        }

        if ($page > $maxRange + 1) {
            die($page);
            $pagination .= '<li>...</li>';
        }

        // Tạo các nút số trang
        $start = max(1, $page - $maxRange);

        $end = min($numberOfPage, $page + $maxRange);

        for ($i = $start; $i <= $end; $i++) {
            $queryArray["page"] = $i;
            $queryStringConverted = http_build_query($queryArray);
            if ($page == $i) {
                // Trang hiện tại
                $pagination .= "<li><a href='?$queryStringConverted' class='active'>{$i}</a></li>";
            } else {
                // Các trang khác
                $pagination .= "<li><a href='?$queryStringConverted'>{$i}</a></li>";
            }
        }

        // Kiểm tra nếu trang hiện tại nhỏ hơn tổng số trang trừ max$maxRange
        if ($page < $numberOfPage - $maxRange) {
            $pagination .= '<li>...</li>';
        }

        // Hiển thị trang cuối cùng nếu nó không nằm trong danh sách hiển thị
        if ($page < $numberOfPage && $numberOfPage > $end) {
            $queryArray["page"] = $numberOfPage;
            $queryStringConverted = http_build_query($queryArray);
            $pagination .= "<li><a href='?$queryStringConverted'>{$numberOfPage}</a></li>";
        }

        if ($page < $numberOfPage) {
            $queryArray["page"] = $page + 1;
            $queryStringConverted = http_build_query($queryArray);
            $pagination .= "<li><a href='?$queryStringConverted'><span class='fa fa-angle-double-right' aria-hidden='true'></span></a></li>";
        }

        $pagination .= "</ul>";
        $pagination .= "</div>";
        return $pagination;
    }
    public function handleError()
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            $message = '';
            $message .= 'Error level: ' . $errno . '<br />';
            $message .= 'Error message: ' . $errstr . '<br />';
            $message .= 'Error file: ' . $errfile . '<br />';
            $message .= 'Error line: ' . $errline . '<br />';
            throw new Error($message);
        });
    }
    public function generateToken()
    {
        // Check if a token is present for the current session
        if (!isset($_SESSION["csrf_token"])) {
            // No token present, generate a new one
            $token = random_bytes(64);
            $hexToken = bin2hex($token);
            $_SESSION["csrf_token"] = $hexToken;
        } else {
            // Reuse the token
            $hexToken = $_SESSION["csrf_token"];
        }
        return $hexToken;
    }
    public function stripTags($content)
    {
        return strip_tags($content, "<h1><h2><h3><p><img><audio><video><table><ul><ol><li><a><b><i><u><strong><em><mark><small><big><sub><sup><time><q><blockquote><code><pre><meter><progress>");
    }
    public function setSession($name, $value)
    {
        session_start();
        $_SESSION[$name] = $value;
        session_write_close();
    }
    public function getSession($name)
    {
        session_start();
        $value = null;
        if (isset($_SESSION[$name])) $value = $_SESSION[$name];
        session_write_close();
        return $value;
    }
    public function detroySession() {
        session_start();
        session_destroy();
        session_write_close();
    }
    public function detroySesssionByName($name) {
        session_start();
        unset($_SESSION[$name]);
        session_write_close();
    }
    public function push($path)
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $domain = $_SERVER["HTTP_HOST"];
        header("Location: $protocol://$domain/foodie-blog/$path");
        exit;
    }
}
