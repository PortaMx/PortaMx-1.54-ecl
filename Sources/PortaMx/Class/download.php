<?php
/**
* \file download.php
* Systemblock Downlaod
*
* \author PortaMx - Portal Management Extension
* \author Copyright 2008-2012 by PortaMx - http://portamx.com
* \version 1.51
* \date 31.08.2012
*/

if(!defined('PortaMx'))
	die('This file can\'t be run without PortaMx');

/**
* @class pmxc_download
* Systemblock Download
* @see download.php
* \author Copyright by PortaMx - http://portamx.com
*/
class pmxc_download extends PortaMxC_SystemBlock
{
	var $download_content;

	/**
	* InitContent.
	* Checks the autocache and create the content if necessary.
	*/
	function pmxc_InitContent()
	{
		global $smcFunc, $context, $user_info, $scripturl, $txt;

		if($this->visible)
		{
			$L_R = empty($context['right_to_left']) ? 'left' : 'right';
			$R_L = empty($context['right_to_left']) ? 'right' : 'left';

			$this->download_content = parse_bbc($this->cfg['content']);

			if(isset($this->cfg['config']['settings']['download_board']) && !empty($this->cfg['config']['settings']['download_board']))
			{
				// get downloads for board
				$request = $smcFunc['db_query']('', '
						SELECT a.id_attach, a.size, a.downloads, t.id_topic, t.locked, m.subject, m.body,
						IF(m.subject REGEXP \'^[0-9 ]{4}\', CAST(LEFT(m.subject, 4) AS UNSIGNED), 0) AS file_order
						FROM {db_prefix}attachments a
						LEFT JOIN {db_prefix}messages m ON (a.id_msg = m.id_msg)
						LEFT JOIN {db_prefix}topics t ON (m.id_topic = t.id_topic)
						WHERE m.id_board = {int:board}
						AND a.mime_type NOT LIKE {string:likestr} AND t.locked = 0
						ORDER BY file_order ASC',
					array(
						'board' => $this->cfg['config']['settings']['download_board'],
						'likestr' => 'IMAGE%'
					)
				);

				$dlacs = implode('=1,', $this->cfg['config']['settings']['download_acs']);
				$entrys = $smcFunc['db_num_rows']($request);
				if($entrys > 0)
				{
					while($row = $smcFunc['db_fetch_assoc']($request))
					{
						$this->download_content .= '
						<div style="text-align:'. $L_R .';">';

						if(allowPmxGroup($dlacs))
							$this->download_content .= '
							<a href="'. $scripturl .'?action=dlattach;id='. $row['id_attach'] .';fld='. $this->cfg['id'] .'">
								<img style="vertical-align:middle;" src="'. $context['pmx_imageurl'] .'download.png" alt="*" title="'. (empty($row['file_order']) ? $row['subject'] : substr($row['subject'], 4)) .'" /></a>';

						if($user_info['is_admin'])
							$this->download_content .= '
							<a href="'. $scripturl .'?topic='. $row['id_topic'] .'">
								<strong>'. (empty($row['file_order']) ? $row['subject'] : substr($row['subject'], 4)) .'</strong>
							</a>';
						else
							$this->download_content .= '
							<strong>'. (empty($row['file_order']) ? $row['subject'] : substr($row['subject'], 4)) .'</strong>';

						$this->download_content .= '
							<div class="dlcomment">'. parse_bbc(trim($row['body'])) .'</div>
							<b>['. round($row['size'] / 1000, 3) .'</b> '. $txt['pmx_kb_downloads'] .'<b>'. $row['downloads'] .'</b>]
						</div>' . ($entrys > 1 ? '<hr />' : '');
						$entrys--;
					}
					$smcFunc['db_free_result']($request);
				}
				else
					$this->download_content .= '<br />'. $txt['pmx_download_empty'];
			}
			else
				$this->download_content .= '<br />'. $txt['pmx_download_empty'];
		}
		// return the visibility flag (true/false)
		return $this->visible;
	}

	/**
	* ShowContent
	* Output the content.
	*/
	function pmxc_ShowContent()
	{
		echo '
		'. $this->download_content;
	}
}
?>