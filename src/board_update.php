<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", "board_header.php" );
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
        // $result_info = select_board_info_no( $arr_post["board_no"] ); // 0412 del

        // 수정 후 detail 페이지로 redirect
        header( "Location: board_detail.php?board_no=".$arr_post["board_no"] );
        exit(); // 31행에서 redirect 했기 때문에 이후의 소스 코드는 실행할 필요가 없다.
    }

    // 내림차순 정렬일때 페이지 구하기
    ob_start(); include_once('board_list.php'); ob_end_clean(); // 다른 php파일 변수 불러오기 (다른내용은 출력 안함)
    if ( $board_no >= $result_cnt[0]["cnt"] ) {
        $list_page = 1;
    } else {
        $list_page = ceil(( $result_cnt[0]["cnt"] - $result_info["board_no"] ) / $limit_num ); 
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>게시글 수정</title>
    <link rel="stylesheet" href="./css/board_update.css">
</head>
<body>
    <?php include( URL_HEADER ); ?>
    <h2 class="sub_title">게시글 수정</h2>
    <form class="body_form" method="post" action="board_update.php">
		<label class="label_title" for="title">제목</label>
		<input class="input_title" type="text" maxlength="100" spellcheck="false" name="board_title" id="title" value="<?php echo $result_info["board_title"] ?>">
        <label class="label_no" for="bno">글 번호 : </label>
		<input class="input_no" type="text" name="board_no" id="bno" value="<?php echo $result_info["board_no"] ?>" readonly>
        <br>
		<label for="contents"></label>
		<textarea class="input_contents" spellcheck="false" name="board_contents" id="contents"><?php echo $result_info["board_contents"] ?></textarea>
		<br>
		<button class="btn btn-outline-dark" type="submit" title="수정하기" onclick="alert('수정 완료')">수정 완료</button>
		<button class="btn btn-outline-dark" type="submit" title="취소하기" onclick="location.href='board_detail.php?board_no=<?php echo $result_info['board_no'] ?>'">취소</button>
        <button class="btn btn-outline-dark" type="button" title="리스트로 돌아가기" onclick="location.href='board_list.php?page_num=<?php echo $list_page ?>'">리스트</button>

        <!-- onclick="history.back()" -->
    </form>

</body>
</html>