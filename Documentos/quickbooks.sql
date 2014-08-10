-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2014 at 02:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quickbooks`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE DATABASE `quickbooks`;

USE `quickbooks`;

CREATE TABLE IF NOT EXISTS `account` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `AccountType` varchar(255) DEFAULT NULL,
  `DetailAccountType` varchar(255) DEFAULT NULL,
  `AccountNumber` varchar(255) DEFAULT NULL,
  `BankNumber` varchar(255) DEFAULT NULL,
  `LastCheckNumber` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Balance` decimal(15,5) DEFAULT NULL,
  `TotalBalance` decimal(15,5) DEFAULT NULL,
  `CashFlowClassification` varchar(255) DEFAULT NULL,
  `SpecialAccountType` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxAccount` varchar(255) DEFAULT NULL,
  `TaxLineID` int(11) DEFAULT NULL,
  `TaxLineInfo` varchar(255) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `accountIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `additionalcontactdetail`
--

CREATE TABLE IF NOT EXISTS `additionalcontactdetail` (
  `ContactName` varchar(255) DEFAULT NULL,
  `ContactValue` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `additionalcontactdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `additionalnotesdetail`
--

CREATE TABLE IF NOT EXISTS `additionalnotesdetail` (
  `NoteID` int(11) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `additionalnotesdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appliedtotxndetail`
--

CREATE TABLE IF NOT EXISTS `appliedtotxndetail` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BalanceRemaining` decimal(15,5) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `DiscountAmount` decimal(15,5) DEFAULT NULL,
  `DiscountAccountRef_ListID` varchar(255) DEFAULT NULL,
  `DiscountAccountRef_FullName` varchar(255) DEFAULT NULL,
  `DiscountClassRef_ListID` varchar(255) DEFAULT NULL,
  `DiscountClassRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `appliedtotxndetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `arrefundcreditcard`
--

CREATE TABLE IF NOT EXISTS `arrefundcreditcard` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `RefundFromAccountRef_ListID` varchar(255) DEFAULT NULL,
  `RefundFromAccountRef_FullName` varchar(255) DEFAULT NULL,
  `ARAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ARAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `Address_Addr1` varchar(255) DEFAULT NULL,
  `Address_Addr2` varchar(255) DEFAULT NULL,
  `Address_Addr3` varchar(255) DEFAULT NULL,
  `Address_Addr4` varchar(255) DEFAULT NULL,
  `Address_Addr5` varchar(255) DEFAULT NULL,
  `Address_City` varchar(255) DEFAULT NULL,
  `Address_State` varchar(255) DEFAULT NULL,
  `Address_PostalCode` varchar(255) DEFAULT NULL,
  `Address_Country` varchar(255) DEFAULT NULL,
  `Address_Note` varchar(255) DEFAULT NULL,
  `AddressBlock_Addr1` varchar(255) DEFAULT NULL,
  `AddressBlock_Addr2` varchar(255) DEFAULT NULL,
  `AddressBlock_Addr3` varchar(255) DEFAULT NULL,
  `AddressBlock_Addr4` varchar(255) DEFAULT NULL,
  `AddressBlock_Addr5` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CreditCardTxnInfo` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `arrefundcreditcardIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `VendorRef_ListID` varchar(255) DEFAULT NULL,
  `VendorRef_FullName` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr1` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr2` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr3` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr4` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr5` varchar(255) DEFAULT NULL,
  `VendorAddress_City` varchar(255) DEFAULT NULL,
  `VendorAddress_State` varchar(255) DEFAULT NULL,
  `VendorAddress_PostalCode` varchar(255) DEFAULT NULL,
  `VendorAddress_Country` varchar(255) DEFAULT NULL,
  `VendorAddress_Note` varchar(255) DEFAULT NULL,
  `APAccountRef_ListID` varchar(255) DEFAULT NULL,
  `APAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `AmountDue` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountDueInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `IsPaid` varchar(255) DEFAULT NULL,
  `OpenAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `billIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billingrate`
--

CREATE TABLE IF NOT EXISTS `billingrate` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BillingRateType` varchar(255) DEFAULT NULL,
  `FixedBillingRate` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `billingrateIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billingrateperitemdetail`
--

CREATE TABLE IF NOT EXISTS `billingrateperitemdetail` (
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `CustomRate` varchar(255) DEFAULT NULL,
  `CustomRatePercent` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `billingrateperitemdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billpaymentcheck`
--

CREATE TABLE IF NOT EXISTS `billpaymentcheck` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `APAccountRef_ListID` varchar(255) DEFAULT NULL,
  `APAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `BankAccountRef_ListID` varchar(255) DEFAULT NULL,
  `BankAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Address_Addr1` varchar(255) DEFAULT NULL,
  `Address_Addr2` varchar(255) DEFAULT NULL,
  `Address_Addr3` varchar(255) DEFAULT NULL,
  `Address_Addr4` varchar(255) DEFAULT NULL,
  `Address_Addr5` varchar(255) DEFAULT NULL,
  `Address_City` varchar(255) DEFAULT NULL,
  `Address_State` varchar(255) DEFAULT NULL,
  `Address_PostalCode` varchar(255) DEFAULT NULL,
  `Address_Country` varchar(255) DEFAULT NULL,
  `Address_Note` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `billpaymentcheckIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billpaymentcreditcard`
--

CREATE TABLE IF NOT EXISTS `billpaymentcreditcard` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `APAccountRef_ListID` varchar(255) DEFAULT NULL,
  `APAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `CreditCardAccountRef_ListID` varchar(255) DEFAULT NULL,
  `CreditCardAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `billpaymentcreditcardIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buildassembly`
--

CREATE TABLE IF NOT EXISTS `buildassembly` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `ItemInventoryAssemblyRef_ListID` varchar(255) DEFAULT NULL,
  `ItemInventoryAssemblyRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsPending` varchar(255) DEFAULT NULL,
  `QuantityToBuild` varchar(255) DEFAULT NULL,
  `QuantityCanBuild` varchar(255) DEFAULT NULL,
  `QuantityOnHand` varchar(255) DEFAULT NULL,
  `QuantityOnSalesOrder` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `buildassemblyIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cashbackinfodetail`
--

CREATE TABLE IF NOT EXISTS `cashbackinfodetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `cashbackinfodetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `BalanceRemaining` decimal(15,5) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `ARAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ARAccountRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `BilledDate` datetime DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `IsPaid` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `chargeIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `check`
--

CREATE TABLE IF NOT EXISTS `check` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Address_Addr1` varchar(255) DEFAULT NULL,
  `Address_Addr2` varchar(255) DEFAULT NULL,
  `Address_Addr3` varchar(255) DEFAULT NULL,
  `Address_Addr4` varchar(255) DEFAULT NULL,
  `Address_Addr5` varchar(255) DEFAULT NULL,
  `Address_City` varchar(255) DEFAULT NULL,
  `Address_State` varchar(255) DEFAULT NULL,
  `Address_PostalCode` varchar(255) DEFAULT NULL,
  `Address_Country` varchar(255) DEFAULT NULL,
  `Address_Note` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `classIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `IsSampleCompany` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `LegalCompanyName` varchar(255) DEFAULT NULL,
  `Address_Addr1` varchar(255) DEFAULT NULL,
  `Address_Addr2` varchar(255) DEFAULT NULL,
  `Address_Addr3` varchar(255) DEFAULT NULL,
  `Address_Addr4` varchar(255) DEFAULT NULL,
  `Address_Addr5` varchar(255) DEFAULT NULL,
  `Address_City` varchar(255) DEFAULT NULL,
  `Address_State` varchar(255) DEFAULT NULL,
  `Address_PostalCode` varchar(255) DEFAULT NULL,
  `Address_Country` varchar(255) DEFAULT NULL,
  `Address_Note` varchar(255) DEFAULT NULL,
  `LegalAddress_Addr1` varchar(255) DEFAULT NULL,
  `LegalAddress_Addr2` varchar(255) DEFAULT NULL,
  `LegalAddress_Addr3` varchar(255) DEFAULT NULL,
  `LegalAddress_Addr4` varchar(255) DEFAULT NULL,
  `LegalAddress_Addr5` varchar(255) DEFAULT NULL,
  `LegalAddress_City` varchar(255) DEFAULT NULL,
  `LegalAddress_State` varchar(255) DEFAULT NULL,
  `LegalAddress_PostalCode` varchar(255) DEFAULT NULL,
  `LegalAddress_Country` varchar(255) DEFAULT NULL,
  `LegalAddress_Note` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Addr1` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Addr2` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Addr3` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Addr4` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Addr5` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_City` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_State` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_PostalCode` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Country` varchar(255) DEFAULT NULL,
  `CompanyAddressForCustomer_Note` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CompanyEmailForCustomer` varchar(255) DEFAULT NULL,
  `CompanyWebSite` varchar(255) DEFAULT NULL,
  `FirstMonthFiscalYear` varchar(255) DEFAULT NULL,
  `FirstMonthIncomeTaxYear` varchar(255) DEFAULT NULL,
  `CompanyType` varchar(255) DEFAULT NULL,
  `EIN` varchar(255) DEFAULT NULL,
  `TaxForm` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `componentitemlinedetail`
--

CREATE TABLE IF NOT EXISTS `componentitemlinedetail` (
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `QuantityOnHand` varchar(255) DEFAULT NULL,
  `QuantityNeeded` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `componentitemlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactsdetail`
--

CREATE TABLE IF NOT EXISTS `contactsdetail` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Salutation` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `JobTitle` varchar(255) DEFAULT NULL,
  `AdditionalContactRef_ListID` varchar(255) DEFAULT NULL,
  `AdditionalContactRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `contactsdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditcardcharge`
--

CREATE TABLE IF NOT EXISTS `creditcardcharge` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `creditcardchargeIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditcardcredit`
--

CREATE TABLE IF NOT EXISTS `creditcardcredit` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `creditcardcreditIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditmemo`
--

CREATE TABLE IF NOT EXISTS `creditmemo` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ARAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ARAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `IsPending` varchar(255) DEFAULT NULL,
  `PONumber` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `ShipMethodRef_ListID` varchar(255) DEFAULT NULL,
  `ShipMethodRef_FullName` varchar(255) DEFAULT NULL,
  `Subtotal` decimal(15,5) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxPercentage` varchar(255) DEFAULT NULL,
  `SalesTaxTotal` decimal(15,5) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CreditRemaining` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `CreditRemainingInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_FullName` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `creditmemoIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditmemolinedetail`
--

CREATE TABLE IF NOT EXISTS `creditmemolinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `creditmemolinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditmemolinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `creditmemolinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `creditmemolinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `CurrencyCode` varchar(255) DEFAULT NULL,
  `ThousandSeparator` varchar(255) DEFAULT NULL,
  `ThousandSeparatorGrouping` varchar(255) DEFAULT NULL,
  `DecimalPlaces` varchar(255) DEFAULT NULL,
  `DecimalSeparator` varchar(255) DEFAULT NULL,
  `IsUserDefinedCurrency` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AsOfDate` datetime DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `currencyIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Salutation` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `PrintAs` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Pager` varchar(255) DEFAULT NULL,
  `AltPhone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Cc` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `AltContact` varchar(255) DEFAULT NULL,
  `CustomerTypeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerTypeRef_FullName` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `Balance` decimal(15,5) DEFAULT NULL,
  `TotalBalance` decimal(15,5) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCountry` varchar(255) DEFAULT NULL,
  `ResaleNumber` varchar(255) DEFAULT NULL,
  `AccountNumber` varchar(255) DEFAULT NULL,
  `CreditLimit` decimal(15,5) DEFAULT NULL,
  `PreferredPaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PreferredPaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `CreditCardNumber` varchar(255) DEFAULT NULL,
  `ExpirationMonth` int(11) DEFAULT NULL,
  `ExpirationYear` int(11) DEFAULT NULL,
  `NameOnCard` varchar(255) DEFAULT NULL,
  `CreditCardAddress` varchar(255) DEFAULT NULL,
  `CreditCardPostalCode` varchar(255) DEFAULT NULL,
  `JobStatus` varchar(255) DEFAULT NULL,
  `JobStartDate` datetime DEFAULT NULL,
  `JobProjectedEndDate` datetime DEFAULT NULL,
  `JobEndDate` datetime DEFAULT NULL,
  `JobDesc` varchar(255) DEFAULT NULL,
  `JobTypeRef_ListID` varchar(255) DEFAULT NULL,
  `JobTypeRef_FullName` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `PriceLevelRef_ListID` varchar(255) DEFAULT NULL,
  `PriceLevelRef_FullName` varchar(255) DEFAULT NULL,
  `TaxRegistrationNumber` varchar(255) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `IsStatementWithParent` varchar(255) DEFAULT NULL,
  `PreferredDeliveryMethod` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `customerIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customermsg`
--

CREATE TABLE IF NOT EXISTS `customermsg` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `customermsgIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customertype`
--

CREATE TABLE IF NOT EXISTS `customertype` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `customertypeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dataextdef`
--

CREATE TABLE IF NOT EXISTS `dataextdef` (
  `OwnerID` varchar(255) DEFAULT NULL,
  `DataExtID` int(11) DEFAULT NULL,
  `DataExtName` varchar(255) DEFAULT NULL,
  `DataExtType` varchar(255) DEFAULT NULL,
  `AssignToObject` varchar(255) DEFAULT NULL,
  `DataExtListRequire` varchar(255) DEFAULT NULL,
  `DataExtTxnRequire` varchar(255) DEFAULT NULL,
  `DataExtFormatString` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dataextdetail`
--

CREATE TABLE IF NOT EXISTS `dataextdetail` (
  `OwnerID` varchar(255) DEFAULT NULL,
  `DataExtName` varchar(255) DEFAULT NULL,
  `DataExtType` varchar(255) DEFAULT NULL,
  `DataExtValue` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  `OwnerType` varchar(255) DEFAULT NULL,
  KEY `dataextdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `datedriventerms`
--

CREATE TABLE IF NOT EXISTS `datedriventerms` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `DayOfMonthDue` int(11) DEFAULT NULL,
  `DueNextMonthDays` int(11) DEFAULT NULL,
  `DiscountDayOfMonth` int(11) DEFAULT NULL,
  `DiscountPct` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `datedriventermsIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `defaultunitdetail`
--

CREATE TABLE IF NOT EXISTS `defaultunitdetail` (
  `UnitUsedFor` varchar(255) DEFAULT NULL,
  `Unit` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `defaultunitdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `DepositToAccountRef_ListID` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `DepositTotal` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `DepositTotalInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `depositIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depositlinedetail`
--

CREATE TABLE IF NOT EXISTS `depositlinedetail` (
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnLineID` varchar(255) DEFAULT NULL,
  `PaymentTxnLineID` varchar(255) DEFAULT NULL,
  `EntityRef_ListID` varchar(255) DEFAULT NULL,
  `EntityRef_FullName` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CheckNumber` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `depositlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `earningsdetail`
--

CREATE TABLE IF NOT EXISTS `earningsdetail` (
  `PayrollItemWageRef_ListID` varchar(255) DEFAULT NULL,
  `PayrollItemWageRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `Salutation` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(255) DEFAULT NULL,
  `JobTitle` varchar(255) DEFAULT NULL,
  `SupervisorRef_ListID` varchar(255) DEFAULT NULL,
  `SupervisorRef_FullName` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `TargetBonus` decimal(15,5) DEFAULT NULL,
  `EmployeeAddress_Addr1` varchar(255) DEFAULT NULL,
  `EmployeeAddress_Addr2` varchar(255) DEFAULT NULL,
  `EmployeeAddress_Addr3` varchar(255) DEFAULT NULL,
  `EmployeeAddress_Addr4` varchar(255) DEFAULT NULL,
  `EmployeeAddress_City` varchar(255) DEFAULT NULL,
  `EmployeeAddress_State` varchar(255) DEFAULT NULL,
  `EmployeeAddress_PostalCode` varchar(255) DEFAULT NULL,
  `EmployeeAddress_Country` varchar(255) DEFAULT NULL,
  `PrintAs` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Pager` varchar(255) DEFAULT NULL,
  `PagerPIN` varchar(255) DEFAULT NULL,
  `AltPhone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `SSN` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `EmergencyContactPrimaryName` varchar(255) DEFAULT NULL,
  `EmergencyContactPrimaryValue` varchar(255) DEFAULT NULL,
  `EmergencyContactPrimaryRelation` varchar(255) DEFAULT NULL,
  `EmergencyContactSecondaryName` varchar(255) DEFAULT NULL,
  `EmergencyContactSecondaryValue` varchar(255) DEFAULT NULL,
  `EmergencyContactSecondaryRelation` varchar(255) DEFAULT NULL,
  `EmployeeType` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `PartOrFullTime` varchar(255) DEFAULT NULL,
  `Exempt` varchar(255) DEFAULT NULL,
  `KeyEmployee` varchar(255) DEFAULT NULL,
  `HiredDate` datetime DEFAULT NULL,
  `OriginalHireDate` datetime DEFAULT NULL,
  `AdjustedServiceDate` datetime DEFAULT NULL,
  `ReleasedDate` datetime DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `USCitizen` varchar(255) DEFAULT NULL,
  `Ethnicity` varchar(255) DEFAULT NULL,
  `Disabled` varchar(255) DEFAULT NULL,
  `DisabilityDesc` varchar(255) DEFAULT NULL,
  `OnFile` varchar(255) DEFAULT NULL,
  `WorkAuthExpireDate` datetime DEFAULT NULL,
  `USVeteran` varchar(255) DEFAULT NULL,
  `MilitaryStatus` varchar(255) DEFAULT NULL,
  `AccountNumber` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `BillingRateRef_ListID` varchar(255) DEFAULT NULL,
  `BillingRateRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `employeeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employeepayrollinfodetail`
--

CREATE TABLE IF NOT EXISTS `employeepayrollinfodetail` (
  `PayPeriod` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `IsUsingTimeDataToCreatePaychecks` varchar(255) DEFAULT NULL,
  `UseTimeDataToCreatePaychecks` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `employeepayrollinfodetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE IF NOT EXISTS `entity` (
  `ListID` varchar(200) DEFAULT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `TableName` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimate`
--

CREATE TABLE IF NOT EXISTS `estimate` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `PONumber` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `Subtotal` decimal(15,5) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxPercentage` varchar(255) DEFAULT NULL,
  `SalesTaxTotal` decimal(15,5) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_FullName` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `estimateIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimatelinedetail`
--

CREATE TABLE IF NOT EXISTS `estimatelinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `MarkupRate` varchar(255) DEFAULT NULL,
  `MarkupRatePercent` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `estimatelinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimatelinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `estimatelinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `estimatelinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fixedassetsalesinfodetail`
--

CREATE TABLE IF NOT EXISTS `fixedassetsalesinfodetail` (
  `SalesDesc` varchar(255) DEFAULT NULL,
  `SalesDate` datetime DEFAULT NULL,
  `SalesPrice` varchar(255) DEFAULT NULL,
  `SalesExpense` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `fixedassetsalesinfodetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `TableName` varchar(200) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `QBWFile` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryadjustment`
--

CREATE TABLE IF NOT EXISTS `inventoryadjustment` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `inventoryadjustmentIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryadjustmentlinedetail`
--

CREATE TABLE IF NOT EXISTS `inventoryadjustmentlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `QuantityDifference` varchar(255) DEFAULT NULL,
  `ValueDifference` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `inventoryadjustmentlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventorysite`
--

CREATE TABLE IF NOT EXISTS `inventorysite` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentSiteRef_ListID` varchar(255) DEFAULT NULL,
  `ParentSiteRef_FullName` varchar(255) DEFAULT NULL,
  `IsDefaultSite` varchar(255) DEFAULT NULL,
  `SiteDesc` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `SiteAddress_Addr1` varchar(255) DEFAULT NULL,
  `SiteAddress_Addr2` varchar(255) DEFAULT NULL,
  `SiteAddress_Addr3` varchar(255) DEFAULT NULL,
  `SiteAddress_Addr4` varchar(255) DEFAULT NULL,
  `SiteAddress_Addr5` varchar(255) DEFAULT NULL,
  `SiteAddress_City` varchar(255) DEFAULT NULL,
  `SiteAddress_State` varchar(255) DEFAULT NULL,
  `SiteAddress_PostalCode` varchar(255) DEFAULT NULL,
  `SiteAddress_Country` varchar(255) DEFAULT NULL,
  `SiteAddressBlock_Addr1` varchar(255) DEFAULT NULL,
  `SiteAddressBlock_Addr2` varchar(255) DEFAULT NULL,
  `SiteAddressBlock_Addr3` varchar(255) DEFAULT NULL,
  `SiteAddressBlock_Addr4` varchar(255) DEFAULT NULL,
  `SiteAddressBlock_Addr5` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `inventorysiteIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ARAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ARAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `IsPending` varchar(255) DEFAULT NULL,
  `IsFinanceCharge` varchar(255) DEFAULT NULL,
  `PONumber` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `ShipMethodRef_ListID` varchar(255) DEFAULT NULL,
  `ShipMethodRef_FullName` varchar(255) DEFAULT NULL,
  `Subtotal` decimal(15,5) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxPercentage` varchar(255) DEFAULT NULL,
  `SalesTaxTotal` decimal(15,5) DEFAULT NULL,
  `AppliedAmount` decimal(15,5) DEFAULT NULL,
  `BalanceRemaining` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `BalanceRemainingInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsPaid` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_FullName` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `SuggestedDiscountAmount` decimal(15,5) DEFAULT NULL,
  `SuggestedDiscountDate` datetime DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `invoiceIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicelinedetail`
--

CREATE TABLE IF NOT EXISTS `invoicelinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `LinkedTxnID` varchar(255) DEFAULT NULL,
  `LinkedTxnLineID` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `invoicelinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoicelinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `invoicelinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `invoicelinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemdiscount`
--

CREATE TABLE IF NOT EXISTS `itemdiscount` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `DiscountRate` varchar(255) DEFAULT NULL,
  `DiscountRatePercent` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemdiscountIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemfixedasset`
--

CREATE TABLE IF NOT EXISTS `itemfixedasset` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `AcquiredAs` varchar(255) DEFAULT NULL,
  `PurchaseDesc` varchar(255) DEFAULT NULL,
  `PurchaseDate` datetime DEFAULT NULL,
  `PurchaseCost` varchar(255) DEFAULT NULL,
  `VendorOrPayeeName` varchar(255) DEFAULT NULL,
  `AssetAccountRef_ListID` varchar(255) DEFAULT NULL,
  `AssetAccountRef_FullName` varchar(255) DEFAULT NULL,
  `AssetDesc` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `PONumber` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `WarrantyExpDate` datetime DEFAULT NULL,
  `Notes` longtext,
  `AssetNumber` varchar(255) DEFAULT NULL,
  `CostBasis` decimal(15,5) DEFAULT NULL,
  `YearEndAccumulatedDepreciation` decimal(15,5) DEFAULT NULL,
  `YearEndBookValue` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemfixedassetIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemgroup`
--

CREATE TABLE IF NOT EXISTS `itemgroup` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `SpecialItemType` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemgroupIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemgrouplinedetail`
--

CREATE TABLE IF NOT EXISTS `itemgrouplinedetail` (
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `itemgrouplinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iteminventory`
--

CREATE TABLE IF NOT EXISTS `iteminventory` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `ManufacturerPartNumber` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_ListID` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `SalesDesc` varchar(255) DEFAULT NULL,
  `SalesPrice` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_ListID` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PurchaseDesc` varchar(255) DEFAULT NULL,
  `PurchaseCost` varchar(255) DEFAULT NULL,
  `COGSAccountRef_ListID` varchar(255) DEFAULT NULL,
  `COGSAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PrefVendorRef_ListID` varchar(255) DEFAULT NULL,
  `PrefVendorRef_FullName` varchar(255) DEFAULT NULL,
  `AssetAccountRef_ListID` varchar(255) DEFAULT NULL,
  `AssetAccountRef_FullName` varchar(255) DEFAULT NULL,
  `ReorderPoint` varchar(255) DEFAULT NULL,
  `QuantityOnHand` varchar(255) DEFAULT NULL,
  `AverageCost` varchar(255) DEFAULT NULL,
  `QuantityOnOrder` varchar(255) DEFAULT NULL,
  `QuantityOnSalesOrder` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `iteminventoryIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iteminventoryassembly`
--

CREATE TABLE IF NOT EXISTS `iteminventoryassembly` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `UnitOfMeasureSetRef_ListID` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesDesc` varchar(255) DEFAULT NULL,
  `SalesPrice` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_ListID` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PurchaseDesc` varchar(255) DEFAULT NULL,
  `PurchaseCost` varchar(255) DEFAULT NULL,
  `PurchaseTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `PurchaseTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `COGSAccountRef_ListID` varchar(255) DEFAULT NULL,
  `COGSAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PrefVendorRef_ListID` varchar(255) DEFAULT NULL,
  `PrefVendorRef_FullName` varchar(255) DEFAULT NULL,
  `AssetAccountRef_ListID` varchar(255) DEFAULT NULL,
  `AssetAccountRef_FullName` varchar(255) DEFAULT NULL,
  `BuildPoint` varchar(255) DEFAULT NULL,
  `QuantityOnHand` varchar(255) DEFAULT NULL,
  `AverageCost` varchar(255) DEFAULT NULL,
  `QuantityOnOrder` varchar(255) DEFAULT NULL,
  `QuantityOnSalesOrder` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `iteminventoryassemblyIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iteminventoryassemblylinedetail`
--

CREATE TABLE IF NOT EXISTS `iteminventoryassemblylinedetail` (
  `ItemInventoryRef_ListID` varchar(255) DEFAULT NULL,
  `ItemInventoryRef_FullName` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `iteminventoryassemblylinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemnoninventory`
--

CREATE TABLE IF NOT EXISTS `itemnoninventory` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `ManufacturerPartNumber` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_ListID` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemnoninventoryIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemothercharge`
--

CREATE TABLE IF NOT EXISTS `itemothercharge` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `SpecialItemType` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemotherchargeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itempayment`
--

CREATE TABLE IF NOT EXISTS `itempayment` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_ListID` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itempaymentIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemreceipt`
--

CREATE TABLE IF NOT EXISTS `itemreceipt` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `VendorRef_ListID` varchar(255) DEFAULT NULL,
  `VendorRef_FullName` varchar(255) DEFAULT NULL,
  `APAccountRef_ListID` varchar(255) DEFAULT NULL,
  `APAccountRef_FullName` varchar(255) DEFAULT NULL,
  `LiabilityAccountRef_ListID` varchar(255) DEFAULT NULL,
  `LiabilityAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `LinkedTxn` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemreceiptIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemsalestax`
--

CREATE TABLE IF NOT EXISTS `itemsalestax` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `IsUsedOnPurchaseTransaction` varchar(255) DEFAULT NULL,
  `TaxRate` varchar(255) DEFAULT NULL,
  `TaxVendorRef_ListID` varchar(255) DEFAULT NULL,
  `TaxVendorRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemsalestaxIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemsalestaxgroup`
--

CREATE TABLE IF NOT EXISTS `itemsalestaxgroup` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemsalestaxgroupIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemsalestaxgrouplinedetail`
--

CREATE TABLE IF NOT EXISTS `itemsalestaxgrouplinedetail` (
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `itemsalestaxgrouplinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemservice`
--

CREATE TABLE IF NOT EXISTS `itemservice` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `UnitOfMeasureSetRef_ListID` varchar(255) DEFAULT NULL,
  `UnitOfMeasureSetRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemserviceIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemsites`
--

CREATE TABLE IF NOT EXISTS `itemsites` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `ItemInventoryAssemblyRef_ListID` varchar(255) DEFAULT NULL,
  `ItemInventoryAssemblyRef_FullName` varchar(255) DEFAULT NULL,
  `ItemInventoryRef_ListID` varchar(255) DEFAULT NULL,
  `ItemInventoryRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `ReorderLevel` varchar(255) DEFAULT NULL,
  `QuantityOnHand` varchar(255) DEFAULT NULL,
  `QuantityOnPurchaseOrders` varchar(255) DEFAULT NULL,
  `QuantityOnSalesOrders` varchar(255) DEFAULT NULL,
  `QuantityToBeBuiltByPendingBuildTxns` varchar(255) DEFAULT NULL,
  `QuantityRequiredByPendingBuildTxns` varchar(255) DEFAULT NULL,
  `QuantityOnPendingTransfers` varchar(255) DEFAULT NULL,
  `AssemblyBuildPoint` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemsitesIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `itemsubtotal`
--

CREATE TABLE IF NOT EXISTS `itemsubtotal` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `BarCodeValue` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ItemDesc` varchar(255) DEFAULT NULL,
  `SpecialItemType` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `itemsubtotalIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE IF NOT EXISTS `jobtype` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `jobtypeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journalcreditlinedetail`
--

CREATE TABLE IF NOT EXISTS `journalcreditlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsAdjustment` varchar(255) DEFAULT NULL,
  `EntityRef_ListID` varchar(255) DEFAULT NULL,
  `EntityRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `journalcreditlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journaldebitlinedetail`
--

CREATE TABLE IF NOT EXISTS `journaldebitlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `EntityRef_ListID` varchar(255) DEFAULT NULL,
  `EntityRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `journaldebitlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journalentry`
--

CREATE TABLE IF NOT EXISTS `journalentry` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `IsAdjustment` varchar(255) DEFAULT NULL,
  `IsHomeCurrencyAdjustment` varchar(255) DEFAULT NULL,
  `IsAmountsEnteredInHomeCurrency` varchar(255) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `TxnType` varchar(200) DEFAULT NULL,
  KEY `journalentryIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `linkedtxndetail`
--

CREATE TABLE IF NOT EXISTS `linkedtxndetail` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `LinkType` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `linkedtxndetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `othername`
--

CREATE TABLE IF NOT EXISTS `othername` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Salutation` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Suffix` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Addr1` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Addr2` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Addr3` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Addr4` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Addr5` varchar(255) DEFAULT NULL,
  `OtherNameAddress_City` varchar(255) DEFAULT NULL,
  `OtherNameAddress_State` varchar(255) DEFAULT NULL,
  `OtherNameAddress_PostalCode` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Country` varchar(255) DEFAULT NULL,
  `OtherNameAddress_Note` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Pager` varchar(255) DEFAULT NULL,
  `AltPhone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `AltContact` varchar(255) DEFAULT NULL,
  `AccountNumber` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `othernameIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE IF NOT EXISTS `paymentmethod` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `PaymentMethodType` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `paymentmethodIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payrollitemnonwage`
--

CREATE TABLE IF NOT EXISTS `payrollitemnonwage` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `NonWageType` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_FullName` varchar(255) DEFAULT NULL,
  `LiabilityAccountRef_ListID` varchar(255) DEFAULT NULL,
  `LiabilityAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `payrollitemnonwageIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payrollitemwage`
--

CREATE TABLE IF NOT EXISTS `payrollitemwage` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `WageType` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `payrollitemwageIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricelevel`
--

CREATE TABLE IF NOT EXISTS `pricelevel` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `PriceLevelType` varchar(255) DEFAULT NULL,
  `PriceLevelFixedPercentage` varchar(255) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `pricelevelIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pricelevelperitemdetail`
--

CREATE TABLE IF NOT EXISTS `pricelevelperitemdetail` (
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `CustomPrice` varchar(255) DEFAULT NULL,
  `CustomPricePercent` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `pricelevelperitemdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE IF NOT EXISTS `purchaseorder` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `VendorRef_ListID` varchar(255) DEFAULT NULL,
  `VendorRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `ShipToEntityRef_ListID` varchar(255) DEFAULT NULL,
  `ShipToEntityRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr1` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr2` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr3` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr4` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr5` varchar(255) DEFAULT NULL,
  `VendorAddress_City` varchar(255) DEFAULT NULL,
  `VendorAddress_State` varchar(255) DEFAULT NULL,
  `VendorAddress_PostalCode` varchar(255) DEFAULT NULL,
  `VendorAddress_Country` varchar(255) DEFAULT NULL,
  `VendorAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `ExpectedDate` datetime DEFAULT NULL,
  `ShipMethodRef_ListID` varchar(255) DEFAULT NULL,
  `ShipMethodRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `VendorMsg` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `IsManuallyClosed` varchar(255) DEFAULT NULL,
  `IsFullyReceived` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `purchaseorderIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderlinedetail`
--

CREATE TABLE IF NOT EXISTS `purchaseorderlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `ManufacturerPartNumber` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `ReceivedQuantity` varchar(255) DEFAULT NULL,
  `UnbilledQuantity` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `IsManuallyClosed` varchar(255) DEFAULT NULL,
  `IsBilled` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `purchaseorderlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorderlinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `purchaseorderlinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `purchaseorderlinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receivepayment`
--

CREATE TABLE IF NOT EXISTS `receivepayment` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ARAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ARAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `PaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_ListID` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_FullName` varchar(255) DEFAULT NULL,
  `UnusedPayment` decimal(15,5) DEFAULT NULL,
  `UnusedCredits` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `receivepaymentIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receivepaymenttodeposit`
--

CREATE TABLE IF NOT EXISTS `receivepaymenttodeposit` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnLineID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `refundappliedtotxndetail`
--

CREATE TABLE IF NOT EXISTS `refundappliedtotxndetail` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `CreditRemaining` decimal(15,5) DEFAULT NULL,
  `RefundAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `refundappliedtotxndetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relatedunitdetail`
--

CREATE TABLE IF NOT EXISTS `relatedunitdetail` (
  `Name` varchar(255) DEFAULT NULL,
  `Abbreviation` varchar(255) DEFAULT NULL,
  `ConversionRatio` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `relatedunitdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesandpurchasedetail`
--

CREATE TABLE IF NOT EXISTS `salesandpurchasedetail` (
  `SalesDesc` varchar(255) DEFAULT NULL,
  `SalesPrice` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_ListID` varchar(255) DEFAULT NULL,
  `IncomeAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PurchaseDesc` varchar(255) DEFAULT NULL,
  `PurchaseCost` varchar(255) DEFAULT NULL,
  `PurchaseTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `PurchaseTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_ListID` varchar(255) DEFAULT NULL,
  `ExpenseAccountRef_FullName` varchar(255) DEFAULT NULL,
  `PrefVendorRef_ListID` varchar(255) DEFAULT NULL,
  `PrefVendorRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesandpurchasedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesorder`
--

CREATE TABLE IF NOT EXISTS `salesorder` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `PONumber` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `ShipMethodRef_ListID` varchar(255) DEFAULT NULL,
  `ShipMethodRef_FullName` varchar(255) DEFAULT NULL,
  `Subtotal` decimal(15,5) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxPercentage` varchar(255) DEFAULT NULL,
  `SalesTaxTotal` decimal(15,5) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `IsManuallyClosed` varchar(255) DEFAULT NULL,
  `IsFullyInvoiced` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_FullName` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `LinkedTxn` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `salesorderIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesorderlinedetail`
--

CREATE TABLE IF NOT EXISTS `salesorderlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Invoiced` varchar(255) DEFAULT NULL,
  `IsManuallyClosed` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesorderlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesorderlinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `salesorderlinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesorderlinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesorpurchasedetail`
--

CREATE TABLE IF NOT EXISTS `salesorpurchasedetail` (
  `Description` varchar(255) DEFAULT NULL,
  `Price` varchar(255) DEFAULT NULL,
  `PricePercent` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesorpurchasedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesreceipt`
--

CREATE TABLE IF NOT EXISTS `salesreceipt` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `TemplateRef_ListID` varchar(255) DEFAULT NULL,
  `TemplateRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `BillAddress_Addr1` varchar(255) DEFAULT NULL,
  `BillAddress_Addr2` varchar(255) DEFAULT NULL,
  `BillAddress_Addr3` varchar(255) DEFAULT NULL,
  `BillAddress_Addr4` varchar(255) DEFAULT NULL,
  `BillAddress_Addr5` varchar(255) DEFAULT NULL,
  `BillAddress_City` varchar(255) DEFAULT NULL,
  `BillAddress_State` varchar(255) DEFAULT NULL,
  `BillAddress_PostalCode` varchar(255) DEFAULT NULL,
  `BillAddress_Country` varchar(255) DEFAULT NULL,
  `BillAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `IsPending` varchar(255) DEFAULT NULL,
  `CheckNumber` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_ListID` varchar(255) DEFAULT NULL,
  `PaymentMethodRef_FullName` varchar(255) DEFAULT NULL,
  `DueDate` datetime DEFAULT NULL,
  `SalesRepRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepRef_FullName` varchar(255) DEFAULT NULL,
  `ShipDate` datetime DEFAULT NULL,
  `ShipMethodRef_ListID` varchar(255) DEFAULT NULL,
  `ShipMethodRef_FullName` varchar(255) DEFAULT NULL,
  `FOB` varchar(255) DEFAULT NULL,
  `Subtotal` decimal(15,5) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxPercentage` varchar(255) DEFAULT NULL,
  `SalesTaxTotal` decimal(15,5) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `TotalAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerMsgRef_FullName` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `IsToBeEmailed` varchar(255) DEFAULT NULL,
  `IsTaxIncluded` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerSalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_ListID` varchar(255) DEFAULT NULL,
  `DepositToAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Other` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `salesreceiptIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesreceiptlinedetail`
--

CREATE TABLE IF NOT EXISTS `salesreceiptlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `RatePercent` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `Other1` varchar(255) DEFAULT NULL,
  `Other2` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesreceiptlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesreceiptlinegroupdetail`
--

CREATE TABLE IF NOT EXISTS `salesreceiptlinegroupdetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `IsPrintItemsInGroup` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `ServiceDate` datetime DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salesreceiptlinegroupdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesrep`
--

CREATE TABLE IF NOT EXISTS `salesrep` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Initial` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `SalesRepEntityRef_ListID` varchar(255) DEFAULT NULL,
  `SalesRepEntityRef_FullName` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `salesrepIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salestaxcode`
--

CREATE TABLE IF NOT EXISTS `salestaxcode` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `IsTaxable` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `ItemPurchaseTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemPurchaseTaxRef_FullName` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `salestaxcodeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salestaxpaymentcheck`
--

CREATE TABLE IF NOT EXISTS `salestaxpaymentcheck` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `PayeeEntityRef_ListID` varchar(255) DEFAULT NULL,
  `PayeeEntityRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `BankAccountRef_ListID` varchar(255) DEFAULT NULL,
  `BankAccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Address_Addr1` varchar(255) DEFAULT NULL,
  `Address_Addr2` varchar(255) DEFAULT NULL,
  `Address_Addr3` varchar(255) DEFAULT NULL,
  `Address_Addr4` varchar(255) DEFAULT NULL,
  `Address_Addr5` varchar(255) DEFAULT NULL,
  `Address_City` varchar(255) DEFAULT NULL,
  `Address_State` varchar(255) DEFAULT NULL,
  `Address_PostalCode` varchar(255) DEFAULT NULL,
  `Address_Country` varchar(255) DEFAULT NULL,
  `Address_Note` varchar(255) DEFAULT NULL,
  `IsToBePrinted` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `salestaxpaymentcheckIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salestaxpaymentchecklinedetail`
--

CREATE TABLE IF NOT EXISTS `salestaxpaymentchecklinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_ListID` varchar(255) DEFAULT NULL,
  `ItemSalesTaxRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `salestaxpaymentchecklinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipmethod`
--

CREATE TABLE IF NOT EXISTS `shipmethod` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `shipmethodIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shiptoaddressdetail`
--

CREATE TABLE IF NOT EXISTS `shiptoaddressdetail` (
  `Name` varchar(255) DEFAULT NULL,
  `Addr1` varchar(255) DEFAULT NULL,
  `Addr2` varchar(255) DEFAULT NULL,
  `Addr3` varchar(255) DEFAULT NULL,
  `Addr4` varchar(255) DEFAULT NULL,
  `Addr5` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `State` varchar(255) DEFAULT NULL,
  `PostalCode` varchar(255) DEFAULT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `DefaultShipTo` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `shiptoaddressdetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sickhoursdetail`
--

CREATE TABLE IF NOT EXISTS `sickhoursdetail` (
  `HoursAvailable` varchar(255) DEFAULT NULL,
  `AccrualPeriod` varchar(255) DEFAULT NULL,
  `HoursAccrued` varchar(255) DEFAULT NULL,
  `MaximumHours` varchar(255) DEFAULT NULL,
  `IsResettingHoursEachNewYear` varchar(255) DEFAULT NULL,
  `HoursUsed` varchar(255) DEFAULT NULL,
  `AccrualStartDate` datetime DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `standardterms`
--

CREATE TABLE IF NOT EXISTS `standardterms` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `StdDueDays` int(11) DEFAULT NULL,
  `StdDiscountDays` int(11) DEFAULT NULL,
  `DiscountPct` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `standardtermsIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `TemplateType` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `templateIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetracking`
--

CREATE TABLE IF NOT EXISTS `timetracking` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `EntityRef_ListID` varchar(255) DEFAULT NULL,
  `EntityRef_FullName` varchar(255) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ItemServiceRef_ListID` varchar(255) DEFAULT NULL,
  `ItemServiceRef_FullName` varchar(255) DEFAULT NULL,
  `Rate` varchar(255) DEFAULT NULL,
  `Duration` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `PayrollItemWageRef_ListID` varchar(255) DEFAULT NULL,
  `PayrollItemWageRef_FullName` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `IsBillable` varchar(255) DEFAULT NULL,
  `IsBilled` varchar(255) DEFAULT NULL,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `timetrackingIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE IF NOT EXISTS `todo` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `IsActive` varchar(255) DEFAULT NULL,
  `IsDone` varchar(255) DEFAULT NULL,
  `ReminderDate` datetime DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `todoIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnLineID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EntityRef_ListID` varchar(255) DEFAULT NULL,
  `EntityRef_FullName` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `AmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE IF NOT EXISTS `transfer` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `TransferFromAccountRef_ListID` varchar(255) DEFAULT NULL,
  `TransferFromAccountRef_FullName` varchar(255) DEFAULT NULL,
  `FromAccountBalance` decimal(15,5) DEFAULT NULL,
  `TransferToAccountRef_ListID` varchar(255) DEFAULT NULL,
  `TransferToAccountRef_FullName` varchar(255) DEFAULT NULL,
  `ToAccountBalance` decimal(15,5) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `transferIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transferinventory`
--

CREATE TABLE IF NOT EXISTS `transferinventory` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `FromInventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `FromInventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `ToInventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `ToInventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `ExternalGUID` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `transferinventoryIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transferinventorylinedetail`
--

CREATE TABLE IF NOT EXISTS `transferinventorylinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `FromInventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `FromInventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `ToInventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `ToInventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `QuantityTransferred` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `transferinventorylinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txnexpenselinedetail`
--

CREATE TABLE IF NOT EXISTS `txnexpenselinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `AccountRef_ListID` varchar(255) DEFAULT NULL,
  `AccountRef_FullName` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `txnexpenselinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txnitemgrouplinedetail`
--

CREATE TABLE IF NOT EXISTS `txnitemgrouplinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_ListID` varchar(255) DEFAULT NULL,
  `ItemGroupRef_FullName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `txnitemgrouplinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txnitemlinedetail`
--

CREATE TABLE IF NOT EXISTS `txnitemlinedetail` (
  `TxnLineID` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteRef_FullName` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_ListID` varchar(255) DEFAULT NULL,
  `InventorySiteLocationRef_FullName` varchar(255) DEFAULT NULL,
  `SerialNumber` varchar(255) DEFAULT NULL,
  `LotNumber` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Quantity` varchar(255) DEFAULT NULL,
  `UnitOfMeasure` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_ListID` varchar(255) DEFAULT NULL,
  `OverrideUOMSetRef_FullName` varchar(255) DEFAULT NULL,
  `Cost` varchar(255) DEFAULT NULL,
  `Amount` decimal(15,5) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `LinkedTxnID` varchar(255) DEFAULT NULL,
  `LinkedTxnLineID` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `txnitemlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `txnpaymentlinedetail`
--

CREATE TABLE IF NOT EXISTS `txnpaymentlinedetail` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TxnType` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `TotalAmount` decimal(15,5) DEFAULT NULL,
  `AppliedAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL,
  `GroupIDKEY` varchar(255) DEFAULT NULL,
  KEY `txnpaymentlinedetailID` (`IDKEY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unitofmeasureset`
--

CREATE TABLE IF NOT EXISTS `unitofmeasureset` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `UnitOfMeasureType` varchar(255) DEFAULT NULL,
  `BaseUnitName` varchar(255) DEFAULT NULL,
  `BaseUnitAbbreviation` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `unitofmeasuresetIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vacationhoursdetail`
--

CREATE TABLE IF NOT EXISTS `vacationhoursdetail` (
  `HoursAvailable` varchar(255) DEFAULT NULL,
  `AccrualPeriod` varchar(255) DEFAULT NULL,
  `HoursAccrued` varchar(255) DEFAULT NULL,
  `MaximumHours` varchar(255) DEFAULT NULL,
  `IsResettingHoursEachNewYear` varchar(255) DEFAULT NULL,
  `HoursUsed` varchar(255) DEFAULT NULL,
  `AccrualStartDate` datetime DEFAULT NULL,
  `IDKEY` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `vehicleIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehiclemileage`
--

CREATE TABLE IF NOT EXISTS `vehiclemileage` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `VehicleRef_ListID` varchar(255) DEFAULT NULL,
  `VehicleRef_FullName` varchar(255) DEFAULT NULL,
  `CustomerRef_ListID` varchar(255) DEFAULT NULL,
  `CustomerRef_FullName` varchar(255) DEFAULT NULL,
  `ItemRef_ListID` varchar(255) DEFAULT NULL,
  `ItemRef_FullName` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `TripStartDate` datetime DEFAULT NULL,
  `TripEndDate` datetime DEFAULT NULL,
  `OdometerStart` varchar(255) DEFAULT NULL,
  `OdometerEnd` varchar(255) DEFAULT NULL,
  `TotalMiles` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `BillableStatus` varchar(255) DEFAULT NULL,
  `StandardMileageRate` varchar(255) DEFAULT NULL,
  `StandardMileageTotalAmount` decimal(15,5) DEFAULT NULL,
  `BillableRate` varchar(255) DEFAULT NULL,
  `BillableAmount` decimal(15,5) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `vehiclemileageIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ClassRef_ListID` varchar(255) DEFAULT NULL,
  `ClassRef_FullName` varchar(255) DEFAULT NULL,
  `CompanyName` varchar(255) DEFAULT NULL,
  `Salutation` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `JobTitle` varchar(255) DEFAULT NULL,
  `Suffix` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr1` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr2` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr3` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr4` varchar(255) DEFAULT NULL,
  `VendorAddress_Addr5` varchar(255) DEFAULT NULL,
  `VendorAddress_City` varchar(255) DEFAULT NULL,
  `VendorAddress_State` varchar(255) DEFAULT NULL,
  `VendorAddress_PostalCode` varchar(255) DEFAULT NULL,
  `VendorAddress_Country` varchar(255) DEFAULT NULL,
  `VendorAddress_Note` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr1` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr2` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr3` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr4` varchar(255) DEFAULT NULL,
  `ShipAddress_Addr5` varchar(255) DEFAULT NULL,
  `ShipAddress_City` varchar(255) DEFAULT NULL,
  `ShipAddress_State` varchar(255) DEFAULT NULL,
  `ShipAddress_PostalCode` varchar(255) DEFAULT NULL,
  `ShipAddress_Country` varchar(255) DEFAULT NULL,
  `ShipAddress_Note` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `Pager` varchar(255) DEFAULT NULL,
  `AltPhone` varchar(255) DEFAULT NULL,
  `Fax` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Cc` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `AltContact` varchar(255) DEFAULT NULL,
  `NameOnCheck` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `AccountNumber` varchar(255) DEFAULT NULL,
  `VendorTypeRef_ListID` varchar(255) DEFAULT NULL,
  `VendorTypeRef_FullName` varchar(255) DEFAULT NULL,
  `TermsRef_ListID` varchar(255) DEFAULT NULL,
  `TermsRef_FullName` varchar(255) DEFAULT NULL,
  `CreditLimit` decimal(15,5) DEFAULT NULL,
  `VendorTaxIdent` varchar(255) DEFAULT NULL,
  `IsVendorEligibleFor1099` varchar(255) DEFAULT NULL,
  `Balance` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `BillingRateRef_ListID` varchar(255) DEFAULT NULL,
  `BillingRateRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxCodeRef_FullName` varchar(255) DEFAULT NULL,
  `SalesTaxCountry` varchar(255) DEFAULT NULL,
  `IsSalesTaxAgency` varchar(255) DEFAULT NULL,
  `SalesTaxReturnRef_ListID` varchar(255) DEFAULT NULL,
  `SalesTaxReturnRef_FullName` varchar(255) DEFAULT NULL,
  `TaxRegistrationNumber` varchar(255) DEFAULT NULL,
  `ReportingPeriod` varchar(255) DEFAULT NULL,
  `IsTaxTrackedOnPurchases` varchar(255) DEFAULT NULL,
  `TaxOnPurchasesAccountRef_ListID` varchar(255) DEFAULT NULL,
  `TaxOnPurchasesAccountRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxTrackedOnSales` varchar(255) DEFAULT NULL,
  `TaxOnSalesAccountRef_ListID` varchar(255) DEFAULT NULL,
  `TaxOnSalesAccountRef_FullName` varchar(255) DEFAULT NULL,
  `IsTaxOnTax` varchar(255) DEFAULT NULL,
  `PrefillAccountRef_ListID` varchar(255) DEFAULT NULL,
  `PrefillAccountRef_FullName` varchar(255) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `vendorIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendorcredit`
--

CREATE TABLE IF NOT EXISTS `vendorcredit` (
  `TxnID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `TxnNumber` int(11) DEFAULT NULL,
  `VendorRef_ListID` varchar(255) DEFAULT NULL,
  `VendorRef_FullName` varchar(255) DEFAULT NULL,
  `APAccountRef_ListID` varchar(255) DEFAULT NULL,
  `APAccountRef_FullName` varchar(255) DEFAULT NULL,
  `TxnDate` datetime DEFAULT NULL,
  `CreditAmount` decimal(15,5) DEFAULT NULL,
  `CurrencyRef_ListID` varchar(255) DEFAULT NULL,
  `CurrencyRef_FullName` varchar(255) DEFAULT NULL,
  `ExchangeRate` float DEFAULT NULL,
  `CreditAmountInHomeCurrency` decimal(15,5) DEFAULT NULL,
  `RefNumber` varchar(255) DEFAULT NULL,
  `Memo` varchar(255) DEFAULT NULL,
  `OpenAmount` decimal(15,5) DEFAULT NULL,
  `CustomField1` varchar(50) DEFAULT NULL,
  `CustomField2` varchar(50) DEFAULT NULL,
  `CustomField3` varchar(50) DEFAULT NULL,
  `CustomField4` varchar(50) DEFAULT NULL,
  `CustomField5` varchar(50) DEFAULT NULL,
  `CustomField6` varchar(50) DEFAULT NULL,
  `CustomField7` varchar(50) DEFAULT NULL,
  `CustomField8` varchar(50) DEFAULT NULL,
  `CustomField9` varchar(50) DEFAULT NULL,
  `CustomField10` varchar(50) DEFAULT NULL,
  `CustomField11` varchar(50) DEFAULT NULL,
  `CustomField12` varchar(50) DEFAULT NULL,
  `CustomField13` varchar(50) DEFAULT NULL,
  `CustomField14` varchar(50) DEFAULT NULL,
  `CustomField15` varchar(50) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `vendorcreditIdIndex` (`TxnID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendortype`
--

CREATE TABLE IF NOT EXISTS `vendortype` (
  `ListID` varchar(255) DEFAULT NULL,
  `TimeCreated` varchar(255) DEFAULT NULL,
  `TimeModified` varchar(255) DEFAULT NULL,
  `EditSequence` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `IsActive` varchar(255) DEFAULT NULL,
  `ParentRef_ListID` varchar(255) DEFAULT NULL,
  `ParentRef_FullName` varchar(255) DEFAULT NULL,
  `Sublevel` int(11) DEFAULT NULL,
  `Status` varchar(10) DEFAULT NULL,
  KEY `vendortypeIdIndex` (`ListID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
