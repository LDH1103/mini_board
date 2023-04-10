# 게시글 제목 : 제목n
# 게시글 내용 : 내용n
# 작성일 : 현재일자

INSERT INTO board_info(
	board_title
	,board_contents
	,board_write_date
) 
VALUES (
	'제목25'
	,'내용25'
	,NOW()
);

SELECT *
FROM board_info;

COMMIT;
