<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    // Request Method를 획득
    $http_method = $_SERVER["REQUEST_METHOD"];
    // GET일때
    if( $http_method === "GET" ) {
        $board_no = 1;
        if( array_key_exists( "board_no", $_GET ) ) {
            $board_no = $_GET["board_no"];
        }
        $result_info = select_board_info_no( $board_no );
    } else { // POST일떄
        $arr_post = $_POST;
        $arr_info =
            array(
                "board_no"          => $arr_post["board_no"]
                ,"board_title"      => $arr_post["board_title"]
                ,"board_contents"   => $arr_post["board_contents"]
            );
        // update
        $result_cnt = update_board_info_no( $arr_info );

        // select
        $result_info = select_board_info_no( $arr_post["board_no"] );
    }

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./css/board_update.css">
    <title>게시글 수정</title>
</head>
<body>
    <h1 class="top">게시글 수정</h1>
    <form class="body_form" method="post" action="board_update.php">
        <div>글 번호 : <?php echo $result_info['board_no'] ?></div>
        <br>
        <label for="title"></label>
        <input type="text" name="board_title" id="title" value="<?php echo $result_info['board_title'] ?>" class="input_title">
        <br>
        <label for="contents"></label>
        <textarea name="board_contents" id="contents" class="input_contents"><?php echo $result_info['board_contents'] ?></textarea>
        <br>
        <button type="submit">수정</button>
        <button type="button" onclick="location.href='board_list.php'" >리스트</button>
    </form>

</body>
</html>