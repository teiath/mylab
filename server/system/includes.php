<?php

//system
require_once('system/config.php');
require_once('system/functions.php');
require_once('system/parameters.php');
require_once('system/Validator.php');
require_once('system/Pagination.php');
require_once('system/JsonFunctions.php');
require_once('system/Timing.php');
require_once('system/methodtypes.php');

require_once ('libs/phpCAS/CAS.php');
require_once ('libs/PHPExcel/Classes/PHPExcel.php');
require_once ('libs/tcpdf/tcpdf.php');

// Doctrine & Entities autoloading
require_once ('libs/doctrine/bootstrap.php');
spl_autoload_register(function($class) {
    include 'entities/' . $class . '.php';
});

////exceptions
require_once('exceptions/ExceptionCodes.php');
require_once('exceptions/ExceptionMessages.php');
require_once('exceptions/ExceptionManager.php');

//sync
require_once('sync/addCircuit.php');
require_once('sync/addWorker.php');
require_once('sync/addSchoolUnitWorker.php');

require_once('sync/syncCircuitTypes.php');
require_once('sync/syncEduAdmins.php');
require_once('sync/syncEducationLevels.php');
require_once('sync/syncMunicipalities.php');
require_once('sync/syncPrefectures.php');
require_once('sync/syncRegionEduAdmins.php');
require_once('sync/syncSchoolUnitTypes.php');
require_once('sync/syncSources.php');
require_once('sync/syncStates.php');
require_once('sync/syncTransferAreas.php');
require_once('sync/syncWorkerPositions.php');
require_once('sync/syncWorkerSpecializations.php');

//classes ext
require_once('classes/OrderEnumTypes.php');
require_once('classes/SearchEnumTypes.php');
require_once('classes/OrderTypes.php');
require_once('classes/SearchTypes.php');
require_once('classes/ExportDataTypes.php');
require_once('classes/ExportDataEnumTypes.php');
require_once('classes/FormatCreator.php');
require_once('classes/Filters.php');
require_once('classes/FormatCreator.php');
require_once('classes/SearchLabWorkersExt.php');
require_once('classes/SearchLabsExt.php');
require_once('classes/SearchSchoolUnitsExt.php');
require_once('classes/Reports.php');
require_once('classes/UserRoles.php');
require_once('classes/CRUDUtils.php');
require_once('classes/SYNCUtils.php');

//-----search functions
require_once('../api/get/SearchSchoolUnits.php');
require_once('../api/get/SearchLabs.php');
require_once('../api/get/SearchLabWorkers.php');
require_once('../api/get/StatisticSchoolUnits.php');
require_once('../api/get/StatisticLabs.php');
require_once('../api/get/StatisticLabWorkers.php');
require_once('../api/get/StatLabs.php');
require_once('../api/get/ReportKeplhnet.php');
require_once('../api/get/GetUserPermits.php');
require_once('../api/get/StatLabs.php');
require_once('../api/get/GetLdapWorkers.php');

////----get from mm
require_once('../api/get/GetRegionEduAdmins.php');
require_once('../api/get/GetEduAdmins.php');
require_once('../api/get/GetTransferAreas.php');
require_once('../api/get/GetPrefectures.php');
require_once('../api/get/GetMunicipalities.php');
require_once('../api/get/GetStates.php');
require_once('../api/get/GetSchoolUnitWorkers.php');
require_once('../api/get/GetCircuits.php');
require_once('../api/get/GetCircuitTypes.php');
require_once('../api/get/GetSources.php');

////----get from mylab
require_once('../api/get/GetLabTypes.php');
require_once('../api/get/GetEquipmentCategories.php');
require_once('../api/get/GetWorkerSpecializations.php');
require_once('../api/get/GetWorkerPositions.php');
require_once('../api/get/GetAquisitionSources.php');
require_once('../api/get/GetWorkers.php');
require_once('../api/get/GetLabAquisitionSources.php');
require_once('../api/get/GetLabs.php');
require_once('../api/get/GetEquipmentTypes.php');
require_once('../api/get/GetLabEquipmentTypes.php');
require_once('../api/get/GetSchoolUnits.php');
require_once('../api/get/GetEducationLevels.php');
require_once('../api/get/GetSchoolUnitTypes.php');
require_once('../api/get/GetLabRelations.php');
require_once('../api/get/GetRelationTypes.php');
require_once('../api/get/GetLabSources.php');
require_once('../api/get/GetLabTransitions.php');
require_once('../api/get/GetLabWorkers.php');
require_once('../api/get/GetMylabWorkers.php');

////---post from mylab
require_once('../api/post/PostLabs.php');
require_once('../api/post/PostLabTransitions.php');
require_once('../api/post/PostLabWorkers.php');
require_once('../api/post/PostLabAquisitionSources.php');
require_once('../api/post/PostLabEquipmentTypes.php');
require_once('../api/post/PostLabRelations.php');
require_once('../api/post/PostAquisitionSources.php');
require_once('../api/post/PostMylabWorkers.php');

////---put from mylab
require_once('../api/put/PutLabs.php');
require_once('../api/put/PutLabWorkers.php');
require_once('../api/put/PutLabAquisitionSources.php');
require_once('../api/put/PutLabEquipmentTypes.php');
require_once('../api/put/PutLabTransitions.php');
require_once('../api/put/PutLabRelations.php');
require_once('../api/put/PutInitialLabs.php');

//---del from mylab
 require_once('../api/del/DelLabs.php');
 require_once('../api/del/DelLabEquipmentTypes.php');
 require_once('../api/del/DelLabAquisitionSources.php');
 require_once('../api/del/DelLabWorkers.php');
 require_once('../api/del/DelLabRelations.php');
 require_once('../api/del/DelLabTransitions.php');
 require_once('../api/del/DelInitialLabs.php');
 
 require_once('../api/del/DelAquisitionSources.php');
 require_once('../api/del/DelEquipmentCategories.php');
 require_once('../api/del/DelEquipmentTypes.php');
 require_once('../api/del/DelLabSources.php'); 
 require_once('../api/del/DelLabTypes.php');
 require_once('../api/del/DelMylabWorkers.php'); 
 require_once('../api/del/DelRelationTypes.php'); 
?>