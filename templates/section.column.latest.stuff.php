<?
	global $db, $cfg;
	$res = $db->query('SELECT id, title
					   FROM work
					   WHERE (work.mode=1) 
					   ORDER BY added DESC
					   LIMIT 0,5');
	$xat['recent'] = array();
	while($row=$db->toArray($res)) $xat['recent'][] = $row;
	
	$res = $db->query('SELECT id, title
					   FROM work 
					   WHERE (work.mode=1) 
					   ORDER BY downloads DESC
					   LIMIT 0,5');
	$xat['downloads'] = array();
	while($row=$db->toArray($res)) $xat['downloads'][] = $row;


	$res = $db->query('SELECT title, id
					   FROM free 
					   LIMIT 0,5');
	$xat['free'] = array();
	while($row=$db->toArray($res)) $xat['free'][] = $row;

	$res = $db->query('SELECT work.id, work.title
					   FROM work, category 
			   		   WHERE (category.fk_overmode=1) AND (work.fk_category=category.id) AND (work.mode=1)
					   ORDER BY work.downloads DESC
					   LIMIT 0,5');
	$xat['top_ov1'] = array();
	while($row=$db->toArray($res)) $xat['top_ov1'][] = $row;


	$dbx = new APIDatabase($cfg['db_host'], $cfg['db_user'], $cfg['db_pass']);
	$dbx->connect();
	$dbx->selectDatabase($cfg['db_forum']);
	
	$res = $dbx->query('SELECT phpbb_posts.post_id as id, phpbb_posts.post_username, phpbb_posts_text.post_text AS post_text FROM phpbb_posts
						LEFT JOIN phpbb_posts_text ON phpbb_posts.post_id = phpbb_posts_text.post_id
						WHERE phpbb_posts.post_approve=1
						ORDER BY phpbb_posts.post_time DESC
						LIMIT 0,5');
function stripBBCode($text_to_search) {
 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';
 $replace = '';
 return preg_replace($pattern, $replace, $text_to_search);
}						

	echo $dbx->getLastError();
	$xat['posts'] = array();
	while($row=$dbx->toArray($res)) 
	{
		$row['post_text'] = str_replace(array('ê','±','æ','¶','¿','¼','³','ó'),
										array('ę','ą','ć','ś','ż','ź','ł','ó'),
										substr(stripBBcode($row['post_text']), 0, 40));
		$xat['posts'][] = $row;	
	}
	
?>    
    <div id="bottom_m"> <!-- bottom_m -->
        <div class="bottom_m_column"> <!-- bottom_m_column -->
            <h4>Najnowsze prace</h4>
            <ul>
				<?php foreach (@$xat['recent'] as $recent) { ?>
                <li><a href="<?php echo APPPATH; ?>work.view/<?php echo $recent['id']; ?>"><?php echo $recent['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div> <!-- [end] bottom_m_column -->
        
        <div class="bottom_separator"> <!-- --> </div>
        
        <div class="bottom_m_column"> <!-- bottom_m_column -->
            <h4>Najczęściej pobierane</h4>
            <ul>
                <?php foreach (@$xat['downloads'] as $recent) { ?>
                <li><a href="<?php echo APPPATH; ?>work.view/<?php echo $recent['id']; ?>"><?php echo $recent['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div> <!-- [end] bottom_m_column -->
        
        <div class="bottom_separator"> <!-- --> </div>
        
        <div class="bottom_m_column"> <!-- bottom_m_column -->
            <h4>Ostatnie posty</h4>
            <ul>
				<?php foreach (@$xat['posts'] as $post) { ?>
                <li><a href="<?php echo str_replace('{postid}',$post['id'],$cfg['viewpost_url']); ?>"><?php echo $post['post_text']; ?></a></li>
                <?php } ?>
            </ul>
        </div> <!-- [end] bottom_m_column -->
        
        <div class="clearfloat"> <!-- --> </div>
        
    </div> <!-- [end] bottom_m -->