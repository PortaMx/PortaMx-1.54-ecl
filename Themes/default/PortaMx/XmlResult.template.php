<?php
/**
* \file XmlPmx.template.php
* XML Respose template.
*
* \author PortaMx - Portal Management Extension
* \author Copyright 2008-2012 by PortaMx - http://portamx.com
* \version 1.51
* \date 31.08.2012
*/

function template_main()
{
	global $context;

	echo '<', '?xml version="1.0" encoding="', $context['character_set'], '"?', '><pmx><![CDATA['. trim($context['xmlpmx']) .']]></pmx>';
}
?>