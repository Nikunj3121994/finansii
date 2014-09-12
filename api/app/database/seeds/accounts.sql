-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2014 at 12:40 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account` varchar(10) NOT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `account_type` varchar(2) DEFAULT NULL,
  `sub_account_code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`account`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account`, `account_name`, `account_type`, `sub_account_code`) VALUES
('0', 'POBAR.ZA ZAPI[AN A NEUPL.KAP.I POST.S-VA', NULL, NULL),
('00', 'POBARUVAWA ZA ZAPI[AN, A NEUP. KAPITAL', NULL, NULL),
('000000', 'ZAPI[AN, A NEUPLATEN KAPITAL-OB.AKCII', NULL, NULL),
('001000', 'ZAPI[AN, A NEUPLATEN KAPITAL-POVL.AKCII', NULL, NULL),
('002000', 'ZAPI[AN, A NEUPL. KAPITAL OD OSN.VLOG', NULL, NULL),
('003000', 'OSTANATI VIDOVI ZAPI[AN, A NEUPL. KAPIT.', NULL, NULL),
('01', 'NEMATERIJALNI SREDSTVA', 'D', '03'),
('010000', 'ZEMJI[TA', 'D', '03'),
('011000', 'GRADE@NI OBJEKTI', 'D', '03'),
('012000', 'POSTROJKI I OPREMA', 'D', '03'),
('013000', 'ALAT POG I KANC INV MEB I TRANSP S-VA', 'D', '03'),
('014000', 'ZA[TITNI ZNACI I SLI^NI PRAVA', 'D', '03'),
('015000', 'NEMATERIJALNI VLO@UVAWA VO PODGOTOVKA', 'D', '03'),
('016000', 'AVANSI ZA NEMATERIJALNI SREDSTVA', 'D', '03'),
('017000', 'OSTANATI NEMATERIJALNI SREDSTVA', 'D', '03'),
('018000', 'VRED.USOGL.NA NEMAT.S-VA(REVALORIZACIJA)', 'D', '03'),
('019000', 'AKUMULIRANA AMORT. NA NEMAT.SREDSTVA', 'D', '03'),
('02', 'MATERIJALNI SREDSTVA', 'D', '03'),
('020000', 'ZEMJI[TA I [UMI', 'D', '03'),
('021000', 'GRADE@NI OBJEKTI', 'D', '03'),
('021001', 'OBJEKTI ZA SMESTUVAWE NA STOKI', 'D', '03'),
('022000', 'POSTROJKI I OPREMA', 'D', '03'),
('022001', 'OPR ZA ZAGR VENT  I ODR@UVAWE', 'D', '03'),
('022002', 'OPREMA ZA TRGOV REG KASI VAGI RAZL UREDI', 'D', '03'),
('022003', 'KANCALAR I POGONSKI MEBEL', 'D', '03'),
('022004', 'ELEKTRONSKI SMETA^I', 'D', '03'),
('022005', 'KANC I DRUG MEBEL ZA KANCALAR.RABOTI', 'D', '03'),
('022006', 'OPREMA ZA PROIZVODSTVO', 'D', '03'),
('022007', 'OPREMA ZA SOOBRA]AJ I VRSKI', 'D', '03'),
('023000', 'ALAT,POGON.I KANC.INV.MEBEL I TRAN.S-VA', 'D', '03'),
('024000', 'POVE]EGODI[NI NASADI I OSNOVNO STADO', 'D', '03'),
('025000', 'MATERIJALNI SREDSTVA VO PODGOTOVKA', 'D', '03'),
('026000', 'AVANSI ZA MATERIJALNI SREDSTVA', 'D', '03'),
('027000', 'OSTANATI MATERIJALNI SREDSTVA', 'D', '03'),
('028000', 'VRED. USOGLASUV.NA MAT.S-VA(REVALORIZAC)', 'D', '03'),
('029001', 'AKUM AMORT ZA OPREMA VO TRGOVIJA', 'P', '03'),
('029002', 'AKUMULIRANA AMORTIZACIJA NA GRAD.OBJEKTI', 'P', '03'),
('029003', 'AKUM AMORT NA ELEK SMETA^I', 'P', '03'),
('029004', 'AKUM AMORT NA KANC I POG MEBEL', 'P', '03'),
('029005', 'AKUMULIRANA AMORTIZACIJA NA OPREMA', 'P', '03'),
('029006', 'AKUM AMORT ZA MEBEL MA[ ZA PI[UVAWE', 'P', '03'),
('029007', 'AKUM AM ZA OPREMA ZA PROIZVODSTVO', 'P', '03'),
('029008', 'AKUM AM NA SRED ZA TRANSPORT I VRSKI', 'P', '03'),
('029200', 'AKUMUL.AMORTIZ.NA GRADE@NI OBJEKTI', 'P', '03'),
('029300', 'AKUMUL.AMORTIZ. NA OPREMA VO TRGOVIJA', 'P', '03'),
('029400', 'AKUMULIRANA AMORTIZACIJA NA OPREMA', 'P', '03'),
('04', 'DOLGORO^NI FINANSISKI VLO@UVAWA', NULL, NULL),
('040000', 'VLO@UV.(VO AKC.ILI UDELI)VO POVRZ.SUBJEK', NULL, NULL),
('041000', 'ZAEMI ZA POVRZANI SUBJEKTI', NULL, NULL),
('042000', 'ZAEMI SO KOI SUBJ.E POVR.VRZ OSN.NA U^ES', NULL, NULL),
('043000', 'U^ESTVO VO VLO@UVAWA(PARTICIPACII)', NULL, NULL),
('044000', 'VLO@UVAWA VO HARTII OD VREDNOST', NULL, NULL),
('045000', 'DODADENI KREDITI, DEPOZITI I KAUCII', NULL, NULL),
('046000', 'ZADOL@ITELNI DOLGORO^NI VLO@UVAWA', NULL, NULL),
('047000', 'OTKUPENI SOPSTVENI AKCII', NULL, NULL),
('048000', 'OSTANATI DOLGORO^NI VLO@UVAWA', NULL, NULL),
('049000', 'VREDNOS.USOGLASUV.NA DOLG.FIN.VLO@UVAWA', NULL, NULL),
('1', 'PAR.S-VA,HART.OD VRED.KRAT.POBAR. I AVR', NULL, NULL),
('10', 'PARI^NI SREDSTVA', NULL, NULL),
('100000', '@IRO SMETKA', 'D', NULL),
('100001', '@IRO SMETKA', 'D', NULL),
('100002', '@IRO SMETKA INVESTBANKA', 'D', NULL),
('100900', '@IRO SMETKA PREODNA SMETKA', 'D', NULL),
('101000', 'IZDVOENI PARI^NI SREDSTVA I AKREDITIVI', 'D', '01'),
('102000', 'BLAGAJNA', 'D', NULL),
('103000', 'DEVIZNI SMETKI', 'D', '01'),
('104000', 'DEVIZNI AKREDITIVI', 'D', '01'),
('105000', 'DEVIZNA BLAGAJNA', 'D', '01'),
('107000', 'OSTANATI PARI^NI SREDSTVA', 'D', '01'),
('11', 'HARTII OD VREDNOST', NULL, NULL),
('110000', '^EKOVI', NULL, NULL),
('111000', 'MENICI', NULL, NULL),
('112000', 'OBVRZNICI', NULL, NULL),
('113000', 'ZAPISI', NULL, NULL),
('117000', 'OSTANATI HARTII OD VREDNOST', NULL, NULL),
('119000', 'VRED.USOGLASUVAWE NA HARTIITE OD VREDN.', NULL, NULL),
('12', 'POBARUVAWA OD KUPUVA^ITE', 'D', '01'),
('120000', 'POBARUVAWE OD KUPUVA^ITE VO ZEMJATA', 'D', '01'),
('121000', 'POBARUVAWA OD KUPUVA^ITE VO STRANSTVO', 'D', '01'),
('129000', 'VRED.USOGLASUVAWE NA POBAR.OD KUPUVA^ITE', 'D', '01'),
('130000', 'DANOK NA DODADENA VREDNOST', NULL, NULL),
('130005', 'DANOK NA DDV 5 %', NULL, NULL),
('130018', 'DANOK NA DDV 18%', NULL, NULL),
('131000', 'POBARUVAWE ZA POVE[E PLATENI AKCIZI', NULL, '01'),
('137000', 'POBARUVAWA ZA REGRES SUBVENCII PREMII', NULL, '01'),
('138000', 'OSTANATI POBAR OD DR@ ORGANI', NULL, '01'),
('14', 'POBARUVAWA OD POVRZANI SUBJEKTI', NULL, '01'),
('140000', 'POBARUVAWA OD VRABOTENITE', NULL, '01'),
('143000', 'POBARUV. ODVRAB ZA AKONT ZA SLU@ PAT', NULL, '01'),
('145000', 'OSTANATI POBARUVAWA OD VRABOTENITE', NULL, '01'),
('149000', 'VRED.USOGLAS.NA POBAR.OD VRABOTENITE', NULL, NULL),
('150', 'OSTANATI POBARUVAWA', NULL, NULL),
('150000', 'VLO@UVAWA(VO AKC.ILI UDELI)VO POVR.SUBJE', NULL, NULL),
('151000', 'ZAEMI NA POVRZANI SUBJEKTI', NULL, NULL),
('152000', 'VLO@UVAWA VO HARTII OD VREDNOST ZA TRGUV', NULL, NULL),
('153000', 'DADENI KREDITI, DEPOZITI I KAUCII', 'D', '01'),
('154000', 'OTKUPENI SOPSTVENI AKCII', NULL, NULL),
('157000', 'OSTANATI KRATKOR.FINANSISKI VLO@UVAWA', NULL, NULL),
('159000', 'VRED.USOGLAS.NA KRATK.FIN.VLO@UVAWA', NULL, NULL),
('16', 'POBARUVAWA OD DR@AVATA I DR.INSTITUCII', NULL, NULL),
('160000', 'DANOK NA DODADENA VREDNOST', 'D', '01'),
('160005', 'PRETHODEN DANOK PO VLEZNI F-RI PO 5%', 'D', NULL),
('160018', 'PRETHODEN DANOK PO VLEZNI F-RI PO 18%', 'D', NULL),
('160019', 'PRETHODEN DANOK PO VLEZNI F-RI PO 19%', 'D', NULL),
('160700', 'POB,ZA RAZLIKA  NA POGOLEM PRETH DDV', 'D', NULL),
('161000', 'POBARUVAWA ZA POVEKE PLATENI AKCIZI', NULL, NULL),
('162000', 'POB.ZA POVE]E PL.DANOCI I PRID.OD PLATI', NULL, NULL),
('163000', 'POB.ZA POVE]E PLAT.DANOCI I PRID.OD DOBI', NULL, NULL),
('164000', 'POB.ZA POVE]E PLAT.CARINI I CAR.DAVA^KI', NULL, NULL),
('167000', 'POB.OD DR@.I DR.INSTIT.PO OSNOV OST.DAVA', NULL, NULL),
('169000', 'VRED.USOGL.NA POBAR.OD DR@AV.I DR.INSTIT', NULL, NULL),
('17', 'POBARUVAWA OD VRABT.I OSTANATI POBARUVAW', 'D', '01'),
('170000', 'POBAR.OD VRAB.ZA POVE]E ISPLATENI PLATI', 'D', '01'),
('171000', 'POBAR.OD VRAB.ZA AKONTACII ZA SL.PATUVAW', 'D', '01'),
('172000', 'POBAR.OD VRAB.ZA NADOMEST NA [TETA', 'D', '01'),
('173000', 'POBAR.OD VRABOT.ZA KUSOCI NA SREDSTVA', 'D', '01'),
('174000', 'POBAR.OD SOPSTV.NA DEL.ZA ISPL.OD DOBIVK', 'D', '01'),
('177000', 'OST.POB.OD VRAB.I OSTAN.NESP.KR.POBARUVA', 'D', '01'),
('179000', 'VRED.USOG.NA POB.OD VRAB.I OST.KR.POBARU', NULL, NULL),
('19', 'PL.TRO[.ZA IDNITE PERIODI I NEDOS.NAPL.', NULL, NULL),
('190000', 'ODNAPRED PLATENI TRO[OCI', 'D', '00'),
('191000', 'TRO[OCI [TO SE RAZGRANI^.NA POVE]E GOD.', 'D', '00'),
('192000', 'PRESM.PRIH.[TO NE MO@ELE DA BIDAT FAKTUR', 'D', '00'),
('194000', 'PLATENI ZAVISNI TRO[OCI ZA NABAVKA', 'D', NULL),
('197000', 'OST.PLAT.TRO[.ZA IDN.PER.I NEDOST.NAPLAT', 'D', NULL),
('2', 'OBRSKI,DOL.REZ.ZA TRO[.I RIZ. I ODL.PLA]', 'P', NULL),
('21', 'KRAT.OBVRS.PO OSNOV NA HARTII OD VREDNOS', NULL, NULL),
('210000', 'OBRSKI ZA IZDADENI ^EKOVI', NULL, NULL),
('211000', 'OBVRSKI ZA IZDADENI MENICI', NULL, NULL),
('217', 'OBVRSKI ZA IZDADENI DR.HARTII OD VREDNOS', NULL, NULL),
('22', 'KRAT.OBV.SPREMA DOB.IOBV.ZA AVAN.DEP.I K', 'P', '01'),
('220000', 'OBVRSKI SPREMA DOBAVUVA^ITE VO ZEMJATA', 'P', '01'),
('220001', 'OBRVSKI SPREMA DOBAVUVA^I FIZI^KI LICA', 'P', '01'),
('221000', 'OBVRSKI SPREMA DOBAVUVA^I VO STRANSTVO', 'P', '01'),
('222000', 'OBR. SPREMA DOB.ZA NEFAKT.STOKI,MAT.I US', 'P', '01'),
('223000', 'KRATKORO^NI OBVRSKI ZA POZAJMICI', 'P', '01'),
('224000', 'PRIMENI KRATKORO^NI DEPOZITI I KAUCII', 'P', '01'),
('230000', 'OBVVRSKI ZA DDV', 'P', '00'),
('230005', 'OBVRSKI ZA DDV 5%', 'P', '00'),
('230015', 'DDV PO OSNOV DONACII', 'P', '02'),
('230018', 'OBVRSKI ZA DDV 18%', 'P', '00'),
('231000', 'OBVRSKI ZA AKCIZI', 'P', '00'),
('232000', 'OBVRSKI ZA CARINI', 'P', '00'),
('233000', 'OBVRSKI ZA DANOK OD DOBIVKA', 'P', '00'),
('234000', 'OBVRSKI ZA DANOCI I PRIDONESI OD PLATA', 'P', '00'),
('234001', 'PRIDONES ZA PIOM', 'P', '00'),
('234002', 'PRIDONES ZA ZDRASTVO', 'P', '00'),
('234003', 'PRIDONES ZA VRABOTUVAWE', 'P', '00'),
('234004', 'DOPOLNITELNO ZDRASTVO', 'P', '00'),
('234005', 'OBVRSKI ZA DANOK  OD PLATA', 'P', '00'),
('235000', 'OBVRSKI ZAPERSONALEN DANOK OD DOHOD', 'P', '00'),
('236000', 'OBVRSKI ZA DANOK NA IMOT', 'P', '00'),
('24', 'KRAT.OBV.SPREMA POVR.SUB.I PO OS.U^EST', 'P', '01'),
('240000', 'OBVRSKI ZA PLATA I NASOMESTOCI ZA PLATA', 'P', '00'),
('240001', 'NETO PLATA', 'P', '00'),
('240002', NULL, NULL, NULL),
('242000', 'OBVRSKI SPREMA UVOZNIK', 'P', '01'),
('243', 'OBVRSKI PO OSNOV NA IZVOZ NA TU\\A STOKA', 'P', '01'),
('244000', 'OBV.PO OSNOV NA KOMIS.I KONS.PRODA@BA', 'P', '01'),
('245000', 'OSTANATI KRATK.OBV.OD POVRZ.SUBJEKTI', 'P', '01'),
('246000', 'OBV.SPR.SUB.VO KOI SUB E POV.PO OSN.VLO@', 'P', '01'),
('247000', 'OBVRSKI PO OSNOV NA U^ESTVO VO REZULTAT.', 'P', '01'),
('249000', 'OST.KRATK.OBV.PO OSNOV NA U^ES. VO VLO@.', 'P', '01'),
('25', 'KRATKORO^NI OBV.PO OSN.NA ZAEMI I KREDIT', 'P', '02'),
('250000', 'KRAT.OBV.PO OSNOV ZAEMI I KRED. VO ZEMJ.', 'P', '02'),
('251000', 'KRAT.OBV.PO OSN.NA ZAEMI I KRED.VO STRAN', 'P', '02'),
('252000', 'KREDITI OD BANKA VO ZEMJATA', 'P', '01'),
('257000', 'OSTAN.KRAT.OBV.PO OSN.ZAEMI I KREDITI', 'P', '01'),
('26', 'KRATKORO^NI FINANSISKI SREDSTVA', 'P', '02'),
('260000', 'OBVRSKI ZA DANOK NA DODADENA VREDNOST', 'P', '02'),
('260005', 'OBVRSKI ZA DDV 5%', 'P', '02'),
('260016', 'DDV PO OSNOV NA DONACII', 'P', '02'),
('260018', 'OBRVSKI ZA DDV 18%', 'P', '02'),
('260019', 'OBVRSKI ZA DDV 19%', 'P', '02'),
('260020', 'DANOK ZA NAGRADNI IGRI', 'P', '02'),
('260700', 'OBVRSKI ZA POMALKU PLATEN DDV', 'P', '02'),
('261000', 'OBVRSKI ZA AKCIZI', 'P', '02'),
('262000', 'KRATKORO^NI KREDITI I ZAEMI VO ZEMJATA', 'P', '01'),
('263000', 'OBVRSKI VRZ OSNOVA NA NAEM', 'P', '02'),
('263001', 'DANOK OD DOBIVKA', 'P', NULL),
('264000', 'ODLO@ENI OBVRSKI ZA DANOK OD DOBIVKA', 'P', '02'),
('265000', 'OBVRSKI ZA CARINI I CARINSKI DAVA^KI', 'P', '02'),
('269000', 'OBV.ZA OST.NESPOM.DAN.PRID.I DR.DAVA^KI', 'P', '02'),
('27', 'KRAT.OBV.ZA PLATI,DR.OBV.SPREMA VRAB.I O', 'P', '02'),
('270000', 'OBVRSKI ZA PLATA I NADOMESTI ZA PLATA', 'P', '00'),
('271000', 'NETO PLATI', 'P', NULL),
('272000', 'NADOMESTI NA NETO PLATI', 'P', '00'),
('273000', 'DANOCI OD PLATI', 'P', NULL),
('274000', 'PRIDONESI OD PLATI', 'P', '00'),
('274001', 'PRIDONES ZA PIOM', 'P', '00'),
('274002', 'PRIDONES ZA ZDRAVSTVO', 'P', '00'),
('274003', 'PRIDONES ZA VRABOTUVAWE', 'P', '00'),
('274004', 'PRID ZA DOPOLN ZDRASTVO', 'P', '00'),
('275000', 'NERASPRED.DOBIVKA OD FINANSISKATA GODINA', 'P', NULL),
('276000', 'OBVR. ZA LI^NI PRIMAWA NA SOPSTVENICITE', 'P', '02'),
('279000', 'OBVR.SPR.VRAB.PO DR.OSNOVI I OST.NESP.KR', 'P', '02'),
('28', 'DOLGOR.OBVRSKI I DOLG.REZ.ZA RIZICI I TR', 'P', NULL),
('280000', 'DOLG.OBVSKI SPREMA POVRZANI SUBJEKTI', 'P', NULL),
('281000', 'DOLGOR.OBVRSKI PO OSNOV ZAEMI I KREDITI', 'P', NULL),
('282000', 'DOL.OBV.SPREMA SUBJ.SO KOI SUB.E POVRZ.', 'P', NULL),
('283000', 'DOLG.OBVRSKI ZA AVANSI,DEPOZITI I KAUCII', 'P', NULL),
('284000', 'DOLG.OBV.SPREMA DOBAV.(DOVER.PO OSN.RAB)', 'P', NULL),
('285000', 'DOLGOR.OBVRSKI ZA HARTII OD VREDNOST', 'P', NULL),
('286000', 'OST.DOLG.OBV.VKLU^ GO DANOK. I SOC.OSIG.', 'P', NULL),
('287000', 'REZERVIRAWA ZA PENZII I SLI^NI OBVRSKI', 'P', NULL),
('288000', 'REZERVIRAWA ZA DANOCI I PRIDONESI', 'P', NULL),
('289000', 'OST.DOLG.REZER.ZA RIZICI I TRO[OCI', 'P', NULL),
('29', 'ODLO@ENO PLA].NA TRO[.I PRIH.VO IDN.PERI', 'P', NULL),
('290000', 'ODNAPRED PRESMETANI TRO[OCI', 'P', NULL),
('291000', 'PRESM TRO[ ZANAB NA DOBRA', 'P', NULL),
('292000', 'ODNAPRED NAPLATENI(PRESMETANI) PRIHODI', 'P', NULL),
('294000', 'PRESMETANI ZAVISNI TRO[OCI NA NABAVKATA', 'P', NULL),
('297000', 'OSTANATO ODLO@.PLA].NA TRO[.I PRIH. VO I', 'P', NULL),
('3', 'ZALIHI NA SUROVINI,MATER.REZ.DEL.I SIT.I', NULL, NULL),
('30', 'PRESMETKA NA NABAVKATA', NULL, NULL),
('300000', 'VREDNOST PO PRESMETKA NA DOBAVUVA^ITE', NULL, NULL),
('301000', 'ZAVISNI TRO[OCI', NULL, NULL),
('302000', 'CARINSKI I DRUGI UVOZNI DAVA^KI', NULL, NULL),
('303000', 'DANOK NA DODADENA VREDNOST I OST.DAVA^KI', NULL, NULL),
('309000', 'PRESMETKA NA NABAVKATA', NULL, NULL),
('31', 'SUROVINI I MATERIJALI', NULL, NULL),
('310000', 'SUROVINI I MATERIJALI NA ZALIHA', NULL, NULL),
('312000', 'SUROVINI I MATERIJALI NA PAT', NULL, NULL),
('316000', 'SUROV.I MATERIJ.VO DORAB.OBRAB.I MANIPUL', NULL, NULL),
('317000', 'VRED.USOGLAS.NA ZALIH.NA SUR.I MATERIJAL', NULL, NULL),
('319000', 'OTSTAPUVAWE OD CENITE NA SUROV.I MATERIJ', NULL, NULL),
('32', 'REZERVNI DELOVI', NULL, NULL),
('320000', 'REZERVNI DELOVI NA ZALIHA', NULL, NULL),
('327000', 'VRED.USOGLASUVAWE NA ZALIH.NA REZ.DELOVI', NULL, NULL),
('329000', 'OTSTAPUVAWE OD CENITE NA REZERVNI DELOVI', NULL, NULL),
('35', 'SITEN INVENTAR I AMBALA@A', NULL, NULL),
('350000', 'SITEN INVENTAR NA ZALIHA', NULL, NULL),
('351000', 'SITEN INVENTAR VO UPOTREBA', '1', '03'),
('352000', 'AMBALA@A I AVTOGUMI NA ZALIHA', NULL, NULL),
('353000', 'AMBALA@A I AVTOGUMI VO UPOTREBA', NULL, NULL),
('357000', 'VRED.USOG.NA ZALIH.NA SIT.INV.AMB.I AVTO', NULL, NULL),
('359000', 'OTST.OD CENITE NA SIT.INV.AMB.I AVTOGUMI', NULL, NULL),
('37', 'AVANSI,DEPOZITI I KAUCII ZA SUR.MAT.REZ.', NULL, NULL),
('370000', 'AVANSI,DEPOZITI I KAUCII ZA SUR.I MAT.RE', 'P', '01'),
('377000', 'VRED.USOGL. NA DADEN.AVANSI, DEPOZ I KAU', NULL, NULL),
('4', 'TRO[OCI I RASHODI OD RABOTEWETO', NULL, NULL),
('40', 'TRO[OCI ZA SUR.MAT.ENERG.REZ.DEL.I SIT.I', NULL, NULL),
('400000', 'POTRO[ENI SUROVINI I MATERIJALI', 'D', NULL),
('400001', 'POTRO[ENO OGREV,GORIVO I MAZIVO', 'D', NULL),
('400002', 'POTRO[ENI KANC MATRIJALI', 'D', NULL),
('400003', 'MATERIJAL ZA ^ISTEWE I ODR@UVAWE', 'D', NULL),
('400004', 'POTRO[ENA VODA', 'D', NULL),
('400005', 'POTRO[ENA ELEKTR ENERGIJA', 'D', NULL),
('400006', 'KALO RASTUR', 'D', NULL),
('401000', 'TRO[OCI ZA MATERIJALI (ZA ADM UPR PROD)', 'D', NULL),
('401001', 'POTRO[ENI KANCALARISKI MATERIJALI', 'D', NULL),
('401002', 'POTRO[ENO GORIVO', 'D', NULL),
('403000', 'TRO[OCI ZA ENERGIJA (ZA AUP)', 'D', NULL),
('403001', 'POTRO[ENA EL ENERGIJA', 'D', NULL),
('403002', 'NAFTA I DERIVATI', 'D', NULL),
('403004', 'GORIVO ZA TRANSPORTNI SREDSTVA', 'D', NULL),
('404000', 'POTRO[ENI REZERVNI DELOVI (ZA PR-VO)', 'D', NULL),
('405000', 'TRO[ ZA REZ DEL I MARTR ZA ODR@ (ZA AUP)', 'D', NULL),
('406000', 'TRO[OCI ZA AMBALA@A', 'D', NULL),
('408000', 'TRO[OCI ZA SIT INV AMBAL I AUT GUM (AUP)', 'D', NULL),
('409000', 'OTSTAPUVAWE ODSTAND (PLANSKI) CENI', 'D', NULL),
('41', 'USLUGI SO KARAKTER NA MATERETIJ.TRO[OCI', 'D', NULL),
('410000', 'TRANSPORTNI USLUGI', 'D', NULL),
('410001', 'PTT USLUGI', 'D', NULL),
('411000', 'PO[TENSKI USLUGI TELEF USL INTERNET', 'D', NULL),
('411001', 'TELEFONSKI USLUGI', 'D', NULL),
('411002', 'PO[TENSKI USLUGI', 'D', NULL),
('411003', 'INTERNET  USLUGI', 'D', NULL),
('412000', 'NADVORE[NI USLUGI ZA IZRABOTKA NA DOBRA', 'D', NULL),
('413000', 'USLUGI ZA ODR@UVAWE I ZA[TITA', 'D', NULL),
('414000', 'NAEMNINI-LIZING ZAKUPNINA', 'D', NULL),
('415000', 'KOMUNALNI USLUGI', 'D', NULL),
('415001', 'TRO[OC ZA IZNES I SOB NA SMET I FEKALII', 'D', NULL),
('416000', 'TRO[OCI ZA ISTRA@UVAWE I RAZVOJ', 'D', NULL),
('417000', 'TRO[.ZA PROMOCIJA,PROPAG.REKL.REPR.I SPO', 'D', NULL),
('419000', 'OSTANATI USLUGI', 'D', NULL),
('419200', 'REGISTRACIJA NA VOZILA', 'D', NULL),
('419300', '[PEDITERSKI USLUGI', 'D', NULL),
('419400', 'PATARINI', 'D', NULL),
('419500', 'KOMUNALNI USLUGI', 'D', NULL),
('421000', 'PLATA I NADOM ZA PLATA BRUTO(ZA AUP)', 'D', NULL),
('422000', 'OSTANATI TRO[OCI NA VRABOTENITE', 'D', '00'),
('423000', 'REZERVIRAWA ZA GARANCII', 'D', '00'),
('429000', 'OST.DOLG.REZER.NA TRO[OCI I RIZICI', 'D', '00'),
('430', 'TRO[OCI ZA AMORTIZACIJA I REZERVIRAWA', 'D', '00'),
('432000', 'TRO[OCI ZA AMORTIZACIJA (ZA A U I PROD)', 'D', '00'),
('433000', 'NAMAL.NA AMORT.VRZ TOVAR NA SOP.KAPITAL', 'D', NULL),
('434000', 'NAMAL NA VREDN NA DOLGORO^.FIN.VLO@UVAWA', 'D', NULL),
('435000', 'REVALORIZACIJA NA OBVRSKITE', 'D', NULL),
('436000', 'OTPIS I ISPR NA VREDN NA NENAPL POBARUVA', 'D', NULL),
('437000', 'OTPIS I ISPRAVKA NA VREDN.NA ZALIHITE', 'D', NULL),
('438000', 'REVALORIZACIJA NA AMORTIZACIJA', 'D', NULL),
('439000', 'OSTANATI VREDNOSTNI USOGLASUVAWA', 'D', NULL),
('44', 'OSTANATI TRO[OCI ODRABOTEWETO', 'D', NULL),
('440000', 'DNEVNICI ZA SLU@ PAT NO] I PATNI TRO[OCI', 'D', NULL),
('440001', 'DNEVNICI VO ZEMJATA', 'D', NULL),
('440002', 'DNEVNICI ZA PATUVAWE VO STRANSTVO', 'D', NULL),
('440003', 'TRO[OCI ZA SLU@BENO PATUVAWE', 'D', NULL),
('440004', 'TRO[OCI ZA KORIST.SOPSTV.VOZILO', 'D', NULL),
('440008', 'TRO[OCI ZA ISHRANA NA RABOTNICITE', 'D', NULL),
('441000', 'NADOMESTOCI NA TRO[OCI NA VRABOTENITE', 'D', NULL),
('441001', 'TRO[OCI ZA ZADOL@ITELNI SISTEM PREGLEDI', 'D', NULL),
('441002', 'NADOM.ZA PREV DO I OD RABOTA ORGANIZIRAN', 'D', NULL),
('441003', 'TRO[OCI ZA OBRAZOVANIE I USOVR[UVAWE', 'D', NULL),
('441004', 'TRO[OCI ZA SMESTUVAWE I ISHRANA NA TEREN', 'D', NULL),
('443000', 'TRO[OCI ZA SPONZORSTVA I DONACII', 'D', NULL),
('444000', 'TRO[OCI ZA REPREZENTACIJA', 'D', NULL),
('445000', 'TRO[OCI ZA OSIGURUVAWE', 'D', NULL),
('446000', 'BANKARSKI USLUGI I TRO[ ZA PLATEN PROMET', 'D', NULL),
('447000', 'DANOCI KOI NE ZAV OD REZUL ^LANARINI', 'D', NULL),
('447001', 'DANOK NA IMOT', 'D', NULL),
('447002', '^LANARINI NA FONDOVI I ZDRU@ENIJA', 'D', NULL),
('447003', 'FIRMARINA', 'D', NULL),
('447004', 'RADIODIFUZNA TAKSA', 'D', NULL),
('447005', 'PRETPLATA NA SPISANIJA', 'D', NULL),
('448000', 'TRO[OCI ZA KORISTEWE NA PRAVA', 'D', NULL),
('449000', 'OSTANATI TRO[OCI NA RABOTEWETO', 'D', NULL),
('449001', 'SPISAN STR.OBR.ADM I SUD TAK.ISPRAT', 'D', NULL),
('449002', 'ADVOKATSKI USLUGI', 'D', NULL),
('449003', 'IZDATOCI ZA KONCESII', 'D', NULL),
('449004', 'SUDSKI TAKSI I NOTARSKA NAGRADA', 'D', NULL),
('449005', 'TRO[OCI ZA REGISTRACIJA NA VOZILA', 'D', NULL),
('449006', 'KNIGOVODSTVENI USLUGI', 'D', NULL),
('449007', 'NADOMESTI ZA POVR I PRIVR RABOTI', 'D', NULL),
('449008', 'ZDRASTVENI USLUGI (KONTROLNI PREGLEDI)', 'D', NULL),
('449009', 'GEODETSKI I KATASTARSKI USLUGI', 'D', NULL),
('45', 'OSTANATI TRO[.OD RABOTEWETO OD RED.AKTIV', 'D', NULL),
('450000', 'NEOTP.VRED.I DR.TRO[.NA OTU\\.I RASH.POST', 'D', NULL),
('451000', 'NAMALUVAWE NA VRED.NA POSTOJANITE SREDST', 'D', NULL),
('452000', 'KUSOCI', 'D', NULL),
('453000', 'KAZNI,PENALI I NADOMESTOCI NA [TETI', 'D', NULL),
('453001', 'PARI^NI KAZNI ZA STOPANSKI PRESTAPI', 'D', NULL),
('453002', 'SUDSKI TRO[OCI ZA STOP PRESTAPI', 'D', NULL),
('454000', 'DOPOL.UTVRD.TRO[.-RASH.OD PORANE[.GODINI', 'D', NULL),
('459000', 'OSTANATI NESPOM.TRO[.-RASHODI OD RABOTEW', 'D', NULL),
('460000', 'ZAGUBI ODRASHOD I PROD NA NEMI MATER S-V', 'D', NULL),
('464000', 'KUSOCI KALO RASTUR RASIPUVAWA I KR[EWE', 'D', NULL),
('466000', 'RASHODI VRZ OSN NA DIR OTPISNA POBARUVA', 'D', NULL),
('467000', 'RASHODI OD DOPOLN ODOBR POPUSTI RABAT RE', 'D', NULL),
('468000', 'KAZNI PENALI NASOMESTOCI ZA [TETI I DRUO', 'D', NULL),
('469000', 'OSTANATI RASHODI ODRABOTEWETO', 'D', NULL),
('47', 'PLATI I NADOMESTOCI', 'D', NULL),
('470000', 'VKALKULIRANI PLATI', 'D', NULL),
('471000', 'VKALKULIRANI NADOMESTOCI I PLATI', 'D', NULL),
('474000', 'RASH.VRZ OSNOVA NA KAMATI OD RABOTEWETO', 'D', NULL),
('475000', 'RASH VRZ OSN NANEGAT KURSNI RAZLIKI', 'D', NULL),
('48', 'RASH.PO OSN.NA KAMATI,KURS.RAZL.I SL.RAS', 'D', NULL),
('480000', 'KAMATI NA RABOTEWETO SO POVRZANI SUBJEKT', 'D', NULL),
('481000', 'KURSNI RAZLIKI OD RAB.SO POVRZ. SUBJEKTI', 'D', NULL),
('482000', 'OSTAN.SL.RASH.OD FIN.TRANS.OD RAB.DO POV', 'D', NULL),
('483000', 'KAMATI OD RABOTEWETO', 'D', NULL),
('484000', 'ZATEZNI KAMATI', 'D', NULL),
('485000', 'KURSNI RAZLIKI OD RAB.SO NEPOVRZ.SUBJEKT', 'D', NULL),
('489000', 'OSTAN.SL.RASHODI OD TRANS.SO NEPOV.SUBJE', 'D', NULL),
('49', 'RASPORED NA TRO[OCITE', 'D', NULL),
('490000', 'RASPORED NA TRO[OCITE', 'D', NULL),
('491000', 'RASPORED NA TRO[.NEPOS.VRZ TOV.NA VK.PH.', 'D', NULL),
('492000', 'RASP NATRO[ NEPOSR VRZTOVAR NA VKUP PRIH', 'D', NULL),
('6', 'ZALIHI NA P-VO,GOTOVI PROIZVODI I STOKI', 'D', NULL),
('60', 'PROIZVODSTVO', 'D', NULL),
('600000', 'PROIZVODSTVO', 'D', NULL),
('606000', 'PROIZVOD.VO DORABOTKA, OBRAB.I MANIPULAC', 'D', NULL),
('607000', 'VRED.USOGL.NA PROIZVODSTVOTO-USLUGITE', 'D', NULL),
('609000', 'OTSTAPUVAWE OD CENITE NA PROIZVODSTVO', 'D', NULL),
('63', 'GOTOVI PROIZVODI', 'D', NULL),
('630000', 'PROIZVODSTVO NA ZALIHA', 'D', '02'),
('631000', 'PROIZVODSTVO VO TU\\ SKLAD', 'D', '02'),
('633000', 'PROIZVODI VO PRODAVNICA', 'D', '02'),
('634000', 'VKALKULIRAN DANOK NA DODADENA VREDNOST', 'P', '02'),
('635000', 'VKALKULIRANI AKCIZI', 'P', '02'),
('636000', 'PROIZVODI VO DORABOTKA,OBRAB.I MANIPULAC', 'D', '02'),
('637000', 'ZALIHA NA NEKURENTNI PROIZVODI I OTPADOC', 'D', '02'),
('638000', 'VRED.USOGLAS.NA ZALIHITE NA GOT.PROIZVOD', '2', '02'),
('639000', 'OTSTAPUVAWE OD CENITE NA PROIZVODITE', '2', '02'),
('65', 'PRESMETKA NA NABAVKATA NA STOKI', NULL, NULL),
('650000', 'VREDNOST NA STOKITE PO PRESM.NA DOBAVUVA', 'D', '02'),
('651000', 'ZAVISNI TRO[OCI NA NABAVKA NA STOKI', 'D', '02'),
('652000', 'CARINI I DRUGI UVOZNI DAVA^KI ZA STOKITE', 'D', '02'),
('653000', 'DANOK NA DOD.VRED.AKCIZI I DR.DAV. ZA ST', NULL, '02'),
('659000', 'PRESMETKA NA NABAVKATA', NULL, '02'),
('66', 'STOKI', NULL, '02'),
('660000', 'STOKI NA ZALIHA', 'D', '02'),
('661000', 'STOKI VO TU\\ SKLAD', 'D', '02'),
('662000', 'STOKI NA PAT', 'D', '02'),
('663000', 'STOKI VO PRODAVNICA', 'D', '02'),
('663005', 'STOKI PO POVLASTENA STAPKA 5%', 'D', '02'),
('663018', 'STOKI PO OP[TA STAPKA 18%', 'D', '02'),
('663019', 'STOKI PO OP[TA STAPKA 19%', 'D', '02'),
('664000', 'VKALK.DANOK NA DODADENA VREDNOST', 'P', '02'),
('664005', 'DANOK PO POVLASTENA STAPKA 5%', 'P', '02'),
('664018', 'DANOK PO OP[TA STAPKA 18%', 'P', '02'),
('664019', 'DANOK PO OP[TA STAPKA 19%', 'P', '02'),
('665000', 'VKALKULIRANI AKCIZI', 'P', '02'),
('666000', 'STOKI VO DORABOTKA,OBRABOTKA I MANIPULAC', 'D', '02'),
('667000', 'VRED.USOGLASUVAWE NA ZALIHATA NA STOKITE', 'D', '02'),
('669000', 'REZLIKI VO CENI NA STOKITE', 'P', '02'),
('669200', 'RAZLIKA VO CENI NA MALO', 'P', '02'),
('67', 'AVANSI,DEPOZITI I KAUCII ZA NAB.NA STOKA', NULL, NULL),
('670000', 'DADENI AVANSI, DEPOZITI I KAUCII ZA NAB.', 'D', NULL),
('671000', 'DADENI AVANSI, DEPOZITI I KAUCII NA UVOZ', 'D', NULL),
('672000', 'DAD.AVANSI,DEPOZITI I KAUCII ZA POVR.AMB', NULL, NULL),
('679000', 'VRED.USOG.NA DAD.AVAN.DEPOZ.I KAUC.ZA ST', NULL, NULL),
('7', 'RASHODI I PRIHODI', NULL, NULL),
('70', 'RASHODI NA PRODAD.PROIZ.STOKI,USL.I MATE', NULL, NULL),
('700000', 'RASHODI PO OSNOV NA PROD.PROIZ.I USLUGI', 'D', NULL),
('701000', 'NABAVNA VREDNOST NA PRODAD. DOBRA STOKI', 'D', NULL),
('701001', 'NABAVNA VREDN ZA PROD DOBRA NA MALO', 'D', NULL),
('701105', 'NABAVNA VREDNOST NA PROD.PROIZV.05%', 'D', NULL),
('701118', 'NABAVNA VREDNOST NA PROD.PROIZVODI 18%', 'D', NULL),
('701400', 'NABAVNA VREDNOST NA STOKI NA MALO', 'D', NULL),
('702000', 'NAB.VRED.NA PRED.MATER.REZ.DEL. I SIT.IN', 'D', NULL),
('703000', 'RASHODI PO OSNOV NA PRODADENI ST.I MATER', 'D', NULL),
('714000', 'DRUGI RASHODI', 'D', NULL),
('720000', 'VONREDNI NEVOOBI^AENI STAVKI NA TRO[.', 'D', NULL),
('721000', 'VON.OTPISI I OTU\\UVAWA NA SRED.KOI NAST', 'D', NULL),
('722000', 'ZAGUBI PORADI O[TET.NA GOLEM DEL OD SRED', 'D', NULL),
('740000', 'PRIHODI OD PRODA@BA NA NEPOVRZ DRU[TVA', 'P', NULL),
('740105', 'PRIHODI OD PRODA@BA NASTOKI 5%', 'P', NULL),
('740118', 'PRIHODI OD PROD NA P-DI STOKI 18%', 'P', NULL),
('741000', 'PRIHODI OD PROD NA DOBRA(STOKI) VO ZEMJ.', 'P', NULL),
('741001', 'PRIHODI OD PRODA@BA NA MALO', 'P', NULL),
('741002', 'PRIHODI OD USLUGI', 'P', NULL),
('741005', 'PRIH.OD PROD.NA PROIZV.5%', 'P', NULL),
('741018', 'PRIH.OD PROD.NA PROIZVODI 18%', 'P', NULL),
('750000', 'PRIH.OD PROD.NA PROIZ.ST.I USL.NA POV.SU', 'P', NULL),
('751000', 'PRIH.OD PROD. NA PROIZ.ST.I USL.NA DOM.P', 'P', NULL),
('751005', 'PRIH.OD PROD.NA PROIZ STOKI NA DOM.PAZAR', 'P', NULL),
('751100', 'PRIH.OD PROD,NA PROIZVODI', 'P', NULL),
('751200', 'PRIH.OD PROD. NA STOKI NA MALO', 'P', NULL),
('752000', 'PRIH.OD PROD.NA PROIZ.ST.I USL.NA STR.PA', 'P', NULL),
('753000', 'PRIHODI OD NAEMNINA', 'P', NULL),
('755000', 'PRIH.PO OSNOV NA UPOT.NA SOP.PROIZ.ST.US', 'P', NULL),
('756000', 'PRIH.OD PROD.NA MAT.REZ.DEL.SIT.INV.AMBA', 'P', NULL),
('759000', 'OST.PRIH.OD PROD.NA PROIZ.ST.USL.I MATER', 'P', NULL),
('76', 'PRIH.OD U^EST.NA VLO@.I PRIH.OD OST.VLO@', 'P', NULL),
('760000', 'PRIH.OD U^ESTVA NA VLO@.VO POVRZANI SUBJ', 'P', NULL),
('761000', 'PRIHODI OD U^EST.NA VLO@.VO NEPOV.SUBJEK', 'P', NULL),
('762000', 'PRIH.OD OST.VLO@.I ZAEMI VO RAMK.NA POST', 'P', NULL),
('763000', 'PRIH.OD OST.VLO@.I ZAEMI VO RAMKITE NA P', 'P', NULL),
('764000', 'VI[OCI', 'P', NULL),
('765000', 'PRIH.OD NAPLOTPI[ POBARUVAWA', 'P', NULL),
('770000', 'PRIHODI OD SUBV.DONAC.REGR.KOMP.I DR.NAD', 'P', NULL),
('771000', 'PRIHODI OD DANOCI I PRIDONESI', 'P', NULL),
('772000', 'PRIHODI OD UKINUV.NA DOLG.REZER.I OD ODL', 'P', NULL),
('773000', 'PRIHODI OD PRODA@BA NA POSTOJANI SREDSTV', 'P', NULL),
('774000', 'PRIHODI VRZ OSNOVANA NA KAMATI', 'P', NULL),
('775000', 'PRIH.VRZ OSNOVA POZITIVNI KURSNI RAZLIKI', 'P', NULL),
('778000', 'PRIH.PO OSN.NA REKL.PROP.DONACII I SPONZ', 'P', NULL),
('778001', 'DONACII NA HUMAN ORGANIZACII', 'P', NULL),
('778002', 'DONACII NA GRA\\ANI', 'P', NULL),
('779000', 'OSTANATI NESPOMNATI DELOVNI PRIHODI', 'P', NULL),
('78', 'VONREDNI-NEVOOBI^AENI PRIHODI', 'P', NULL),
('780000', 'PRIHODI OD VONR.PROD.NA ZNA^.DEL NA POST', 'P', NULL),
('781000', 'VONR.PRIH.KOI PROIZL.OD ZNA^.PROM.VO SME', 'P', NULL),
('782000', 'VONREDNI NEPREDVIDENI PRIHODI', 'P', NULL),
('789000', 'OSTANATI VONREDNI-NEVOOBI^AENI PRIHODI', 'P', NULL),
('79', 'RAZLIKA NA PRIH.IRASH.VO FINANSISK.GOD.', NULL, NULL),
('790000', 'RAZLIKA NA PRIH.I RASH.OD REDOV.RABOTEWE', NULL, NULL),
('791000', 'RAZL.NA PRIH.I RASH.OD VONRED.-NEVOO.AKT', NULL, NULL),
('8', 'REZULTATI OD RABOTEWETO', NULL, NULL),
('80', 'DOBIVKA OD RED.RABOTEWE PRED ODANO^UVAWE', NULL, NULL),
('800000', 'DOBIVKA OD REDOVNOTO RAB.PRED ODANO^UVAW', NULL, NULL),
('81', 'DANOCI I PRID.OD DOBIV.OD RED.RAB.PRED O', NULL, NULL),
('810000', 'DANOCI I PRIDONESI OD REDOVOTO RABOTEWE', NULL, NULL),
('811000', 'PRIDONESI I DR.DAVA^KI OD DOB.OD RED.RAB', NULL, NULL),
('82', 'DOBIVKA OD REDOVNOTO RAB.PO ODANO^UVAWE', NULL, NULL),
('820000', 'DOBIVKA OD REDOVNOTO RABOTEWE PO ODANO^U', NULL, NULL),
('83', 'DOBIVKA OD VONREDNI-NEVOOB.AKT.PRED ODAN', NULL, NULL),
('830000', 'DOBIVKA OD VONR.-NEVOOBI^.AKTIV.PRED ODA', NULL, NULL),
('84', 'DANOCI I PRID.OD DOB.OD VON.-NEVOOB.AKT', NULL, NULL),
('840000', 'DANOCI OD DOBIVKA OD VONREDNITE AKTIVNOS', NULL, NULL),
('841000', 'PRIDONESI OD DOBIVKA OD VONRED.AKTIVNOST', NULL, NULL),
('85', 'DOBIVKA OD VONR-NEVOOB.AKT.PO ODANO^UVAW', NULL, NULL),
('850000', 'DOBIVKA OD VONR.-NEVOOB.AKT.PO ODANO^UVA', NULL, NULL),
('86', 'OSTANATI DAN.I PRID.KOI NE SE ISKA@.VO P', NULL, NULL),
('860000', 'OST.DAN.I PRID.KOI NE SE ISKA@.VO PRET.P', NULL, NULL),
('87', 'DOBIVKA ZA FINANSKISKATA GODINA', NULL, NULL),
('870000', 'DOB.OD SITE AKTIV.VO RABOTEW.PO ODANO^UV', NULL, NULL),
('871000', 'DOBIVKA ZA FIN.GOD.PO SITE ODANO^.-NETO', NULL, NULL),
('88', 'RESPOREDUVAWE NA DOBIV.PO SITE ODANO^.NE', NULL, NULL),
('880000', 'POKRIVAWE NA ZAGUBATA OD PRETHODNITE GOD', NULL, NULL),
('881000', 'ZGOLEM. NA TRAJNIOT KAPITAL(KAP.NA SOPS)', NULL, NULL),
('882000', 'ZGOLEMUVAWE NA TRAJNITE VLO@UVAWA', NULL, NULL),
('883000', 'DIVIDENDI I DR.NADOMESTOCI NA VLO@UVA^IT', NULL, NULL),
('884000', 'REZERVI', NULL, NULL),
('885000', 'PLATI OD DOBIVKA', NULL, NULL),
('886000', 'LI^NI PRIMAWA NA SOPSTVENICITE', NULL, NULL),
('887000', 'OSTANATI NAMENI', NULL, NULL),
('889000', 'NERASPREDELENA DOBIVKA', NULL, NULL),
('89', 'ZAGUBA', NULL, NULL),
('890000', 'ZAGUBA OD RED. RABOTEWE PRED ODANO^UVAWE', NULL, NULL),
('891000', 'ZAGUBA OD REDOV. RABOTEWE PO ODANO^UVAWE', NULL, NULL),
('892000', 'ZAGUBAOD BONR.-NEVOOB.AKTIV.PRED ODANO^U', NULL, NULL),
('893000', 'ZAGUBA OD VON.-NEVOOB.AKT PO ODANO^UVAWE', NULL, NULL),
('894000', 'ZAGUBA OD SITE AKTIVNOSTI VO RAB. PO ODA', NULL, NULL),
('895000', 'ZAGUBA ZA FINAN.GOD.PO SITE ODANO^UVAWA', NULL, NULL),
('9', 'KAPITAL,REZERVI I VONBILANSNA EVIDENCIJA', 'P', NULL),
('90', 'ZAPI[AN A NEUPLATEN KAPITAL', 'P', NULL),
('900000', 'ZAPI[AN,A NEUPLATEN KAPITAL-OBI^NI AKCII', 'P', NULL),
('901000', 'ZAPI[AN,A NEUPLATEN KAPITAL-POVLAS.AKCII', 'P', NULL),
('902000', 'ZAPI[ANI,A NEUPLATENI VLOGOVI', 'P', NULL),
('91', 'ZAPI[AN OSNOVEN KAPITAL KOJ E UPLATEN', 'P', NULL),
('910000', 'AKCIONERSKI KAPITAL-OBI^NI AKCII', 'P', NULL),
('911000', 'AKCIONERSKI KAPITAL-POVLASTENI AKCII', 'P', NULL),
('912000', 'OSNOV.KAPITAL NA VLO@.-UDELI NA PARTNERI', 'P', NULL),
('913000', 'ZGOLEMUVAWE NA KAPITALOT NA SOPSTVENICIT', 'P', NULL),
('914000', 'DR@AVEN-JAVEN KAPITAL', 'P', NULL),
('919000', 'OSTANAT KAPITAL', 'P', NULL),
('92', 'PREMII NA EMITIRANI AKCII', 'P', NULL),
('920000', 'PREMII NA EMITIRANI AKCII', 'P', NULL),
('93', 'REVALORIZACIONA REZERVA', 'P', NULL),
('930000', 'REVOLARIZACIONA REZERVA', 'P', NULL),
('94', 'REZERVI', 'P', NULL),
('940000', 'ZAKONSKI REZERVI', 'P', NULL),
('941000', 'REZERVI ZA SOPSTVENITE AKCII', 'P', NULL),
('942000', 'STATUTARNI REZERVI', 'P', NULL),
('949000', 'OSTANATI REZERVI', 'P', NULL),
('95', 'AKUMULIRANA DOBIVKA I DOBIVKA ZA FIN.GOD', 'P', NULL),
('950000', 'AKUMULIRANA DOBIVKA OD PRETHODNI GODINI', 'P', NULL),
('951000', 'DOBIVKA ZA FINANSISKATA GODINA', 'P', NULL),
('96', 'PRENESENA ZAGUBA I ZAGUBA ZA FINAN.GOD.', NULL, NULL),
('960000', 'PRENESENA ZAGUBA', NULL, NULL),
('961000', 'ZAGUBA ZA FINANSISKATA GODINA', NULL, NULL),
('99', 'VONBILANSNA EVIDENCIJA', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
