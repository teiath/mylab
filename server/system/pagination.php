<?php
class Pagination
{
   
    public static function Page($page)
    { 
        if (! $page)
            $page = Parameters::DefaultPage;
        else if ( Validator::IsNegative($page) )
            throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
        else if ( !Validator::IsID ($page) )
            throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
                
        return $page;
    }
    
    public static function Pagesize($pagesize)
    {
        if ($pagesize == (string)Parameters::AllPageSize)
            $pagesize = Parameters::AllPageSize;
        else if (! $pagesize)
            $pagesize = Parameters::DefaultPageSize;
        else if ( Validator::IsNegative($pagesize) || ( Validator::IsID($pagesize) && ($pagesize > Parameters::MaxPageSize ) ) )
            throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if ( !Validator::IsID ($pagesize) )
            throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        
        return $pagesize;
    }
    
        public static function StartPagesizeFrom($page,$pagesize)
    {
        $startPagesizeFrom = (self::Page($page) -1) * self::Pagesize($pagesize);
        return $startPagesizeFrom;
    }
    
    public static function checkMaxPage($total, $page, $pagesize)
    {
        if ($pagesize > 0 && $total > 0 ) {
            $maxPage = ceil($total / self::Pagesize($pagesize));
        } else {
            $maxPage = 1;   
        }
        
        if ($page > $maxPage || $maxPage < 1 ){
            throw new Exception(ExceptionMessages::InvalidMaxPageNumber." : ".$maxPage, ExceptionCodes::InvalidMaxPageNumber);
        } else {
           return $maxPage; 
        }
        
    }
    
    public static function getPage($page, $params) {
           if ( Validator::Missing('page', $params) )
            $page = Parameters::DefaultPage;
        else if ( Validator::isNull($page) )
            throw new Exception(ExceptionMessages::MissingPageValue, ExceptionCodes::MissingPageValue);
        elseif ( Validator::isArray($page) )
            throw new Exception(ExceptionMessages::InvalidPageArray, ExceptionCodes::InvalidPageArray);
        elseif (Validator::isLowerThan($page, 0, true) )
            throw new Exception(ExceptionMessages::InvalidPageNumber, ExceptionCodes::InvalidPageNumber);
        elseif (!Validator::isGreaterThan($page, 0) )
            throw new Exception(ExceptionMessages::InvalidPageType, ExceptionCodes::InvalidPageType);
        else
            return Validator::toInteger($page);

        return $page;
    }

       public static function getPageSize($pagesize, $params, $useAllPageSize = false) {
        if ( Validator::Missing('pagesize', $params) )
            $pagesize = $useAllPageSize == true ? Parameters::AllPageSize : Parameters::DefaultPageSize;
        else if ( Validator::isEqualTo($pagesize, 0) )
            $pagesize = Parameters::AllPageSize;
        else if ( Validator::isNull($pagesize) )
            throw new Exception(ExceptionMessages::MissingPageSizeValue, ExceptionCodes::MissingPageSizeValue);
        elseif ( Validator::isArray($pagesize) )
            throw new Exception(ExceptionMessages::InvalidPageSizeArray, ExceptionCodes::InvalidPageSizeArray);
        elseif ( (Validator::isLowerThan($pagesize, 0) ) )
            throw new Exception(ExceptionMessages::InvalidPageSizeNumber, ExceptionCodes::InvalidPageSizeNumber);
        elseif (!Validator::isGreaterThan($pagesize, 0) )
            throw new Exception(ExceptionMessages::InvalidPageSizeType, ExceptionCodes::InvalidPageSizeType);
        else
            $pagesize = Validator::toInteger($pagesize);

        return $pagesize;
    }
    
}
?>