<?php 
    class Helper {
        public function generatePagination($limit, $page, $numberOfPost) {
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
    }
?>