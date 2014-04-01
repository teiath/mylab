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
    
}
?>