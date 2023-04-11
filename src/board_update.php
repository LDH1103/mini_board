<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );


?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/css_common.css">
    <title>게시글 수정</title>
</head>
<body>

    <label for="bno"> 게시글 번호 : </label>
    <input type="text" value="1" id="bno" readonly>
    <br>
    <label for="title"> 게시글 제목 : </label>
    <input type="text" value="제목1" id="title">
    <br>
    <label for="contents"> 게시글 내용 : </label>
    <input type="text" value="내용1" id="contents">

</body>
</html>