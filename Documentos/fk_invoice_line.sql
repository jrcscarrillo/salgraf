USE `quickbooks`;
ALTER TABLE `invoicelinedetail` ADD FOREIGN KEY (`IDKEY`)
REFERENCES `invoice`(TxnID);
