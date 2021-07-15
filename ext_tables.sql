CREATE TABLE tx_chart_domain_model_chart (
	title varchar(255) DEFAULT '' NOT NULL,
	alternative_title varchar(255) DEFAULT '' NOT NULL,
	label_axis_x varchar(255) DEFAULT '' NOT NULL,
	data_type_axis_x varchar(50) DEFAULT '' NOT NULL,
	label_axis_y varchar(255) DEFAULT '' NOT NULL,
	data_type_axis_y varchar(50) DEFAULT '' NOT NULL,
	datasets int(11) unsigned DEFAULT '0' NOT NULL
);

CREATE TABLE tx_chart_domain_model_dataset (
	chart int(11) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	color varchar(10) DEFAULT '' NOT NULL
);

CREATE TABLE tx_chart_domain_model_value (
	title varchar(255) DEFAULT '' NOT NULL,
	pi_flexform text,
	content int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tt_content (
	tx_chart_chart int(11) unsigned DEFAULT '0' NOT NULL,
	tx_chart_values int(11) unsigned DEFAULT '0' NOT NULL
);
