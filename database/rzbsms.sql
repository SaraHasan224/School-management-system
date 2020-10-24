-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 03:06 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rzbsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigncourses`
--

CREATE TABLE `assigncourses` (
  `Id` int(255) NOT NULL,
  `AssignId` varchar(400) DEFAULT NULL,
  `EmployeeId` varchar(400) DEFAULT NULL,
  `ClassId` varchar(400) DEFAULT NULL,
  `SubjectId` varchar(400) DEFAULT NULL,
  `Day` varchar(200) DEFAULT NULL,
  `ClassTimeFrom` time DEFAULT NULL,
  `ClassTimeTo` time DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `Id` int(11) NOT NULL,
  `TeacherId` varchar(300) DEFAULT NULL,
  `AssignmentId` varchar(300) NOT NULL,
  `Assignment` varchar(300) DEFAULT NULL,
  `Subject` varchar(300) DEFAULT NULL,
  `Class` varchar(100) DEFAULT NULL,
  `Marks` varchar(200) DEFAULT NULL,
  `InsertDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `Id` int(255) NOT NULL,
  `ClassId` varchar(400) DEFAULT NULL,
  `ClassName` varchar(400) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`Id`, `ClassId`, `ClassName`, `IsActive`, `IsDeleted`) VALUES
(1, '287162542795', '1', 1, 0),
(2, '28748920877', '2', 1, 0),
(3, '7763037533', '3', 1, 0),
(4, '981760932863', '4', 1, 0),
(5, '8229159414', '5', 1, 0),
(6, '474993728811', '6', 1, 0),
(7, '29492211526', '7', 1, 0),
(8, '647806987830', '8', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `Id` int(11) NOT NULL,
  `CompanyName` varchar(200) DEFAULT NULL,
  `CompanyShortName` varchar(200) DEFAULT NULL,
  `CompanySlogan` varchar(200) DEFAULT NULL,
  `CompanyLogo` varchar(200) DEFAULT NULL,
  `CompanyAddress` varchar(200) DEFAULT NULL,
  `CompanyPhone` varchar(200) DEFAULT NULL,
  `CompanyEmail` varchar(200) DEFAULT NULL,
  `AfterDateDue` int(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`Id`, `CompanyName`, `CompanyShortName`, `CompanySlogan`, `CompanyLogo`, `CompanyAddress`, `CompanyPhone`, `CompanyEmail`, `AfterDateDue`) VALUES
(1, 'The Smart School Keamari Campus', 'SmartSchool', 'Be Innovative', 'schoollogo.jpg', 'JemsTech Dubai', '+6452356898', 'thesmartschool.keamaricampus@gmail.com', 250);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Id` int(11) NOT NULL,
  `EmployeeId` varchar(200) DEFAULT NULL,
  `EmployeeName` varchar(200) DEFAULT NULL,
  `Posting` varchar(200) DEFAULT NULL,
  `Password` varchar(500) DEFAULT NULL,
  `EmailAddress` varchar(200) DEFAULT NULL,
  `Designation` varchar(200) DEFAULT NULL,
  `PhoneNumber` varchar(200) DEFAULT NULL,
  `NationalIdentity` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Cv` varchar(200) DEFAULT NULL,
  `EmployeeDetails` varchar(200) DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `EmployeeImage` varchar(200) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventlist`
--

CREATE TABLE `eventlist` (
  `Id` int(11) NOT NULL,
  `EventId` varchar(200) DEFAULT NULL,
  `EventTitle` varchar(200) DEFAULT NULL,
  `EventDetails` varchar(200) DEFAULT NULL,
  `EventDate` date DEFAULT NULL,
  `UploadDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `examstimetable`
--

CREATE TABLE `examstimetable` (
  `Id` int(11) NOT NULL,
  `ExamId` varchar(200) DEFAULT NULL,
  `ClassId` varchar(200) DEFAULT NULL,
  `SubjectId` varchar(200) DEFAULT NULL,
  `ExamDate` date DEFAULT NULL,
  `ExamDateLimit` date DEFAULT NULL,
  `ExamTime` time DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fee`
--

CREATE TABLE `fee` (
  `Id` int(11) NOT NULL,
  `FeeId` varchar(200) DEFAULT NULL,
  `StudentId` varchar(200) DEFAULT NULL,
  `ClassId` varchar(200) DEFAULT NULL,
  `Month` varchar(200) DEFAULT NULL,
  `Year` varchar(200) DEFAULT NULL,
  `Fee` int(255) DEFAULT '0',
  `AmountPaid` int(255) DEFAULT '0',
  `Dues` int(255) DEFAULT '0',
  `Status` varchar(200) DEFAULT NULL,
  `Method` varchar(200) DEFAULT NULL,
  `Description` varchar(200) DEFAULT NULL,
  `AfterDueDate` varchar(200) DEFAULT NULL,
  `CreationDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `PaidDate` varchar(255) DEFAULT NULL,
  `BankRef` varchar(255) DEFAULT NULL,
  `UpdatedBy` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `Id` int(11) NOT NULL,
  `HolidayId` varchar(200) DEFAULT NULL,
  `HolidayTitle` varchar(200) DEFAULT NULL,
  `HolidayDetails` varchar(200) DEFAULT NULL,
  `HolidayDate` date DEFAULT NULL,
  `UploadDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `Id` int(255) NOT NULL,
  `InvoiceId` varchar(300) DEFAULT NULL,
  `InvoiceName` varchar(300) DEFAULT NULL,
  `Invoice` text,
  `Total` varchar(300) DEFAULT NULL,
  `OnCreate` date DEFAULT NULL,
  `OnUpdate` date DEFAULT NULL,
  `IsPaid` tinyint(1) DEFAULT '0',
  `Status` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobtype`
--

CREATE TABLE `jobtype` (
  `Id` int(11) NOT NULL,
  `JobTypeId` varchar(300) NOT NULL,
  `JobType` varchar(300) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0',
  `IsDescribed` tinyint(1) DEFAULT '0',
  `JobDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `Id` int(11) NOT NULL,
  `WordId` varchar(200) DEFAULT NULL,
  `English` varchar(200) DEFAULT NULL,
  `Urdu` text CHARACTER SET utf8
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`Id`, `WordId`, `English`, `Urdu`) VALUES
(1, '841344674', 'Doctor', 'ڈاکٹر'),
(2, '350285232', 'Patient', 'مریض'),
(3, '79183345', 'Staff', 'عملہ'),
(4, '72011066', 'Department', 'شعبہ'),
(5, '475114243', 'Appointment', 'تقرری'),
(6, '37114244', 'Doctor Shedule', 'ڈاکٹر شیڈول'),
(7, '17116886', 'Bed Manager', 'بستر مینیجر'),
(8, '101105295', 'Account Manager', 'اکاؤنٹ مینیجر'),
(9, '496963785', 'Insurance', 'انشورنس'),
(10, '37574716', 'Setting', 'ترتیب دیں'),
(11, '961975784', 'LogOut', 'لاگ آوٹ'),
(12, '924718668', 'Insert', 'اندراج'),
(13, '64222532', 'Language', 'زبان'),
(14, '43828219', 'Insert Doctor', 'ڈاکٹر کا اندراج'),
(15, '5357844', 'Insert Patient', 'مریض کا اندراج'),
(16, '233945502', 'Insert Staff', 'عملے کا اندراج'),
(17, '4144134', 'Insert Department', 'شعبہ کا اندراج'),
(18, '53673308', 'Insert Appointment', 'تقرری کا اندراج'),
(19, '221584939', 'Insert Shedule', 'شیڈول کے اندراج'),
(20, '385582856', 'Insert Bed', 'بستر کا اندراج'),
(21, '121519835', 'Insert Invoice', 'انوائس کی اندراج'),
(22, '198608123', 'Insert Bill', 'بل کا اندراج'),
(23, '175456340', 'Insert Insurance', 'انشورنس کا اندراج'),
(24, '687576125', 'Doctor List', 'ڈاکٹروں کی فہرست'),
(25, '470407438', 'Patient List', 'مریضوں کی فہرست'),
(26, '6359463', 'Staff List', 'عملے کی فہرست'),
(27, '161692597', 'Department List', 'محکموں کی فہرست'),
(28, '864944544', 'Appointment List', 'تقرری فہرست'),
(29, '980440407', 'Shedule List', 'شیڈول کی فہرست'),
(30, '674809664', 'Bed List', 'بستر کی فہرست'),
(31, '947416274', 'Invoice List', 'انوائس کی فہرست'),
(32, '680657131', 'Bill List', 'بل کی فہرست'),
(33, '857768284', 'Insurance List', 'انشورنس کی فہرست'),
(34, '817573705', 'Panel', 'پینل'),
(35, '459481850', 'Profile', 'پروفائل'),
(36, '441443666', 'Software Setting', 'سافٹ ویئر ترتیب دیں'),
(37, '585575892', 'English', 'انگریزی'),
(38, '765935518', 'Urdu', 'اردو'),
(39, '95882141', 'Assign Bed', 'تفویض بستر'),
(40, '960131267', 'Assign Bed List', 'تفویض بستر کی فہرست'),
(41, '543228704', 'Insert Patient Case Study', 'مریض کیس مطالعہ کی اندراج'),
(42, '319738473', 'Patient Case Study List', 'مریض کیس مطالعہ کی فہرست'),
(43, '488422302', 'Online', 'آن لائن'),
(44, '34916536', 'Main Navigation', 'مرکزی سمت شناسی'),
(45, '23218880', 'RZBHospital', 'آر ز بی  ہسپتال'),
(46, '374466422', 'Admin-LTE', 'ایڈمن-ایل ٹی ای'),
(47, '664544797', 'RZB', 'آر ز بی'),
(48, '365604252', 'Upload Image', 'تصویر اپ لوڈ کریں'),
(49, '10464206', 'Name', 'نام'),
(50, '5636521', 'Email', 'ای میل'),
(51, '601902624', 'Father Name', 'والد کا نام'),
(52, '874703700', 'Designation', 'عہدہ'),
(53, '446766856', 'Phone Number ', 'فون نمبر'),
(54, '313670785', 'Secondary Phone Number', 'ثانوی فون نمبر'),
(55, '754797348', 'National Identity', 'قومی شناخت'),
(56, '928600160', 'Years Of Experience', 'تجربات کے سال'),
(57, '959785327', 'Professional Degree', 'پروفیشنل ڈگری'),
(58, '681568653', 'Upload Cv', ' سی وی اپ لوڈ کریں '),
(59, '832515982', 'Speciality/Role', 'خاصیت / کردار'),
(60, '520335906', 'Doctor Date Of Birth', 'ڈاکٹر کی تاریخ  پیدائش'),
(61, '335483207', 'Password', 'پاس ورڈ'),
(62, '36679539', 'Confirm Password', 'پاس ورڈ کی توثیق کریں'),
(63, '960428838', 'Address', 'پتہ'),
(64, '318500860', 'Gender', 'صنف'),
(65, '161650560', 'Male', 'مرد'),
(66, '507856644', 'Female', 'عورت'),
(67, '294866799', 'Doctor Details', 'ڈاکٹر کی تفصیلات'),
(68, '859699460', 'SignIn', 'سائن ان کریں'),
(69, '603614168', 'List', 'فہرست'),
(70, '265513968', 'ID', 'آ ی ڈی'),
(71, '185219884', 'Doctor Name', 'ڈاکٹر کا نام'),
(72, '923287594', 'Doctor Id', 'ڈاکٹر آی ڈی'),
(73, '6014320', 'Status', 'حالت'),
(74, '145940955', 'Option', 'اختیار'),
(75, '512865537', 'Delete Doctor', 'ڈاکٹر حذف کریں'),
(76, '244350266', 'Close', 'بند کریں'),
(77, '283969862', 'Delete', 'حذف کریں'),
(78, '35305349', 'Do You Really Want to delete this?', 'کیا آپ واقعی یہ حذف کرنا چاہتے ہیں؟'),
(79, '989321697', 'Edit Doctor', 'ڈاکٹر کو ترمیم کریں'),
(80, '138911418', 'Activate', 'فعال'),
(81, '483809108', 'Disable', 'غیر فعال'),
(82, '27510284', 'Select Status', 'حیثیت کا انتخاب کریں'),
(83, '615972491', 'Edit', 'ترمیم'),
(84, '719583338', 'Secondary Phone', 'ثانوی فون'),
(85, '1000193137', 'Doctor Email', 'ڈاکٹر ای میل'),
(86, '91160807', 'Experience', 'تجربہ'),
(87, '717715466', 'Date Of Birth', 'پیدائش کی تاریخ'),
(88, '348719535', 'CV', 'سی وی'),
(89, '813668175', 'Download', 'ڈاؤن لوڈ کریں'),
(90, '523876298', 'Print', 'پرنٹ کریں'),
(92, '736144836', 'Marital Status', 'ازدواجی حیثیت'),
(93, '454312242', 'Single', 'سنگل'),
(94, '420961840', 'Married', 'شادی شدہ'),
(95, '752211147', 'Patient Type', 'مریض کی قسم'),
(96, '585490570', 'Indoor', 'اندر'),
(97, '697259574', 'Outdoor', 'بیرونی'),
(98, '124354135', 'Select Patient Type', 'مریض کی قسم منتخب کریں'),
(100, '8732081000', 'Patient Details', 'مریض کی تفصیلات'),
(101, '84579584', 'Select Marital Status', 'ازدواجی حیثیت کا انتخاب کریں'),
(102, '443768956', 'Patient Id', ' مریض آئی ڈی'),
(103, '704315458', 'Patient Name', 'مریض کا نام'),
(104, '624690871', 'Delete Patient', 'مریض کو حذف کریں'),
(105, '609129800', 'Update', 'اپ ڈیٹ'),
(106, '27206774', 'Edit Patient', 'مریض میں ترمیم کریں'),
(107, '98563099', 'Role', 'کردار'),
(108, '93321828', 'Select Staff Type', 'اسٹاف کی قسم منتخب کریں'),
(109, '60611362', 'Admin', 'ایڈمن'),
(110, '758771152', 'Nurse', 'نرس'),
(111, '579831133', 'Pharmacist', 'دوا ساز'),
(112, '572165656', 'Laboratorist', 'لیبارٹریسٹسٹ'),
(113, '125341517', 'Accounts', 'اکاؤنٹس'),
(114, '575404244', 'Security', 'سیکورٹی'),
(115, '717787842', 'Staff Details', 'اسٹاف کی تفصیلات'),
(116, '639756878', 'Staff Name', 'عملے کا نام'),
(117, '14336837', 'Staff Id', 'عملہ آئی ڈی '),
(118, '175895555', 'Edit Staff', 'عملے میں ترمیم کریں'),
(119, '163315753', 'Case Study', 'کیس کا مطالعہ'),
(120, '4146893', 'Insert Case Study', 'کیس مطالعہ کا اندراج'),
(121, '135388222', 'Tendency Bleed', 'رجحان بلیڈنگ'),
(122, '109411709', 'Food Allergies', 'کھانے کی الرجی'),
(123, '1985175', 'Heart Disease', 'مرض قلب'),
(124, '933311729', 'High Blood Pressure', 'بلند فشار خون'),
(125, '175132642', 'Surgery', 'سرجری'),
(126, '32529140', 'Diabetic', 'ذیابیطس'),
(127, '70584268', 'Accident', 'حادثہ'),
(128, '330746380', 'Others', 'دیگر'),
(129, '934627920', 'Current Madication', 'موجودہ دوا'),
(130, '282950112', 'Cancel', 'منسوخ کریں'),
(131, '44130652', 'Yes', 'جی ہاں'),
(132, '647346236', 'No', 'نہیں'),
(133, '760700733', 'Place Some Text Here', 'یہاں کچھ متن رکھیں'),
(134, '534135863', 'CaseStudy Id', 'کیس اسٹڈی آئی ڈی'),
(135, '260319562', 'Upload Date', 'اپ لوڈ کرنے کی تاریخ'),
(136, '143918393', 'CaseStudy List', 'کیس مطالعہ کی فہرست'),
(137, '709551713', 'Delete CaseStudy', 'کیس مطالعہ حذف کریں'),
(138, '68368410', 'CaseStudy Details', 'کیس مطالعہ کی تفصیلات'),
(139, '813565646', 'Edit CaseStudy', 'کیس مطالعہ میں ترمیم کریں'),
(140, '18298934', 'Department Name', 'شعبہ کا نام'),
(141, '797377664', 'Department Description', 'شعبہ تفصیل'),
(142, '35215312', 'Department Id', 'شعبہ آئی ڈی'),
(143, '355581535', 'Worker Count', 'مزدور شمار'),
(144, '874112389', 'Edit Department', 'شعبہ میں ترمیم کریں'),
(145, '689515985', 'Select Doctor', 'ڈاکٹر منتخب کریں'),
(146, '668111698', 'Appointment Date', 'تقرری  کی تاریخ'),
(147, '605650410', 'Problem', 'مسئلہ'),
(148, '445573428', 'Appointment Name', 'تقرر کا نام'),
(149, '92714697', 'IsCompleted', 'مکمل ہو گیا ہے'),
(150, '757865654', 'IsPaid', 'ادا کیا ہے'),
(151, '489327456', 'Delete Appointment', 'تقرری حذف کریں'),
(152, '47071828', 'Approove Appointment', 'تقرری پر غور کریں'),
(153, '186562929', 'Monday', 'پیر'),
(154, '374395592', 'Tuesday', 'منگل'),
(155, '107929655', 'Wednesday', 'بدھ'),
(156, '23866790', 'Thursday', 'جمعرات'),
(157, '953406878', 'Friday', 'جمعہ'),
(158, '508733348', 'Saturday', 'ہفتہ'),
(159, '103506143', 'Sunday', 'اتوار'),
(160, '861114173', 'Shedule', 'شیڈول'),
(161, '507143622', 'StartTime', 'وقت آغاز'),
(162, '226361704', 'EndTime', 'آخر وقت'),
(163, '490906818', 'OFF', 'بند'),
(164, '691467411', 'ON', 'کھولیں'),
(165, '506616942', 'Edit Shedule', 'شیڈول میں ترمیم کریں'),
(166, '434712574', 'Specialist', 'ماہر'),
(167, '930654832', 'Day', 'دن'),
(168, '211562135', 'Bed', 'بستر'),
(169, '31859495', 'Bed Number', 'بستر نمبر'),
(170, '545295380', 'Bed Type', 'بستر کی قسم'),
(171, '907498954', 'Bed Description', 'بستر کی تفصیل'),
(172, '734289831', 'Bed Id', 'بستر آئی ڈی'),
(173, '953214790', 'Description', 'تفصیل'),
(174, '581147576', 'Availability', 'دستیابی'),
(175, '285456317', 'Available', 'دستیاب'),
(177, '522439856', 'Delete Bed', 'بستر کو حذف کریں'),
(178, '639240967', 'UnAvailable', 'دستیاب نہیں'),
(179, '22665144', 'Select Availability', 'دستیابی کا انتخاب کریں'),
(180, '326757508', 'Assign', 'تفویض'),
(181, '62688503', 'Select Bed', 'بستر کا انتخاب کریں'),
(182, '68240199', 'Select Patient', 'مریض کو منتخب کریں'),
(183, '803145432', 'Assign Date', 'تفویض کی تاریخ'),
(184, '710492213', 'Assigned Date', 'مقرر کردہ تاریخ'),
(185, '124353400', 'Report', 'رپورٹ'),
(186, '831163609', 'Discharge', 'خارج'),
(187, '229127463', 'Edit Bed Assigned', 'بستر کو تفویض میں ترمیم کریں'),
(188, '8784094', 'InTreatment', 'زیر علاج'),
(189, '372391111', 'No Report', 'کوئی رپورٹ نہیں'),
(190, '844715289', 'Assigned Bed List', 'نامزد بستر کی فہرست'),
(191, '998600652', 'From', 'سے'),
(192, '689969862', 'Item', 'چیز'),
(193, '181632631', 'Price', 'قیمت'),
(194, '283791759', 'Quantity', 'مقدار'),
(195, '603865293', 'Subtotal', 'ذیلی کل'),
(196, '684888538', 'Payment Methods', 'ادائیگی کے طریقے'),
(197, '564993999', 'Total', 'کل'),
(198, '16480394', 'Invoice Name', 'انوائس نام'),
(199, '672301410', 'Due Date', 'واجب الادا تاریخ'),
(200, '951287365', 'Date', 'تاریخ'),
(201, '50856974', 'Invoice', 'انوائس'),
(202, '665382336', 'Invoice Id', 'انوائس آئی ڈی'),
(203, '726492197', 'Paid', 'ادائیگی کی'),
(204, '263625766', 'UnPaid', 'غیر ادا شدہ'),
(205, '589383648', 'Delete Invoice', 'انوائس کو حذف کریں'),
(206, '568504101', 'Edit Invoice', 'انوائس میں ترمیم کریں'),
(207, '845761222', 'Invoice Details', 'انوائس تفصیلات'),
(208, '695817679', 'Bill', 'بل'),
(209, '45445479', 'Insert Bill Fields', 'بل فیلڈ داخل کریں'),
(210, '560931987', 'Particular', 'خاص'),
(211, '61318676', 'Rate', 'بهاؤ'),
(212, '947845264', 'CheckItem', 'آئٹم چیک کریں'),
(213, '55264919', 'Particulars', 'خاص'),
(214, '931494', 'Submit Bill', 'بل جمع کرو'),
(215, '381977697', 'Bill Id', 'بل آئی ڈی'),
(216, '65254202', 'Bill Date', 'بل تاریخ'),
(217, '277409378', 'Delete Bill', 'بل حذف کریں'),
(218, '285551637', 'Bill Details', 'بل تفصیلات'),
(219, '712328690', 'Generate PDF', 'پی ڈی ایف بنائیں'),
(220, '46595635', 'Edit Bill', 'بل میں ترمیم کریں'),
(221, '857960569', 'Insurance Name', 'انشورنس کا نام'),
(222, '986108297', 'Discount', 'ڈسکاؤنٹ'),
(223, '44273950', 'Discount In Percentage', 'فی صد میں ڈسکاؤنٹ'),
(224, '348896403', 'Insurance Price', 'انشورنس قیمت'),
(225, '782192271', 'Select Validity', ' مدت کا انتخاب کریں'),
(226, '417137662', 'Monthly', 'ماہانہ'),
(227, '686369100', 'Quarterly', 'سہ ماہی'),
(228, '427169530', 'Insurance Details', 'انشورنس کی تفصیلات'),
(229, '877823409', 'Enable', 'فعال'),
(230, '565976995', 'Edit Insurance', 'انشورنس میں ترمیم کریں'),
(231, '935216967', 'Validity', 'توثیقی مدت'),
(232, '987405684', 'Yearly', 'سالانہ'),
(233, '691951547', 'Delete Insurance', 'انشورنس حذف کریں'),
(234, '874818231', 'Insurance Id', 'انشورنس آئی ڈی'),
(235, '91286530', 'Panel Name', 'پینل کا نام'),
(236, '188810127', 'Panel Details', 'پینل کی تفصیلات'),
(237, '805397689', 'Panel Id', 'پینل آئی ڈی '),
(238, '740872260', 'Panel List', 'پینل کی فہرست'),
(239, '198839916', 'Delete Panel', 'پینل کو حذف کریں'),
(240, '673879735', 'Edit Panel', 'پینل میں ترمیم کریں'),
(241, '686536804', 'Detail', 'تفصیل'),
(242, '395422506', 'Change Password', 'پاس ورڈ تبدیل کریں'),
(243, '825750906', 'Activity', 'سرگرمی'),
(244, '145227442', 'Old Password', 'پرانا پاسورڈ'),
(245, '584652730', 'New Password', 'نیا پاس ورڈ'),
(246, '469122290', 'I agree to the terms and conditions', 'میں شرائط و ضوابط سے اتفاق کرتا ہوں'),
(247, '9990286', 'Event', 'تقریب'),
(248, '528916393', 'Add Event', 'تقریب شامل کریں'),
(249, '205760829', 'Hospital Address', 'ہسپتال کا پتہ'),
(250, '662625999', 'Event Title', 'تقریب کا عنوان'),
(251, '145664649', 'Event Date', 'تقریب کی تاریخ'),
(252, '90992668', 'Event Detail', 'تقریب کی تفصیل'),
(253, '7041514', 'Insert Event', 'تقریب داخل کریں'),
(254, '878453179', 'Hospital Name', 'ہسپتال کا نام'),
(255, '178897730', 'HospitalNickName', 'ہسپتال مختصر نام'),
(256, '544142733', 'Hospital Slogan', 'ہسپتال کا نعرہ'),
(257, '54210630', 'Hospital Email', 'ہسپتال ای میل'),
(258, '927113342', 'Hospital Phone', 'ہسپتال فون'),
(259, '926255261', 'Insert Language', 'زبان داخل کریں'),
(260, '125944553', 'Live Healthy Stay Healthy', 'ت مند رہو صحت مند رہ'),
(261, '180304416', 'Dashboard', 'ڈیش بورڈ');

-- --------------------------------------------------------

--
-- Table structure for table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `Id` int(11) NOT NULL,
  `UserId` varchar(200) DEFAULT NULL,
  `SessionId` varchar(200) DEFAULT NULL,
  `LoginType` varchar(200) DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `LoginTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `LogoutTime` time DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promotelist`
--

CREATE TABLE `promotelist` (
  `Id` int(255) NOT NULL,
  `PromoteId` varchar(400) DEFAULT NULL,
  `ClassId` varchar(400) DEFAULT NULL,
  `StudentId` varchar(400) DEFAULT NULL,
  `InsertDate` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE `recruitment` (
  `Id` int(11) NOT NULL,
  `RecruitmentId` varchar(200) DEFAULT NULL,
  `CandidateName` varchar(200) DEFAULT NULL,
  `EmailAddress` varchar(200) DEFAULT NULL,
  `PhoneNumber` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Cv` varchar(500) DEFAULT NULL,
  `InterViewTime` time DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsSelected` tinyint(1) DEFAULT '0',
  `IsShortlisted` tinyint(1) DEFAULT '0',
  `IsInterview` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0',
  `IsHired` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Id` int(11) NOT NULL,
  `ScheduleId` varchar(200) DEFAULT NULL,
  `ScheduleTitle` varchar(200) DEFAULT NULL,
  `ScheduleDetails` varchar(200) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `UploadDate` date DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `Id` int(11) NOT NULL,
  `SchoolId` varchar(300) NOT NULL,
  `SchoolName` varchar(200) DEFAULT NULL,
  `SchoolLogo` varchar(300) DEFAULT NULL,
  `SchoolAddress` varchar(400) DEFAULT NULL,
  `SchoolType` varchar(100) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Id` int(11) NOT NULL,
  `StaffId` varchar(600) DEFAULT NULL,
  `StaffName` varchar(300) DEFAULT NULL,
  `FatherName` varchar(300) DEFAULT NULL,
  `StaffEmail` varchar(300) DEFAULT NULL,
  `Designation` varchar(300) DEFAULT NULL,
  `PhoneNumber` varchar(150) DEFAULT NULL,
  `NationalIdentity` varchar(150) DEFAULT NULL,
  `DepartmentId` varchar(150) DEFAULT NULL,
  `Experience` varchar(300) DEFAULT NULL,
  `ProfessionalDegree` varchar(300) DEFAULT NULL,
  `Gender` varchar(150) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Password` varchar(600) DEFAULT NULL,
  `StaffAddress` varchar(600) DEFAULT NULL,
  `Sallary` varchar(1500) DEFAULT NULL,
  `StaffDetails` text,
  `Cv` varchar(300) DEFAULT NULL,
  `StaffImage` varchar(300) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsLogin` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Id`, `StaffId`, `StaffName`, `FatherName`, `StaffEmail`, `Designation`, `PhoneNumber`, `NationalIdentity`, `DepartmentId`, `Experience`, `ProfessionalDegree`, `Gender`, `DateOfBirth`, `Password`, `StaffAddress`, `Sallary`, `StaffDetails`, `Cv`, `StaffImage`, `IsActive`, `IsLogin`, `IsDeleted`) VALUES
(1, '6570312268451214', 'Admin', 'AdminJemstech', 'Superadmin@jemstech.net', 'Admin', '0312268451', '42501556291564', '5698684387', '03/28/2019 - 03/28/2019', 'MSCS', 'Male', '0000-00-00', 'fdc13cf1926bfebe1d4a64325b350b6259e486899367a40beb70580054e2a02bf642eec5a77af8b0fcf853c2eab05af84638ba64123a0bdb88b08546b5835c54kTyE3pUu8sXUKB0/fAIrnyW5zdS7vQ==', 'Jemstech Solution Dubai Branch', '45000', NULL, 'Carnot.pdf', 'default.png', 1, 0, 0),
(2, '45003122514285782', 'JemsEmployee', 'JemsTech', 'accounts@jemstech.net', 'Accountant', '03122514285', '4250166235955', '5698684387', '03/27/2017 - 06/20/2019', 'MSCS', 'Male', '0000-00-00', '9a005717d81633086b401023d617bd10b89831e5214169bc20d1b277abf0285cb78e89b08c193297c8e612aa9b7e2902aa7ada294e93abc7de6e12d07024b328S49jdLFbb/CMI0GWLKj7DObpv+4wag==', 'JemsTech Dubai', '40000', 'Jemstech Employee', 'CallApiTechnical.docx', 'default1.png', 1, 0, 0),
(3, '50714296309', 'sunny', NULL, 'sunny@mail.com', 'accountant', '03122681827', NULL, NULL, NULL, NULL, NULL, NULL, '1d9f7b81ffa5344139c24fd0ef5805bf4140ef0d4a508599b880e78001405c510bcdccb524e7c4934ac5d1f89fabe38e8083a9b01edd49c7f3c8f50bbd757af7DMhoE+jvHuLkey+bVuenenOxS5ka/A==', NULL, NULL, NULL, NULL, NULL, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffrole`
--

CREATE TABLE `staffrole` (
  `Id` int(11) NOT NULL,
  `StaffId` varchar(200) NOT NULL,
  `StaffRole` varchar(100) DEFAULT NULL,
  `ManageSchool` tinyint(1) DEFAULT '0',
  `InsertClass` tinyint(1) DEFAULT '0',
  `InsertSubject` tinyint(1) DEFAULT '0',
  `InsertSyllabus` tinyint(1) DEFAULT '0',
  `ManageStudent` tinyint(1) DEFAULT '0',
  `InsertStudent` tinyint(1) DEFAULT '0',
  `StudentList` tinyint(1) DEFAULT '0',
  `TeachersList` tinyint(1) DEFAULT '0',
  `AssignedCourses` tinyint(1) DEFAULT '0',
  `ManageAccounts` tinyint(1) DEFAULT '0',
  `AddPayment` tinyint(1) DEFAULT '0',
  `StudentLedger` tinyint(1) DEFAULT '0',
  `BulkStudentPayment` tinyint(1) DEFAULT '0',
  `InsertInvoice` tinyint(1) DEFAULT '0',
  `InvoiceList` tinyint(1) DEFAULT '0',
  `ManageSchedule` tinyint(1) DEFAULT '0',
  `YearlyCalendar` tinyint(1) DEFAULT '0',
  `ExamsSchedule` tinyint(1) DEFAULT '0',
  `EmployeeList` tinyint(1) DEFAULT '0',
  `JobResponsibility` tinyint(1) DEFAULT '0',
  `Recruitment` tinyint(1) DEFAULT '0',
  `CandidatesInformation` tinyint(1) DEFAULT '0',
  `ShortlistedCandidates` tinyint(1) DEFAULT '0',
  `SelectedCandidates` tinyint(1) DEFAULT '0',
  `Users` tinyint(1) DEFAULT '0',
  `AllUsers` tinyint(1) DEFAULT '0',
  `AddUsers` tinyint(1) DEFAULT '0',
  `UsersRole` tinyint(1) DEFAULT '0',
  `Setting` tinyint(1) DEFAULT '0',
  `Profile` tinyint(1) DEFAULT '0',
  `SoftwareSetting` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffrole`
--

INSERT INTO `staffrole` (`Id`, `StaffId`, `StaffRole`, `ManageSchool`, `InsertClass`, `InsertSubject`, `InsertSyllabus`, `ManageStudent`, `InsertStudent`, `StudentList`, `TeachersList`, `AssignedCourses`, `ManageAccounts`, `AddPayment`, `StudentLedger`, `BulkStudentPayment`, `InsertInvoice`, `InvoiceList`, `ManageSchedule`, `YearlyCalendar`, `ExamsSchedule`, `EmployeeList`, `JobResponsibility`, `Recruitment`, `CandidatesInformation`, `ShortlistedCandidates`, `SelectedCandidates`, `Users`, `AllUsers`, `AddUsers`, `UsersRole`, `Setting`, `Profile`, `SoftwareSetting`) VALUES
(2, '45003122514285782', 'SuperAdmin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '50714296309', 'SuperAdmin', 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(1, '6570312268451214', 'SuperAdmin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentmarks`
--

CREATE TABLE `studentmarks` (
  `Id` int(255) NOT NULL,
  `MarksId` varchar(400) DEFAULT NULL,
  `StudentId` varchar(400) DEFAULT NULL,
  `TeacherId` varchar(400) DEFAULT NULL,
  `SubjectId` varchar(400) DEFAULT NULL,
  `ClassId` varchar(400) DEFAULT NULL,
  `FirstExam` varchar(400) DEFAULT '0',
  `SecondExam` varchar(400) DEFAULT '0',
  `ThirdExam` varchar(400) DEFAULT '0',
  `ExtraActivityMarks` varchar(400) DEFAULT '0',
  `InsertDate` date DEFAULT NULL,
  `Year` varchar(200) DEFAULT NULL,
  `Grade` varchar(200) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `Id` int(255) NOT NULL,
  `StudentId` varchar(400) DEFAULT NULL,
  `StudentName` varchar(400) DEFAULT NULL,
  `Password` varchar(400) DEFAULT NULL,
  `FatherName` varchar(400) DEFAULT NULL,
  `ClassId` varchar(400) DEFAULT NULL,
  `PhoneNumber` varchar(400) DEFAULT NULL,
  `StudentImage` varchar(500) DEFAULT NULL,
  `Document` varchar(500) DEFAULT NULL,
  `Religion` varchar(500) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `StudentGR` varchar(500) DEFAULT NULL,
  `Nationality` varchar(600) DEFAULT NULL,
  `childMedical` text,
  `FatherCNIC` varchar(500) DEFAULT NULL,
  `MotherName` varchar(500) DEFAULT NULL,
  `MotherCNIC` varchar(500) DEFAULT NULL,
  `FatherPhone` varchar(200) DEFAULT NULL,
  `FatherOccupation` varchar(200) DEFAULT NULL,
  `Gender` varchar(200) DEFAULT NULL,
  `MotherPhone` varchar(200) DEFAULT NULL,
  `MotherOccupation` varchar(200) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `Fee` varchar(400) DEFAULT NULL,
  `InsertDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentslog`
--

CREATE TABLE `studentslog` (
  `Id` int(255) NOT NULL,
  `SessionId` varchar(400) DEFAULT NULL,
  `StudentId` varchar(300) DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `LoginTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `LogoutTime` time DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Id` int(11) NOT NULL,
  `SubjectId` varchar(300) NOT NULL,
  `SubjectName` varchar(300) DEFAULT NULL,
  `ClassId` varchar(200) DEFAULT NULL,
  `InsertDate` date DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `Id` int(11) NOT NULL,
  `TeacherId` varchar(300) DEFAULT NULL,
  `SyllabusId` varchar(300) NOT NULL,
  `Syllabus` varchar(300) DEFAULT NULL,
  `Subject` varchar(300) DEFAULT NULL,
  `Class` varchar(100) DEFAULT NULL,
  `InsertDate` timestamp NULL DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '0',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacherloginlogs`
--

CREATE TABLE `teacherloginlogs` (
  `Id` int(255) NOT NULL,
  `SessionId` varchar(400) DEFAULT NULL,
  `TeacherId` varchar(300) DEFAULT NULL,
  `LoginDate` date DEFAULT NULL,
  `LoginTime` time DEFAULT NULL,
  `LogoutDate` date DEFAULT NULL,
  `LogoutTime` time DEFAULT NULL,
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploadassignment`
--

CREATE TABLE `uploadassignment` (
  `Id` int(255) NOT NULL,
  `UploadAssignmentId` varchar(400) DEFAULT NULL,
  `StudentId` varchar(400) DEFAULT NULL,
  `ClassId` varchar(500) DEFAULT NULL,
  `AssignmentId` varchar(400) DEFAULT NULL,
  `Assignment` varchar(400) DEFAULT NULL,
  `InsertDate` date DEFAULT NULL,
  `Marks` varchar(400) DEFAULT '0',
  `IsActive` tinyint(1) DEFAULT '1',
  `IsDeleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigncourses`
--
ALTER TABLE `assigncourses`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `eventlist`
--
ALTER TABLE `eventlist`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `examstimetable`
--
ALTER TABLE `examstimetable`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `fee`
--
ALTER TABLE `fee`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jobtype`
--
ALTER TABLE `jobtype`
  ADD PRIMARY KEY (`JobTypeId`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `loginlogs`
--
ALTER TABLE `loginlogs`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `promotelist`
--
ALTER TABLE `promotelist`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`SchoolId`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `staffrole`
--
ALTER TABLE `staffrole`
  ADD PRIMARY KEY (`StaffId`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `studentmarks`
--
ALTER TABLE `studentmarks`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `studentslog`
--
ALTER TABLE `studentslog`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SubjectId`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id` (`Id`);

--
-- Indexes for table `teacherloginlogs`
--
ALTER TABLE `teacherloginlogs`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `uploadassignment`
--
ALTER TABLE `uploadassignment`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigncourses`
--
ALTER TABLE `assigncourses`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventlist`
--
ALTER TABLE `eventlist`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `examstimetable`
--
ALTER TABLE `examstimetable`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fee`
--
ALTER TABLE `fee`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobtype`
--
ALTER TABLE `jobtype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT for table `loginlogs`
--
ALTER TABLE `loginlogs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `promotelist`
--
ALTER TABLE `promotelist`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recruitment`
--
ALTER TABLE `recruitment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staffrole`
--
ALTER TABLE `staffrole`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `studentmarks`
--
ALTER TABLE `studentmarks`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `studentslog`
--
ALTER TABLE `studentslog`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teacherloginlogs`
--
ALTER TABLE `teacherloginlogs`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uploadassignment`
--
ALTER TABLE `uploadassignment`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
