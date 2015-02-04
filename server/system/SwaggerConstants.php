<?php
//Για την δημιουργία documentation με την βιβλιοθηκη swagger-php χρησιμοποιούμε annotations.
//Υπαρχει παράδειγμα με annotations στο φάκελο /api.
//Η σύνταξη των annotations είναι πολυ συγκεκριμένη και υπάρχει εκτενής αναφορά στο
//http://zircote.com/swagger-php/index.html
//και επίσης στο
//https://github.com/swagger-api/swagger-spec/blob/master/versions/1.2.md
//
//Αφού γίνει η σύνταξη των annotations σε κάθε function που μας ενδιαφερει να κάνουμε documentation
//εκτελούμε την παρακάτω εντολή :
// php server/libs/doctrine/vendor/zircote/swagger-php/swagger.phar --bootstrap server/system/SwaggerConstants.php,server/exceptions/ExceptionCodes.php,server/exceptions/ExceptionMessages.php 
// api/get api/post api/put api/del api/inedx.php -o server/generate-docs
// 
//Η παραπάνω εντολή με βάση τα annotations που έχουμε συντάξει στα αρχεία του καταλόγου /api
//δημιουργεί json αρχεία στον κατάλογο "/server/generate-docs" κατάλληλα διαμορφωμένα ώστε για να μπορούν να διαβαστούν
//από το swagger-ui και να έχουμε ένα pretty-style documentation.

    //mmsch server
//    define('SERVER_DOCS_PATH','http://mmsch.teiath.gr/mylab/server/libs/swagger-ui-master/dist/index.html');
//    define('BASE_PATH', 'http://mmsch.teiath.gr/mylab/api');
//    define('API_VERSION', '2.0');
//    define('SWAGGER_VERSION', 2.0);
      
    //mm server
     define('SERVER_DOCS_PATH','https://mylab.sch.gr/server/libs/swagger-ui-master/dist/index.html');
     define('BASE_PATH', 'https://mylab.sch.gr/api');
     define('API_VERSION', '2.0');
     define('SWAGGER_VERSION', 2.0);
    
?>
