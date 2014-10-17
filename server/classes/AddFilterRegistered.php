<?php

   use Doctrine\ORM\Query\Filter\SQLFilter;
   use Doctrine\ORM\Mapping\ClassMetadata;


class AddFilterRegistered extends SQLFilter
{
      
       /**
        * Gets the SQL query part to add to a query.
        *
        * @return string The constraint SQL if there is available, empty string otherwise
        */

    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        
var_dump($targetEntity->reflClass->Lab);
die();
        
        // Check if the entity implements the LocalAware interface
        if (!$targetEntity->reflClass->implementsInterface('Labs')) {
           
            return "";
        }

        return $targetTableAlias.'.registered = ' . $this->getParameter('registered'); // getParameter applies quoting automatically
    }
}
