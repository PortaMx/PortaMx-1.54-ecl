<?php
/**
* \file XmlPmx.template.php
* XML Respose template.
*
* \author PortaMx - Portal Management Extension
* \author Copyright 2008-2014 by PortaMx corp. - http://portamx.com
* \version 1.52
* \date 18.08.2014
*/

function template_main()
{
	global $context;

	echo '<', '?xml version="1.0" encoding="', $context['character_set'], '"?', '><pmx><![CDATA['. trim($context['xmlpmx']) .']]></pmx>';
}
?>