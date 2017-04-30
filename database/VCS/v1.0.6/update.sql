ALTER TABLE `cbl_main`.`contract` 
ADD COLUMN `report_number` INT(6) NULL DEFAULT 0 COMMENT '' AFTER `sub_contract_no`,
ADD COLUMN `cheque_no` VARCHAR(20) NULL DEFAULT 0 COMMENT '' AFTER `report_number`,
ADD COLUMN `invoice_number` VARCHAR(20) NULL DEFAULT 0 COMMENT '' AFTER `cheque_no`;
