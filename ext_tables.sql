CREATE TABLE tx_chart_domain_model_chart (


	title varchar(255) DEFAULT '' NOT NULL,
	alternative_title varchar(255) DEFAULT '' NOT NULL,
	label_axis_x varchar(255) DEFAULT '' NOT NULL,
	label_axis_y varchar(255) DEFAULT '' NOT NULL,
	datasets int(11) unsigned DEFAULT '0' NOT NULL


);

CREATE TABLE tx_chart_domain_model_dataset (

	chart int(11) unsigned DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	color int(11) DEFAULT '0' NOT NULL


);
