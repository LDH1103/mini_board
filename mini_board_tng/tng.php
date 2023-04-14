<?php
define( "FOLDER_ROOT", "C:/Apache24/htdocs/mini_board_tng"."/" );
define( "DOC_ROOT", FOLDER_ROOT."tng_common.php" );
include_once( DOC_ROOT );

$result = fnc_db_select();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TNG</title>
</head>
<body>
    <table>
        <thead>
            <th>글 번호</th>
            <th>글 제목</th>
            <th>작성일</th>
        </thead>
        <tbody>
            <?php
                foreach ($result as $recode) {
            ?>
                <tr>
                    <td><?php echo $recode['board_no']; ?></td>
                    <td><?php echo $recode['board_title']; ?></td>
                    <td><?php echo $recode['board_write_date']; ?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>