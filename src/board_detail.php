<?php
define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
define( "URL_HEADER", "board_header.php" );
include_once( URL_DB );

// Request Parameter 획득(GET)
$arr_get = $_GET;

// DB에서 게시글 정보 획득
$result_info = select_board_info_no( $arr_get["board_no"] );

ob_start(); include_once('board_update.php'); ob_end_clean();

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/board_update.css"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title><?php echo $result_info["board_title"] ?></title>
    <link rel="stylesheet" href="./css/board_detail.css">
</head>
<body>
    <?php include( URL_HEADER ); ?>
    <div class="main_contents"> 
        <div class=info_div>
            <div class="info_div1"><?php echo $result_info["board_no"] ?></div>
            <div class="info_div2"><?php if ( mb_strlen( $result_info["board_title"] ) > 35 ) { echo mb_substr( $result_info["board_title"], 0, 35).' ...'; } else { echo $result_info["board_title"]; } ?></div>
            <div class="info_div3"><?php echo $result_info["board_write_date"] ?></div>
        </div>
        <p class="board_contents"><?php echo $result_info["board_contents"] ?></p>
    </div>
    <div class="btns">
        <button class="btn btn-outline-dark" type="button" title="수정 페이지로 이동" onclick="location.href='board_update.php?board_no=<?php echo $board_no ?>'">수정</button>
        <button class="btn btn-outline-dark" type="button" title="삭제하기" onclick="location.href='board_delete.php?board_no=<?php echo $result_info['board_no'] ?>'">삭제</button>
        <button class="btn btn-outline-dark" type="button" title="리스트로 돌아가기" onclick="location.href='board_list.php?page_num=<?php echo $list_page ?>'">리스트</button>
    </div>
</body>
</html>