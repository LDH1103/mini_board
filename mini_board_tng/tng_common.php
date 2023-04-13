<?php
// -------------------------------------------
// 함수명	: fnc_db_conn
// 기능		: DB Connection
// 파라미터	: Obj           &$param_conn
// 리턴값	: 없음
// -------------------------------------------
function fnc_db_conn( &$param_conn ) {
    $host = "localhost";
    $user = "root";
    $pass = "root506";
    $charset = "utf8mb4";
    $db_name = "board_tng";
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
    catch ( Exception $e ) {
        $param_conn = null;
        throw new Exception( $e->getMessage() );
    }
}

// -------------------------------------------
// 함수명	: fnc_db_select
// 기능		: 글 전체 검색
// 파라미터	: 없음
// 리턴값	: Array            $arr_result
// -------------------------------------------
function fnc_db_select() {
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
        ;
    $arr_prepare = array();
    
        $conn = null;
        try {
            fnc_db_conn( $conn );
            $stmt = $conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $arr_result = $stmt->fetchAll();
        } 
        catch ( Exception $e ) {
            return $e->getMessage();
        } 
        finally {
            $conn = null;
        }
    
        return $arr_result;
    
}

// TODO : test start -------------------------------------

// var_dump(fnc_db_select());

// TODO : test end   -------------------------------------



?>