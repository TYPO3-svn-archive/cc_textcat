<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

t3lib_extMgm::addService($_EXTKEY, 'textLang' /* sv type */, 'tx_cctextcat_sv1' /* sv key */,
		array(

			'title' => 'Text-Cat',
			'description' => 'TextCat is an implementation of the text categorization algorithm "N-Gram-Based Text Categorization" in Perl.',

			'subtype' => '',

			'available' => TRUE,
			'priority' => 50,
			'quality' => 69,

			'os' => '',
			'exec' => 'perl',

			'classFile' => t3lib_extMgm::extPath($_EXTKEY).'sv1/class.tx_cctextcat_sv1.php',
			'className' => 'tx_cctextcat_sv1',
		)
	);

?>
