SET FOREIGN_KEY_CHECKS=0;
INSERT INTO `companies` (`company_code`, `company_name`, `company_short_name`, `company_address`, `municipality_code`, `settlement_code`, `street_code`, `telephone1`, `telephone2`, `fax`, `mail`, `owner`, `authorized`, `activity`, `id_number`, `tax_code`, `tax_payer`) VALUES
('002', 'Company 002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('010', 'Company 010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('030', 'Company 030', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('039', 'Company 039', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('051', 'Company 051', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('056', 'Company 056', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('072', 'Company 072', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('077', 'Company 077', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('082', 'Company 082', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `order_types` (`order_type`, `order_desc`) VALUES
('001', '001'),
('100', '100'),
('102', '102'),
('300', '300'),
('400', '400'),
('660', '660'),
('663', '663'),
('700', '700'),
('800', '800'),
('999', '999');

INSERT INTO `sub_accounts` (`sub_account_code`, `sub_account_name`, `sub_account_table`) VALUES
('01', '??????? ???????', 'partners'),
('02', '??????? ???????', 'business_units'),
('03', '??????? ????????', 'assets');
INSERT INTO `currencies`(`id`, `currency_shrt_name`, `currency_name`, `currency_country`, `currency_unit`) VALUES
  (1,'MKD','Denar','Macedonia','1');
SET FOREIGN_KEY_CHECKS=1;
