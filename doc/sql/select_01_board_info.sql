SELECT 
	board_no
	,board_title
	,board_write_date
FROM board_info
WHERE board_del_flg = '0'
ORDER BY board_no ASC
LIMIT 5 OFFSET 0
;

SELECT
	COUNT(*)	cnt
FROM board_info
WHERE board_del_flg = '0';