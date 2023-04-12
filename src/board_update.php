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

    // 내림차순 정렬일때 페이지 구하기
    ob_start(); include_once('board_list.php'); ob_end_clean(); // 다른 php파일 변수 불러오기 (다른내용은 출력 안함)
    $list_page = ceil(( $result_cnt[0]["cnt"] - $result_info["board_no"] +1 ) / $limit_num ); 
    // 올림(( 전체글 갯수 - 현재글 번호 ) / 한페이지에 보여지는 글 수 );

    // 오름차순 정렬일때 페이지 구하기
    // ob_start(); include_once('board_list.php'); ob_end_clean();echo ceil( $result_info['board_no'] / $limit_num );
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/css_common.css">
    <link rel="stylesheet" href="./css/board_update.css"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시글 수정</title>
</head>
<body>
    <h1 class="top_main"><a href="board_list.php" style="text-decoration : none; color : black; margin-top : 30px; font-weight : 900; font-family: 'Bebas Neue', cursive; font-size : 80px;">BOARD</a></h1>
    <h2 class="top">게시글 수정</h2>
    <form class="body_form" method="post" action="board_update.php">
		<label class="label_title" for="title">제목</label>
		<input class="input_title" type="text" spellcheck="false" name="board_title" id="title" value="<?php echo $result_info["board_title"] ?>">
        <label class="label_no" for="bno">글 번호 : </label>
		<input class="input_no" type="text" name="board_no" id="bno" value="<?php echo $result_info["board_no"] ?>" readonly>
        <br>
		<label for="contents"></label>
		<textarea class="input_contents" spellcheck="false" name="board_contents" id="contents"><?php echo $result_info["board_contents"] ?></textarea>
		<br>
		<button class="btn btn-outline-dark" type="submit" title="수정하기" onclick="alert('수정 완료')">수정 완료</button>
        <button class="btn btn-outline-dark" type="button" title="리스트로 돌아가기" onclick="location.href='board_list.php?page_num=<?php echo $list_page ?>'">리스트</button>

        <!-- onclick="history.back()" -->
    </form>

</body>
</html>