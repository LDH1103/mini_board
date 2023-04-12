<?php
define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
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
    <title><?php echo $result_info["board_title"] ?></title>
    <link rel="stylesheet" href="./css/board_detail.css">
</head>
<body>
    <h1 class="top"><a href="board_list.php" style="text-decoration : none; color : black;">BOARD</a></h1>
    <div>
        <p>게시글 번호 : <?php echo $result_info["board_no"] ?></p>
        <p>작성일 : <?php echo $result_info["board_write_date"] ?></p>
        <p>게시글 제목 : <?php echo $result_info["board_title"] ?></p>
        <p>게시글 내용 : <?php echo $result_info["board_contents"] ?></p>

    </div>
    <button class="btn btn-outline-dark" type="button" title="수정 페이지로 이동" onclick="location.href='board_update.php?board_no=<?php echo $board_no ?>'">수정</button>
    <button class="btn btn-outline-dark" type="button" title="삭제하기" onclick="location.href='board_update.php?board_no=<?php echo $board_no ?>'">삭제</button>
    <button class="btn btn-outline-dark" type="button" title="리스트로 돌아가기" onclick="location.href='board_list.php?page_num=<?php echo $list_page ?>'">리스트</button>
</body>
</html>