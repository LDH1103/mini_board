<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];

    if ( $http_method === "POST" ) {
        $arr_post = $_POST;

        $result_cnt = insert_board_info( $arr_post );
        header( "Location: board_list.php" );
        exit();
    }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/board_insert.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시글 작성</title>
</head>
<body>
<h1 class="top_main" style="margin-top : 30px;"><a href="board_list.php" style="text-decoration : none; color : black; margin-top : 30px; font-weight : 900; font-family: 'Bebas Neue', cursive; font-size : 80px;">BOARD</a></h1>
    <h2 class="sub_title">게시글 작성</h2>
    <form class="body_form" method="post" action="board_insert.php">
		<label class="label_title" for="title">제목</label>
		<input class="input_title" type="text" maxlength="100" spellcheck="false" name="board_title" id="title">
        <br>
		<label for="contents"></label>
		<textarea class="input_contents" spellcheck="false" name="board_contents" id="contents"></textarea>
		<br>
		<button class="btn btn-outline-dark" type="submit" title="게시글 작성">작성</button>
		<button class="btn btn-outline-dark" type="button" title="취소하기" onclick="location.href='board_list.php'">취소</button>
    </form>
</body>
</html>