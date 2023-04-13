<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", "board_header.php" );
    include_once( URL_DB );
    // include_once( C:\Apache24\htdocs\mini_board\src\common\db_common.php ); 랑 같음
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

    // paging block
    $block_set = 5; // 한 블럭당 보여줄 페이지 수
    $block_num = ceil( $page_num / $block_set ); // 현재 페이지 블럭
    $block_start = (( $block_num - 1 ) * $block_set ) + 1; // 첫 블럭
    $block_end = $block_start + $block_set - 1; // 마지막 블럭
    if( $block_end > $max_page_num ) {
        $block_end = $max_page_num; // 현재 블럭의 끝 페이지 번호가 전체 페이지 수보다 크다면, 다음 블럭이 존재하지 않으므로 현재 블럭의 끝 페이지 번호를 전체 페이지 수로 지정
    }
    $total_block = ceil( $max_page_num / $block_set ); // 총 블럭 수

    // 제목 몇글자만 출력
    // if ( mb_strlen( $recode["board_title"] ) > 10 ) {
    //     echo mb_substr( $recode["board_title"], 0, 10)."...";
    // } else {
    //     echo $recode["board_title"];
    // }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./css/board_list.css">
    <title>게시판</title>
</head>
<body>
    <span class="top_title">
        <?php include_once( URL_HEADER ); ?>
        <button type="button" class="btn btn-outline-secondary write-button" onclick="location.href='board_insert.php'">게시글 작성</button>
    </span>
    <div class="div_table">
        <table class="tbl">
            <thead class="tbl_th">
                <tr class="tbl_tr tbl_tr_color">
                    <th>게시글 번호</th>
                    <th>게시글 제목</th>
                    <th>작성일자</th>
                </tr>
            </thead>
            <tbody class="tbl_tbody">
                <?php
                    foreach( $result_paging as $recode ) {
                ?>
                        <tr class="tr_font tbl_tr">
                            <td><?php echo $recode["board_no"] ?></td>
                            <td class="td_left"><a class="a_none" href="board_detail.php?board_no=<?php echo $recode["board_no"] ?>"><?php if ( mb_strlen( $recode["board_title"] ) > 30 ) { echo mb_substr( $recode["board_title"], 0, 30).'...'; } else { echo $recode["board_title"]; } ?></a></td>
                            <td><?php echo $recode["board_write_date"] ?></td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="page_bar">
        <div class="page_bar_back">
        <?php
            if ( $page_num > 1 ) {
        ?>
                <a class='btn btn-outline-secondary' title='처음 페이지로 이동합니다.' href='board_list.php?page_num=1'>처음</a>
        <?php
            } else {
        ?>
                <a class='btn btn-outline-secondary hidden' title='처음 페이지로 이동합니다.' href='board_list.php?page_num=1'>처음</a>
        <?php
            }
            if ( $page_num > $block_set ) {
        ?>
                <a class='btn btn-outline-secondary a_margin_r' title='이전 블럭으로 이동합니다.' href='board_list.php?page_num=<?php echo $page_num - $block_set ?>'>이전</a>
        <?php
            } else {
        ?>
                <a class='btn btn-outline-secondary a_margin_r hidden' title='이전 블럭으로 이동합니다.' href='board_list.php?page_num=<?php echo $page_num - $block_set ?>'>이전</a>
        <?php
            }
        ?>
        </div>
        <div class="page_bar_list">
        <?php
            for ( $i = $block_start; $i <= $block_end; $i++ ) {
        ?> 
                <a class="btn btn-outline-secondary abs" title='<?php echo $i ?>페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $i ?>'><?php echo $i; ?></a>
        <?php
            }
        ?>
        </div>
        <div class="page_bar_pront">
        <?php
            if ( $page_num + $block_set <= $max_page_num ) {
        ?>
                <a class='btn btn-outline-secondary a_margin_l ' title='다음 블럭으로 이동합니다.' href='board_list.php?page_num=<?php echo $page_num + $block_set ?>'>다음</a>
        <?php
            } else {
        ?>
                <a class='btn btn-outline-secondary a_margin_l hidden' title='다음 블럭으로 이동합니다.' href='board_list.php?page_num=<?php echo $page_num + $block_set ?>'>다음</a>
        <?php
            }
        ?>
        <?php
            if ($page_num != $max_page_num) {
        ?>
                <a class='btn btn-outline-secondary' title='마지막 페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $max_page_num ?>'>마지막</a>
        <?php
            } else {
        ?>
                <a class='btn btn-outline-secondary hidden' title='마지막 페이지로 이동합니다.' href='board_list.php?page_num=<?php echo $max_page_num ?>'>마지막</a>
        <?php
            }
        ?>
        </div>
    </div>
</body>
</html>