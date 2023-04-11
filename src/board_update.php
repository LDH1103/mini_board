<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    $board_no = 1;
    if( array_key_exists( "board_no", $_GET ) ) {
        $board_no = $_GET["board_no"];
    }
    $result_info = select_board_info_no( $board_no );

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/css_common.css">
    <title>게시글 수정</title>
    <style>
        body {
            font-size : 20px;
        }
        input {
            margin : 10px;
            text-align : center;
            font-size : 20px;
        }
    </style>
</head>
<body>

    <label for="bno"> 게시글 번호 : </label>
    <input type="text" value="<?php echo $result_info['board_no'] ?>" id="bno" readonly>
    <br>
    <label for="title"> 게시글 제목 : </label>
    <input type="text" value="<?php echo $result_info['board_title'] ?>" id="title">
    <br>
    <label for="contents"> 게시글 내용 : </label>
    <input type="text" value="<?php echo $result_info['board_contents'] ?>" id="contents">

</body>
</html>