<?php

//system
require_once('system/config.php');
require_once('system/functions.php');
require_once('system/parameters.php');
require_once('system/validator.php');
require_once('system/pagination.php');
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

//libs
require_once('libs/db2php/Db2PhpEntity.class.php');
require_once('libs/db2php/Db2PhpEntityBase.class.php');
require_once('libs/db2php/Db2PhpEntityModificationTracking.class.php');
require_once('libs/db2php/DFCInterface.class.php');
require_once('libs/db2php/DFC.class.php');
require_once('libs/db2php/DFCAggregate.class.php');
require_once('libs/db2php/DSC.class.php');

////exceptions
require_once('exceptions/ExceptionCodes.php');
require_once('exceptions/ExceptionMessages.php');
require_once('exceptions/ExceptionManager.php');
require_once('exceptions/SyncExceptionMessages.php');
require_once('exceptions/SyncExceptionCodes.php');

////----classes ext from mm
//require_once('classes/extends/RegionEduAdminsExt.class.php');
//require_once('classes/extends/EduAdminsExt.class.php');
//require_once('classes/extends/TransferAreasExt.class.php');
//require_once('classes/extends/PrefecturesExt.class.php');
//require_once('classes/extends/MunicipalitiesExt.class.php');
//require_once('classes/extends/SchoolUnitsExt.class.php');
//require_once('classes/extends/EducationLevelsExt.class.php');
//require_once('classes/extends/SchoolUnitTypesExt.class.php');
//require_once('classes/extends/StatesExt.class.php');
//require_once('classes/extends/SchoolUnitWorkers.class.php');
//require_once('classes/extends/Circuits.class.php');
//require_once('classes/extends/CircuitTypes.class.php');
//
////--classes ext from mylab
////require_once('classes/extends/LabTypesExt.class.php');
//require_once('classes/extends/EquipmentCategoriesExt.class.php');
////require_once('classes/extends/WorkerSpecializationsExt.class.php');
//require_once('classes/extends/WorkerPositionsExt.class.php');
////require_once('classes/extends/AquisitionSourcesExt.class.php');
////require_once('classes/extends/WorkersExt.class.php');
////require_once('classes/extends/LabAquisitionSourcesExt.class.php');
////require_once('classes/extends/LabsExt.class.php');
//require_once('classes/extends/EquipmentTypesExt.class.php');
//require_once('classes/extends/LabEquipmentTypesExt.class.php');
//require_once('classes/extends/LabRelationsExt.class.php');
//require_once('classes/extends/RelationTypesExt.class.php');
//require_once('classes/extends/LabSourcesExt.class.php');
//require_once('classes/extends/LabTransitions.class.php');
//require_once('classes/extends/LabWorkersExt.class.php');
//
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

//-----search functions
require_once('../api/get/SearchSchoolUnits.php');
require_once('../api/get/SearchLabs.php');
require_once('../api/get/SearchLabWorkers.php');
require_once('../api/get/StatisticSchoolUnits.php');
require_once('../api/get/StatisticLabs.php');
require_once('../api/get/StatisticLabWorkers.php');
require_once('../api/get/ReportKeplhnet.php');
require_once('../api/get/GetUserPermits.php');

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


////----post from mm

////---post from mylab
require_once('../api/post/PostLabs.php');
require_once('../api/post/PostLabTransitions.php');
require_once('../api/post/PostLabWorkers.php');
require_once('../api/post/PostLabAquisitionSources.php');
require_once('../api/post/PostLabEquipmentTypes.php');
require_once('../api/post/PostLabRelations.php');
////---put from mm

////---put from mylab
require_once('../api/put/PutLabs.php');
require_once('../api/put/PutLabWorkers.php');
require_once('../api/put/PutLabAquisitionSources.php');
require_once('../api/put/PutLabEquipmentTypes.php');
require_once('../api/put/PutLabTransitions.php');
require_once('../api/put/PutLabRelations.php');

//---del from mm

//---del from mylab
 require_once('../api/del/DelLabs.php');
 require_once('../api/del/DelLabEquipmentTypes.php');
 require_once('../api/del/DelLabAquisitionSources.php');
 require_once('../api/del/DelLabWorkers.php');
 require_once('../api/del/DelLabRelations.php');
 require_once('../api/del/DelLabTransitions.php');
  
?>