<?php

function db_conn( &$param_conn ) {
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "board";
    $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
    $pdo_option = 
        array(
            PDO::ATTR_EMULATE_PREPARES     => false
            ,PDO::ATTR_ERRMODE             => PDO::ERRMODE_EXCEPTION
            ,PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC
        );

    try {
        $param_conn = new PDO( $dns, $user, $pass, $pdo_option );
    } 
    catch ( Exception $e ) { // 에러를 $e에 담겠다
        $param_conn = null;
        throw new Exception( $e->getMessage() );
    }
}

// 페이징 : 게시글 리스트에서 1페이지를 눌렀을때 1페이지 내용만, 2페이지를 눌렀을때 2페이지만 보여주는 것
function select_board_info_paging( &$param_arr ) {
    $sql =
        " SELECT "
        ."      board_no "
        ."      ,board_title "
        ."      ,board_write_date "
        ." FROM "
        ."      board_info "
        ." WHERE "
        ."      board_del_flg = '0' "
        ." ORDER BY "
        ."      board_no DESC "
        ." LIMIT :limit_num OFFSET :offset "
        ;
    $arr_prepare = 
        array(
            ":limit_num"    => $param_arr["limit_num"]
            ,":offset"      => $param_arr["offset"]
        );

    $conn = null;
    try {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare ); // 쿼리 실행 후 $result에 담기
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) {
        return $e->getMessage();
    } 
    finally {
        $conn = null;
    }

    return $result;
}

function select_board_info_cnt() {
    $sql =
        " SELECT "
        ."      COUNT(*) cnt "
        ." FROM "
        ."      board_info "
        ." WHERE "
        ."      board_del_flg = '0' "
        ;
    $arr_prepare = array();

    $conn = null;
    try {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) {
        return $e->getMessage();
    } 
    finally {
        $conn = null;
    }

    return $result;
}

function select_board_info_no( &$param_no ) {
    $sql =
        " SELECT "
        ."      board_no "
        ."      ,board_title "
        ."      ,board_contents "
        ." FROM "
        ."      board_info "
        ." WHERE "
        ."      board_del_flg = '0' "
        ."      AND board_no = :board_no "
        ;
    $arr_prepare = 
        array(
            ":board_no"    => $param_no
        );

    $conn = null;
    try {
        db_conn( $conn );
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare ); // 쿼리 실행 후 $result에 담기
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) {
        return $e->getMessage();
    } 
    finally {
        $conn = null;
    }

    return $result;
}

// TODO : test Start
// $arr = 
//     array(
//         "limit_num"    => 5
//         ,"offset"      => 0
//     );
// $result = select_board_info_paging( $arr );

// print_r( $result );


$no = 2;
$result = select_board_info_no( $no );

print_r( $result );

// TODO : test End




?>