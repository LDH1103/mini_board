<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );
    $http_method = $_SERVER["REQUEST_METHOD"];

    // 처음 접속시 페이지 넘버 정해주기
    if( array_key_exists( "page_num", $_GET ) ) {
        $page_num = $_GET["page_num"];
    } else {
        $page_num = 1;
    }

    $limit_num = 5;

    // 게시판 정보 테이블 전체 카운트 획득
    $result_cnt = select_board_info_cnt();

    // offset
    $offset = ( $page_num * $limit_num ) - $limit_num;

    // max page num
    $max_page_num = ceil( (int)$result_cnt[0]["cnt"] / $limit_num );

    $arr_prepare =
        array(
            "limit_num" => $limit_num
            ,"offset"   => $offset
        );
    $result_paging = select_board_info_paging( $arr_prepare );
    // var_dump( $max_page_num );

    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Pixels&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시판</title>
    <style>
        * {
            margin : 0;
            padding : 0;
            box-sizing : border-box;
        }
        .div_table {
            margin : 15px auto;
            width : 900px;
        }
        body {
            text-align : center;
        }
        .a_margin_r {
            margin-right : 15px;
        }
        .a_margin_l {
            margin-left : 15px;
        }
        .page_bar {
            width : 400px;
            margin : 0 auto;
        }
        .abs {
            margin : 20px auto;
        }
        .top {
            margin-top : 30px;
            font-weight : 900;
            font-family: 'Rubik Pixels', cursive;
            font-size : 50px;
        }
        .hidden {
            visibility:hidden;
        }
        .td_left {
            text-align : left;
        }
    </style>
</head>
<body>
    <h1 class="top">BOARD</h1>
    <div class="div_table">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>게시글 번호</th>
                    <th>게시글 제목</th>
                    <th>작성일자</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach( $result_paging as $recode ) {
                ?>
                        <tr>
                            <td><?php echo $recode["board_no"] ?></td>
                            <td class="td_left"><?php echo $recode["board_title"] ?></td>
                            <td><?php echo $recode["board_write_date"] ?></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="page_bar">
    <?php
        if ($page_num > 1) {
    ?>
            <a class='btn btn-outline-secondary a_margin_r' title='처음 페이지로 이동합니다.' href='board_list.php?page_num=1'>◀◀</a>
    <?php
        } else {
    ?>
            <a class='btn btn-outline-secondary a_margin_r hidden' title='처음 페이지로 이동합니다.' href='board_list.php?page_num=1'>◀◀</a>
    <?php
        }
    ?>
    <?php
        for ( $i = 1; $i <= $max_page_num; $i++ ) {
    ?> 
            <a class="btn btn-outline-secondary abs" title='<?php echo $i ?>페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i; ?></a>
    <?php
        }
    ?>
    <?php
        if ($page_num != $max_page_num) {
    ?>
            <a class='btn btn-outline-secondary a_margin_l' title='마지막 페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $max_page_num ?>'>▶▶</a>
    <?php
        } else {
    ?>
            <a class='btn btn-outline-secondary a_margin_l hidden' title='마지막 페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $max_page_num ?>'>▶▶</a>
    <?php
        }
    ?>
    </div>
</body>
</html>